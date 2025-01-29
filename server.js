const fs = require('fs');
const https = require('https');
const express = require('express');
const socketIo = require('socket.io');

// 设置环境变量
const PORT = 3000;
const CERT_PATH = '/etc/letsencrypt/live/enggletalk.com.tw';
const MAX_ROOM_SIZE = 10; // 设置房间最大人数
const MAX_FILE_SIZE = 5 * 1024 * 1024; // 5MB

const app = express();

const server = https.createServer({
    key: fs.readFileSync(`${CERT_PATH}/privkey.pem`),
    cert: fs.readFileSync(`${CERT_PATH}/fullchain.pem`)
}, app);

const io = socketIo(server, {
    cors: {
        origin: "https://enggletalk.com.tw",
        methods: ["GET", "POST"],
        credentials: true
    }
});

// 存儲每個房間的白板狀態
const whiteboardStates = new Map();

io.on('connection', (socket) => {
    console.log('A user connected:', socket.id);

    socket.on('signal', (data) => {
        io.to(data.to).emit('signal', {
            from: socket.id,
            signal: data.signal
        });
    });

    socket.on('join-room', ({ roomId, firstName }) => {
        const room = io.sockets.adapter.rooms.get(roomId);
        if (room && room.size >= MAX_ROOM_SIZE) {
            socket.emit('room-full');
            return;
        }

        socket.join(roomId);
        console.log(`User ${firstName} (${socket.id}) joined room ${roomId}`);

        const clients = io.sockets.adapter.rooms.get(roomId);
        console.log(`Users in room ${roomId}:`, Array.from(clients || []));

        socket.to(roomId).emit('chat-message', {
            sender: '系统',
            message: `新用户 ${firstName} 加入了房间。`
        });

        socket.to(roomId).emit('user-connected', socket.id);

        // 如果該房間有保存的白板狀態，則發送給新加入的用戶
        const savedState = whiteboardStates.get(roomId);
        if (savedState) {
            socket.emit('whiteboard-draw', savedState);
        }
    });

    socket.on('file-upload', (data) => {
        if (data.fileData.length > MAX_FILE_SIZE) {
            socket.emit('file-too-large');
            return;
        }
        console.log('File received:', data.fileName);
        socket.broadcast.to(data.roomId).emit('file-received', {
            fileName: data.fileName,
            fileType: data.fileType,
            sender: data.sender,
            fileData: data.fileData,
            thumbnailData: data.thumbnailData
        });
    });

    socket.on('chat-message', (data) => {
        console.log('Received message:', data);
        socket.broadcast.to(data.roomId).emit('chat-message', {
            sender: data.sender,
            message: data.message
        });
    });

    // 處理白板繪圖同步
    socket.on('whiteboard-draw', (data) => {
        const { roomId, data: canvasData } = data;
        // 保存最新的畫布狀態
        whiteboardStates.set(roomId, canvasData);
        // 廣播給房間內的其他用戶
        socket.to(roomId).emit('whiteboard-draw', canvasData);
    });

    // 處理清除白板
    socket.on('whiteboard-clear', (data) => {
        const { roomId } = data;
        // 清除該房間的畫布狀態
        whiteboardStates.delete(roomId);
        // 通知房間內的其他用戶清除白板
        socket.to(roomId).emit('whiteboard-clear');
    });

    socket.on('disconnect', () => {
        const rooms = Array.from(socket.rooms).slice(1);
        rooms.forEach((roomId) => {
            socket.to(roomId).emit('user-disconnected', socket.id);
        });
        console.log('User disconnected:', socket.id);
    });
});

server.listen(PORT, '0.0.0.0', () => {
    console.log(`HTTPS Signaling server is running on port ${PORT}`);
});

// 错误处理
server.on('error', (error) => {
    console.error('Server error:', error);
});

// 优雅关闭
process.on('SIGTERM', () => {
    console.log('SIGTERM signal received: closing HTTP server');
    server.close(() => {
        console.log('HTTP server closed');
    });
});
