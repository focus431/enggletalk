@extends('layout.mainlayout')

@section('content')
<style>
/* 整體容器樣式 */
.content {
    background: linear-gradient(135deg, #ffffff 0%, #f5f9ff 100%);
    min-height: 100vh;
    padding: 20px;
}

.container-fluid {
    max-width: 1600px;
    margin: 0 auto;
}

/* 視訊區域樣式 */
.call-main-wrapper {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 15px;
    backdrop-filter: blur(10px);
    padding: 20px;
    box-shadow: 0 8px 32px rgba(41, 136, 229, 0.15);
    border: 1px solid rgba(41, 136, 229, 0.1);
    height: calc(100vh - 80px);
    display: flex;
    flex-direction: column;
}

.call-window {
    flex: 1;
    border-radius: 12px;
    overflow: hidden;
    background: #000;
    position: relative;
    margin-bottom: 20px;
    height: calc(100vh - 180px);
}

/* 視訊容器樣式 */
.video-container {
    width: 100%;
    height: 100%;
    position: relative;
    background: #000;
    border-radius: 12px;
    overflow: hidden;
}

#remoteVideo {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

#localVideo {
    position: absolute;
    right: 20px;
    bottom: 20px;
    width: 160px; /* 稍微縮小尺寸 */
    height: 100px;
    border-radius: 8px;
    object-fit: cover;
    box-shadow: 0 4px 12px rgba(41, 136, 229, 0.2);
    border: 2px solid rgba(255, 255, 255, 0.9);
    z-index: 999;
}

.video-container.pip-layout {
    position: relative;
    width: 100%;
    height: 100%;
}

.video-container.pip-layout .remote-video-container {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.video-container.pip-layout .local-video-container {
    position: absolute;
    right: 20px;
    bottom: 20px;
    width: 180px;
    height: 120px;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(41, 136, 229, 0.2);
    border: 2px solid rgba(255, 255, 255, 0.9);
    z-index: 2;
}

/* 網格布局樣式 */
.video-container.grid-layout {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
    padding: 10px;
}

.video-container.grid-layout #remoteVideo,
.video-container.grid-layout #localVideo {
    position: relative;
    width: 100%;
    height: 100%;
    border-radius: 8px;
    box-shadow: none;
    border: none;
}

/* 確保視訊內容完全填滿容器 */
.call-content-wrap {
    width: 100%;
    height: 100%;
    position: relative;
}

.call-contents {
    width: 100%;
    height: 100%;
    position: relative;
}

.call-window {
    width: 100%;
    height: 100%;
    position: relative;
}

/* 控制按鈕樣式 */
.call-footer {
    background: rgba(255, 255, 255, 0.95);
    padding: 15px;
    border-radius: 12px;
    border: 1px solid rgba(41, 136, 229, 0.1);
    margin-top: auto; /* 確保在底部 */
}

.call-icons {
    display: flex;
    justify-content: center;
    gap: 15px;
}

.call-items {
    display: flex;
    gap: 15px;
    margin: 0;
    padding: 0;
    list-style: none;
    flex-wrap: wrap;
    justify-content: center;
}

.call-item a {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: #ffffff;
    color: #2988e5;
    transition: all 0.3s ease;
    box-shadow: 0 2px 6px rgba(41, 136, 229, 0.15);
    border: 1px solid rgba(41, 136, 229, 0.1);
}

.call-item a:hover {
    background: #2988e5;
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(41, 136, 229, 0.25);
}

.call-item a[id="end-call"] {
    background: #ffffff;
    color: #dc3545;
    border: 1px solid rgba(220, 53, 69, 0.2);
    box-shadow: 0 2px 6px rgba(220, 53, 69, 0.15);
}

.call-item a[id="end-call"]:hover {
    background: #dc3545;
    color: #ffffff;
    border-color: #dc3545;
    box-shadow: 0 4px 12px rgba(220, 53, 69, 0.25);
}

.call-item a i {
    font-size: 1.25rem;
}

.call-item a.active {
    background: #2988e5;
    color: #ffffff;
}

.call-item a[id="toggle-video"].disabled {
    background: #f8f9fa;
    color: #6c757d;
    border-color: #dee2e6;
    box-shadow: none;
    cursor: not-allowed;
}

.call-item a[id="toggle-audio"].muted {
    background: #f8f9fa;
    color: #6c757d;
    border-color: #dee2e6;
}

/* 錄影按鈕特殊樣式 */
.call-item a[id="toggle-recording"] {
    position: relative;
    overflow: hidden;
}

.call-item a[id="toggle-recording"].recording {
    background: #dc3545;
    color: #ffffff;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% {
        box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.4);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(220, 53, 69, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(220, 53, 69, 0);
    }
}

/* 聊天室容器 */
.chat-container {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 15px;
    backdrop-filter: blur(10px);
    height: calc(100vh - 40px);
    display: flex;
    flex-direction: column;
    box-shadow: 0 8px 32px rgba(41, 136, 229, 0.15);
    border: 1px solid rgba(41, 136, 229, 0.1);
    overflow: hidden;
    position: relative;
}

/* 聊天室標題 */
.chat-header {
    padding: 10px 15px;
    background: #2988e5;
    display: flex;
    justify-content: space-between;
    align-items: center;
    min-height: 50px;
}

.chat-header h5 {
    color: #fff;
    margin: 0;
    font-size: 16px;
}

/* 聊天內容區域 */
.chat-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    position: relative;
    padding-bottom: 60px; /* 為輸入框預留空間 */
}

.chat-box {
    flex: 1;
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
    padding: 15px;
}

/* 輸入框區域 */
.chat-input-wrapper {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: #fff;
    padding: 10px;
    display: flex;
    align-items: center;
    gap: 8px;
    border-top: 1px solid rgba(41, 136, 229, 0.1);
    max-width: 100%;
    box-sizing: border-box;
}

#chat-input {
    flex: 1;
    height: 36px;
    padding: 8px 12px;
    border: 1px solid rgba(41, 136, 229, 0.2);
    border-radius: 18px;
    font-size: 14px;
    line-height: 20px;
    background: #fff;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    margin: 0;
    min-width: 0;
}

#upload-file,
#send-chat {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: transparent;
    border: none;
    color: #2988e5;
    padding: 0;
    flex-shrink: 0;
    cursor: pointer;
}

/* 響應式設計 */
@media (max-width: 768px) {
    .chat-container {
        height: 35vh !important;
        margin-bottom: 10px;
        border-radius: 10px;
    }

    .chat-header {
        padding: 8px 12px;
        min-height: 40px;
    }

    .chat-content {
        padding-bottom: 50px;
    }

    .chat-box {
        padding: 10px;
    }

    .chat-input-wrapper {
        padding: 8px;
        height: 50px;
    }

    #chat-input {
        height: 32px;
        font-size: 14px;
        padding: 6px 10px;
    }

    #upload-file,
    #send-chat {
        width: 32px;
        height: 32px;
    }
}

/* 橫向模式優化 */
@media (max-width: 896px) and (orientation: landscape) {
    .chat-container {
        height: 25vh !important;
    }

    .chat-content {
        padding-bottom: 45px;
    }

    .chat-input-wrapper {
        height: 45px;
        padding: 6px 8px;
    }
}

/* 訊息樣式 */
.sent-message,
.received-message {
    margin-bottom: 10px;
    max-width: 80%;
    padding: 8px 12px;
    border-radius: 15px;
}

.sent-message {
    margin-left: auto;
    background: #2988e5;
    color: #fff;
    border-radius: 15px 15px 0 15px;
}

.received-message {
    margin-right: auto;
    background: rgba(41, 136, 229, 0.1);
    color: #333;
    border-radius: 15px 15px 15px 0;
}

.system-message {
    text-align: center;
    color: rgba(41, 136, 229, 0.6);
    margin: 8px 0;
    font-style: italic;
    font-size: 12px;
}

/* 錄影計時器樣式 */
#recording-timer {
    background: rgba(220, 53, 69, 0.1);
    color: #dc3545;
    padding: 5px 10px;
    border-radius: 4px;
    font-family: monospace;
    margin-left: 10px;
    border: 1px solid rgba(220, 53, 69, 0.2);
}

/* 響應式設計 */
@media (max-width: 768px) {
    .container-fluid {
        padding: 10px;
    }
    
    .video-container.pip-layout .local-video-container {
        width: 120px;
        height: 80px;
    }
    
    .call-items {
        flex-wrap: wrap;
        justify-content: center;
    }
}

/* 白板相關樣式 */
.whiteboard-container {
    position: relative;
    width: 100%;
    height: calc(100vh - 120px);
    background: #fff;
    display: none;
    margin: 10px 0;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.whiteboard-container.active {
    display: block;
}

#whiteboard-canvas {
    width: 100%;
    height: 100%;
    border-radius: 12px;
}

.whiteboard-tools {
    position: absolute;
    left: 10px;
    top: 10px;
    background: rgba(255, 255, 255, 0.95);
    border-radius: 6px;
    padding: 6px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    gap: 6px;
    z-index: 1000;
}

.tool-group {
    display: flex;
    flex-direction: column;
    gap: 3px;
}

.tool-button {
    width: 32px;
    height: 32px;
    border: none;
    border-radius: 4px;
    background: #fff;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #333;
    transition: all 0.2s;
    font-size: 14px;
}

.tool-button:hover {
    background: #f0f0f0;
}

.tool-button.active {
    background: #2988e5;
    color: #fff;
}

.color-picker {
    width: 32px;
    height: 32px;
    padding: 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.brush-size {
    width: 32px;
    height: 32px;
    padding: 4px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 12px;
}

/* 視訊/白板切換按鈕樣式 */
.view-toggle {
    position: absolute;
    top: 20px;
    right: 20px;
    z-index: 1000;
    display: flex;
    gap: 10px;
    background: rgba(255, 255, 255, 0.95);
    padding: 5px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.view-toggle button {
    padding: 8px 15px;
    border: none;
    border-radius: 4px;
    background: #fff;
    cursor: pointer;
    font-size: 14px;
    color: #333;
    transition: all 0.2s;
}

.view-toggle button.active {
    background: #2988e5;
    color: #fff;
}
</style>

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- 视频区 -->
      <div class="col-md-8">
        <div class="call-main-wrapper">
          <div class="call-window">
            <!-- 視訊/白板切換按鈕 -->
            <div class="view-toggle">
                <button id="video-view-btn" class="active">視訊畫面</button>
                <button id="whiteboard-view-btn">白板</button>
            </div>
            
            <!-- 視訊容器 -->
            <div class="video-container active">
                <video id="remoteVideo" class="remote-video" autoplay></video>
                <video id="localVideo" class="local-video" autoplay muted></video>
            </div>
            
            <!-- 白板容器 -->
            <div class="whiteboard-container">
                <canvas id="whiteboard-canvas"></canvas>
                <div class="whiteboard-tools">
                    <div class="tool-group">
                        <button class="tool-button active" data-tool="pencil">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button class="tool-button" data-tool="line">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button class="tool-button" data-tool="rectangle">
                            <i class="far fa-square"></i>
                        </button>
                        <button class="tool-button" data-tool="circle">
                            <i class="far fa-circle"></i>
                        </button>
                        <button class="tool-button" data-tool="text">
                            <i class="fas fa-font"></i>
                        </button>
                        <button class="tool-button" data-tool="eraser">
                            <i class="fas fa-eraser"></i>
                        </button>
                    </div>
                    <div class="tool-group">
                        <input type="color" class="color-picker" value="#000000">
                        <input type="number" class="brush-size" value="2" min="1" max="50">
                    </div>
                    <div class="tool-group">
                        <button class="tool-button" data-action="clear">
                            <i class="fas fa-trash"></i>
                        </button>
                        <button class="tool-button" data-action="undo">
                            <i class="fas fa-undo"></i>
                        </button>
                        <button class="tool-button" data-action="redo">
                            <i class="fas fa-redo"></i>
                        </button>
                        <button class="tool-button" data-action="save">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                </div>
            </div>
          </div>
          <div class="call-footer">
            <div class="call-icons">
              <ul class="call-items">
                <!-- 控制按钮 -->
                <li class="call-item">
                  <a href="javascript:void(0);" id="toggle-video" title="Enable Video" data-placement="top"
                    data-bs-toggle="tooltip">
                    <i id="video-icon" class="fas fa-video camera"></i>
                  </a>
                </li>
                <li class="call-item">
                  <a href="javascript:void(0);" id="toggle-audio" title="Mute Audio" data-placement="top"
                    data-bs-toggle="tooltip">
                    <i id="audio-icon" class="fa fa-microphone microphone"></i>
                  </a>
                </li>
                <li class="call-item">
                  <a href="javascript:void(0);" id="end-call" title="End Call" data-placement="top"
                    data-bs-toggle="tooltip">
                    <i class="material-icons">call_end</i>
                  </a>
                </li>
                <li class="call-item">
                  <a href="javascript:void(0);" id="toggle-fullscreen" title="Toggle Fullscreen"
                    data-placement="top" data-bs-toggle="tooltip">
                    <i id="fullscreen-icon" class="fas fa-expand"></i>
                  </a>
                </li>
                <li class="call-item">
                  <a href="javascript:void(0);" id="share-screen" title="Share Screen" data-placement="top"
                    data-bs-toggle="tooltip">
                    <i class="fas fa-desktop"></i>
                  </a>
                </li>
                <!-- 錄影按鈕 -->
                <li class="call-item">
                  <a href="javascript:void(0);" id="toggle-recording" title="開始錄影" data-placement="top"
                    data-bs-toggle="tooltip">
                    <i class="fas fa-record-vinyl"></i>
                  </a>
                </li>
                <span id="recording-timer" style="display: none; color: red; margin-right: 10px;">00:00</span>
                <!-- 布局切换按钮 -->
                <li class="call-item">
                  <a href="javascript:void(0);" id="layout-pip" title="画中画布局" data-placement="top"
                    data-bs-toggle="tooltip">
                    <i class="fas fa-th-large"></i>
                  </a>
                </li>
                <li class="call-item">
                  <a href="javascript:void(0);" id="layout-grid" title="网格布局" data-placement="top"
                    data-bs-toggle="tooltip">
                    <i class="fas fa-th"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!-- 文字消息区 -->
      <div class="col-md-4">
        <div class="chat-container">
          <div class="chat-header">
            <h5>聊天室</h5>
            <a href="javascript:void(0);" class="close-chat"><i class="fas fa-times"></i></a>
          </div>
          <div class="chat-content">
            <div class="chat-box" id="chat-box"></div>
            <div class="chat-input-wrapper">
              <input type="file" id="file-input" style="display: none;">
              <button id="upload-file"><i class="fas fa-paperclip"></i></button>
              <input type="text" id="chat-input" placeholder="发送消息">
              <button id="send-chat"><i class="fas fa-paper-plane"></i></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection

  @section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.0.1/socket.io.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/simple-peer/9.10.0/simplepeer.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.1/fabric.min.js"></script>

  <script>
    const socket = io('https://enggletalk.com.tw:3000');
    const roomId = "{{ $roomId }}";
    const userName = "{{ Auth::user()->first_name }}";
    let peers = {};
    let localStream;
    let screenStream;
    let isInitiator = false;
    let mediaRecorder;
    let recordedChunks = [];
    let isRecording = false;
    let recordingTimer;
    let recordingStartTime;
    let canvas;
    let currentTool = 'pencil';
    let drawingColor = '#000000';
    let brushSize = 2;
    let isDrawing = false;
    const userRole = "{{ Auth::user()->role }}";

    document.addEventListener('DOMContentLoaded', function() {
        initializeApp();
        initializeWhiteboard();
        setupWhiteboardTools();
        setupViewToggle();
    });

    function initializeApp() {
      requestNotificationPermission();
      initializeMediaAndJoinRoom();
      setupSocketListeners();
      setupUIControls();
      setupLayoutControls();
      setupRecording();
      document.getElementById('share-screen').addEventListener('click', startScreenSharing);
    }

    async function initializeMediaAndJoinRoom() {
      try {
        localStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
        document.getElementById('localVideo').srcObject = localStream;
        socket.emit('join-room', { roomId, firstName: userName });
      } catch (error) {
        console.error('Error accessing media devices.', error);
        alert('无法访问媒体设备，请确保已授予摄像头和麦克风权限。');
      }
    }

    function startScreenSharing() {
      if (!navigator.mediaDevices.getDisplayMedia) {
        alert('當前浏览器不支持屏幕共享功能，請尝试使用 Chrome 或 Firefox。');
        return;
      }

      navigator.mediaDevices.getDisplayMedia({ 
        video: true,
        audio: false  // 禁用系統音訊
      })
        .then(stream => {
          handleScreenShare(stream);

          // 設置當前用戶為發起者，並在控制台打印
          isInitiator = true;
          console.log('屏幕共享已開始，當前用戶已成為發起者:', socket.id);

          // 通知服務器和其他用戶當前用戶是新的發起者
          socket.emit('update-initiator', { roomId, initiatorId: socket.id });
        })
        .catch(handleScreenShareError);
    }

    function handleScreenShare(stream) {
      screenStream = stream;
      const screenTrack = stream.getVideoTracks()[0];
      const remoteVideo = document.getElementById('remoteVideo');
      const localVideo = document.getElementById('localVideo');
      
      // 1. 創建新的 MediaStream
      const combinedStream = new MediaStream();
      
      // 2. 添加螢幕分享視訊軌道
      combinedStream.addTrack(screenTrack);
      
      // 3. 添加本地麥克風音訊
      if (localStream && localStream.getAudioTracks().length > 0) {
        const audioTrack = localStream.getAudioTracks()[0];
        audioTrack.enabled = true;
        combinedStream.addTrack(audioTrack);
      }
      
      // 4. 設置主視窗顯示（螢幕分享）
      remoteVideo.srcObject = combinedStream;
      remoteVideo.muted = true; // 在分享方設備上靜音，避免回音
      
      // 5. 設置子視窗（顯示對方的攝影機）
      const peerStream = getRemotePeerStream();
      if (peerStream) {
        const peerVideoTrack = peerStream.getVideoTracks()[0];
        const peerAudioTrack = peerStream.getAudioTracks()[0];
        
        // 創建新的流，包含對方的視訊和音訊
        const peerCombinedStream = new MediaStream();
        if (peerVideoTrack) {
          peerCombinedStream.addTrack(peerVideoTrack);
        }
        if (peerAudioTrack) {
          peerCombinedStream.addTrack(peerAudioTrack);
        }
        
        localVideo.srcObject = peerCombinedStream;
        localVideo.muted = false; // 允許聽到對方的聲音
      }
      
      // 6. 廣播給對方
      Object.values(peers).forEach(peer => {
        try {
          // 移除現有軌道
          const senders = peer._pc.getSenders();
          senders.forEach(sender => {
            if (sender.track) {
              peer._pc.removeTrack(sender);
            }
          });

          // 創建要發送的流
          const streamToSend = new MediaStream();
          
          // 添加螢幕分享視訊
          streamToSend.addTrack(screenTrack);
          
          // 添加本地攝影機視訊
          if (localStream && localStream.getVideoTracks().length > 0) {
            const cameraTrack = localStream.getVideoTracks()[0];
            streamToSend.addTrack(cameraTrack);
          }
          
          // 添加本地麥克風音訊
          if (localStream && localStream.getAudioTracks().length > 0) {
            const audioTrack = localStream.getAudioTracks()[0];
            audioTrack.enabled = true;
            streamToSend.addTrack(audioTrack);
          }

          // 發送所有軌道
          streamToSend.getTracks().forEach(track => {
            peer.addTrack(track, streamToSend);
          });
          
        } catch (error) {
          console.error('Error while updating tracks:', error);
        }
      });

      // 監聽螢幕分享結束事件
      screenTrack.onended = () => {
        stopScreenSharing();
      };

      // 通知對方開始螢幕分享
      socket.emit('screen-sharing-started', { roomId });
    }

    // 修改對方開始螢幕分享的處理事件
    socket.on('screen-sharing-started', () => {
      const peerStream = getRemotePeerStream();
      if (peerStream) {
        const remoteVideo = document.getElementById('remoteVideo');
        const localVideo = document.getElementById('localVideo');
        
        const videoTracks = peerStream.getVideoTracks();
        const audioTracks = peerStream.getAudioTracks();
        
        if (videoTracks.length >= 2) {
          // 主視窗顯示對方的螢幕分享
          const screenStream = new MediaStream([videoTracks[0]]); // 螢幕分享視訊
          const cameraStream = new MediaStream([videoTracks[1]]); // 攝影機視訊
          
          // 添加音訊軌道到螢幕分享流中
          if (audioTracks.length > 0) {
            screenStream.addTrack(audioTracks[0]);
          }
          
          remoteVideo.srcObject = screenStream;
          remoteVideo.muted = false; // 確保能聽到對方的聲音
          
          // 在子視窗顯示對方的攝影機畫面
          localVideo.srcObject = cameraStream;
          localVideo.muted = true; // 本地視訊靜音避免回音
        }
      }
    });

    function stopScreenSharing() {
      if (screenStream) {
        screenStream.getTracks().forEach(track => track.stop());
        
        // 恢復原始視訊布局
        const remoteVideo = document.getElementById('remoteVideo');
        const localVideo = document.getElementById('localVideo');
        
        // 恢復正常視訊布局
        const peerStream = getRemotePeerStream();
        if (peerStream) {
          remoteVideo.srcObject = peerStream;
          localVideo.srcObject = localStream;
        }
        
        // 通知對方螢幕分享已結束
        socket.emit('screen-sharing-stopped', { roomId });
        
        screenStream = null;
        
        // 重新廣播自己的攝像頭流
        broadcastLocalStream(localStream);
      }
    }

    // 新增處理對方結束螢幕分享的事件
    socket.on('screen-sharing-stopped', () => {
      const localVideo = document.getElementById('localVideo');
      const remoteVideo = document.getElementById('remoteVideo');
      
      // 恢復正常視訊布局
      const peerStream = getRemotePeerStream();
      if (peerStream) {
        remoteVideo.srcObject = peerStream;
        localVideo.srcObject = localStream;
      }
    });

    function getRemotePeerStream() {
      const peerWithStream = Object.values(peers).find(peer => peer.remoteStream);
      if (peerWithStream) {
        console.log('Found remote peer stream:', peerWithStream.remoteStream);
        return peerWithStream.remoteStream;
      }
      console.log('No remote peer stream found');
      return null;
    }

    function handleScreenShareError(error) {
      console.error('Error accessing display media:', error);
      alert(`无法共享屏幕：${error.message}\n请确保您已授予权限或使用支持屏幕共享的浏览器。`);
    }

    function broadcastLocalStream(stream) {
      Object.values(peers).forEach(peer => {
        stream.getTracks().forEach(track => {
          peer.addTrack(track, stream); // 将本地流传送给远端
        });
      });
    }

    function requestNotificationPermission() {
      if (Notification.permission === 'default') {
        Notification.requestPermission().then(permission => {
          if (permission === 'granted') {
            console.log('通知权限已授予');
          }
        });
      }
    }

    function showNotification(title, message) {
      if (Notification.permission === 'granted') {
        const options = {
          body: message,
          icon: '/assets/img/letter.png' // 你可以使用自定义图标
        };
        new Notification(title, options);
        playNotificationSound(); // 播放通知声音
      }
    }

    function playNotificationSound() {
      const audio = new Audio('/assets/audio/pq4wm-7gdpc.mp3');
      audio.play();
    }

    function addMessageToChatBox(sender, message, isLocal = false) {
      const chatBox = document.getElementById('chat-box');
      const messageElement = document.createElement('div');
      let content = '';

      if (sender === '系统') {
        messageElement.classList.add('system-message');
        content = `<div class="message-content"><em>${message}</em></div>`;
      } else if (isLocal) {
        messageElement.classList.add('sent-message');
        content = `<div class="message-content">${message}</div>`;
      } else {
        messageElement.classList.add('received-message');
        content = `<div class="message-content">${sender}: ${message}</div>`;
      }

      messageElement.innerHTML = content;
      chatBox.appendChild(messageElement);
      chatBox.scrollTop = chatBox.scrollHeight;

      if (!isLocal && sender !== '系统') {
        showNotification('新消息', `${sender}: ${message}`);
      }
    }

    function addFileToChatBox(sender, fileData, fileName) {
      const chatBox = document.getElementById('chat-box');
      const fileElement = document.createElement('div');

      if (fileData.startsWith('data:image/')) {
        // 生成图片缩略图并提供直接下载链接
        fileElement.innerHTML = `
            <strong>${sender}:</strong><br>
            <a href="${fileData}" download="${fileName}">
                <img src="${fileData}" alt="${fileName}" style="max-width: 100px; height: auto;">
            </a>`;
      } else {
        // 非图片文件的下载链接
        fileElement.innerHTML = `
            <strong>${sender}:</strong><br>
            <a href="${fileData}" download="${fileName}">${fileName}</a>`;
      }

      chatBox.appendChild(fileElement);
      chatBox.scrollTop = chatBox.scrollHeight;

      // 对方发送的文件显示通知
      if (sender !== 'You') {
        showNotification('新文件', `${sender} 发送了一个文件: ${fileName}`);
      }
    }

    function displayReceivedFile(data) {
      addFileToChatBox(data.sender, data.thumbnailData || data.fileData, data.fileName);
    }

    function handleSignal(peer, data, userId) {
      if (peer) {
        peer.signal(data.signal);
      } else {
        const newPeer = createPeer(false, localStream, userId);
        peers[userId] = newPeer;
        newPeer.signal(data.signal);
      }
    }

    function createPeer(initiator, stream, userId) {
      const peer = new SimplePeer({
        initiator,
        trickle: false,
        stream,
        config: {
          iceServers: [
            { urls: 'stun:stun.l.google.com:19302' },
            { urls: 'turn:97.74.92.111:3478', username: 'root', credential: 'appetite123' }
          ]
        }
      });

      peer.on('signal', data => socket.emit('signal', { signal: data, to: userId, from: socket.id }));

      peer.on('stream', remoteStream => {
        console.log('Received remote stream:', remoteStream);
        peers[userId].remoteStream = remoteStream;
        
        const videoTracks = remoteStream.getVideoTracks();
        const audioTracks = remoteStream.getAudioTracks();
        console.log('Received video tracks:', videoTracks.length);
        
        try {
          if (videoTracks.length >= 2) {
            // 收到包含螢幕分享和攝像頭的流
            const screenTrack = videoTracks[0];
            const cameraTrack = videoTracks[1];
            
            // 創建新的流來分離螢幕分享和攝像頭
            const screenStream = new MediaStream([screenTrack]);
            const cameraStream = new MediaStream([cameraTrack]);
            
            // 添加音訊軌道到螢幕分享流中
            audioTracks.forEach(track => {
              screenStream.addTrack(track);
            });
            
            // 設置螢幕分享到主視窗
            document.getElementById('remoteVideo').srcObject = screenStream;
            remoteVideo.muted = false; // 確保能聽到對方的聲音
            
            // 設置對方的攝像頭到小視窗，但保持本地音訊流
            const localVideoElement = document.getElementById('localVideo');
            if (localStream) {
              // 創建組合流：對方攝像頭 + 本地音訊
              const combinedStream = new MediaStream([cameraTrack]);
              localStream.getAudioTracks().forEach(track => {
                combinedStream.addTrack(track);
              });
              localVideoElement.srcObject = combinedStream;
              localVideoElement.muted = true; // 本地音訊靜音避免回音
            }
            
          } else if (videoTracks.length === 1) {
            // 正常視訊通話
            document.getElementById('remoteVideo').srcObject = remoteStream;
            document.getElementById('localVideo').srcObject = localStream;
          }
        } catch (error) {
          console.error('Error while handling remote stream:', error);
        }
      });

      peer.on('error', err => {
        console.error('Peer connection error:', err);
        // 嘗試重新建立連接
        if (err.code === 'ERR_DATA_CHANNEL') {
          setTimeout(() => {
            console.log('Attempting to reconnect...');
            createPeer(initiator, stream, userId);
          }, 2000);
        }
      });

      peer.on('close', () => {
        console.log('Peer connection closed with:', userId);
        delete peers[userId];
        if (screenStream) {
          stopScreenSharing();
        }
      });

      return peer;
    }

    function setupSocketListeners() {
      const events = {
        'userJoined': username => showNotification('用户加入', `${username} 加入了房间`),
        'userLeft': username => showNotification('用户离开', `${username} 离开了房间`),
        'chat-message': data => addMessageToChatBox(data.sender, data.message),
        'file-received': data => displayReceivedFile(data),
        'signal': data => handleSignal(peers[data.from], data, data.from),
        'user-connected': userId => {
          let isInitiator = Object.keys(peers).length === 0; // 第一個進入房間的用戶為發起者
          peers[userId] = createPeer(isInitiator, localStream, userId);
          showNotification('用户加入', `${userId} 加入了房间`);
        },
        'user-disconnected': userId => {
          if (peers[userId]) {
            peers[userId].destroy();
            delete peers[userId];
          }
          showNotification('用户离开', `${userId} 离开了房间`);
        },
        'new-initiator': data => {
          const newInitiatorId = data.initiatorId;

          // 更新當前用戶是否是發起者
          if (socket.id !== newInitiatorId) {
            isInitiator = false; // 自己不再是發起者
          } else {
            isInitiator = true; // 自己是新的發起者
          }

          console.log(`新的发起者是：${newInitiatorId}`);
        }
      };

      Object.entries(events).forEach(([event, handler]) => socket.on(event, handler));
    }

    function setupUIControls() {
      const elements = {
        chatInput: document.getElementById('chat-input'),
        sendChatBtn: document.getElementById('send-chat'),
        fileInput: document.getElementById('file-input'),
        uploadFileBtn: document.getElementById('upload-file'),
        toggleVideoBtn: document.getElementById('toggle-video'),
        toggleAudioBtn: document.getElementById('toggle-audio'),
        endCallBtn: document.getElementById('end-call'),
        toggleFullscreenBtn: document.getElementById('toggle-fullscreen'),
        videoIcon: document.getElementById('video-icon'),
        audioIcon: document.getElementById('audio-icon'),
        videoContainer: document.querySelector('.video-container'),
        remoteVideo: document.getElementById('remoteVideo'),
        localVideo: document.getElementById('localVideo')
      };

      let isFullscreen = false;

      elements.chatInput.addEventListener('keydown', event => {
        if (event.key === 'Enter') {
          event.preventDefault();
          sendChatMessage();
        }
      });

      elements.sendChatBtn.addEventListener('click', sendChatMessage);
      elements.uploadFileBtn.addEventListener('click', () => elements.fileInput.click());
      elements.fileInput.addEventListener('change', handleFileUpload);

      elements.toggleVideoBtn.addEventListener('click', () => toggleTrack('video', elements.videoIcon));
      elements.toggleAudioBtn.addEventListener('click', () => toggleTrack('audio', elements.audioIcon));

      elements.endCallBtn.addEventListener('click', endCall);
      elements.toggleFullscreenBtn.addEventListener('click', toggleFullscreen);

      function sendChatMessage() {
        const message = elements.chatInput.value.trim();
        if (message) {
          addMessageToChatBox(userName, message, true);
          socket.emit('chat-message', { roomId, message, sender: userName });
          elements.chatInput.value = '';
        }
      }

      function toggleTrack(kind, icon) {
        const track = localStream.getTracks().find(track => track.kind === kind);
        track.enabled = !track.enabled;
        if (kind === 'video') {
          icon.classList.toggle('fa-video-slash', !track.enabled);
          icon.classList.toggle('fa-video', track.enabled);
        } else if (kind === 'audio') {
          icon.classList.toggle('fa-microphone-slash', !track.enabled);
          icon.classList.toggle('fa-microphone', track.enabled);
        }
      }

      function endCall() {
        socket.emit('leave-room', roomId);
        Object.values(peers).forEach(peer => peer.destroy());
        localStream.getTracks().forEach(track => track.stop());
        
        if (userRole === 'mentee') {
            window.location.href = '/bookings_mentee';
        } else if (userRole === 'mentor') {
            window.location.href = '/bookings_mentor';
        }
      }

      function toggleFullscreen() {
        if (!isFullscreen) {
          enterFullscreen(elements.videoContainer);
        } else {
          exitFullscreen();
        }
      }

      function enterFullscreen(element) {
        if (element.requestFullscreen) {
          element.requestFullscreen();
        } else if (element.mozRequestFullScreen) {
          element.mozRequestFullScreen();
        } else if (element.webkitRequestFullscreen) {
          element.webkitRequestFullscreen();
        } else if (element.msRequestFullscreen) {
          element.msRequestFullscreen();
        }
        element.classList.add('fullscreen');
        resizeVideos();
      }

      function exitFullscreen() {
        if (document.exitFullscreen) {
          document.exitFullscreen();
        } else if (document.mozCancelFullScreen) {
          document.mozCancelFullScreen();
        } else if (document.webkitExitFullscreen) {
          document.webkitExitFullscreen();
        } else if (document.msExitFullscreen) {
          document.msExitFullscreen();
        }
        elements.videoContainer.classList.remove('fullscreen');
        resizeVideos();
      }

      function resizeVideos() {
        const isFullscreen = elements.videoContainer.classList.contains('fullscreen');
        if (isFullscreen) {
          elements.remoteVideo.style.width = '100%';
          elements.remoteVideo.style.height = '100%';
          // elements.localVideo.style.width = '20%';  // 或者您想要的大小
          elements.localVideo.style.height = 'auto';
        } else {
          elements.remoteVideo.style.width = '';
          elements.remoteVideo.style.height = '';
          elements.localVideo.style.width = '';
          elements.localVideo.style.height = '';
        }
      }

      document.addEventListener('fullscreenchange', handleFullscreenChange);
      document.addEventListener('webkitfullscreenchange', handleFullscreenChange);
      document.addEventListener('mozfullscreenchange', handleFullscreenChange);
      document.addEventListener('MSFullscreenChange', handleFullscreenChange);

      function handleFullscreenChange() {
        isFullscreen = !!document.fullscreenElement;
        const icon = elements.toggleFullscreenBtn.querySelector('i');
        if (isFullscreen) {
          icon.classList.replace('fa-expand', 'fa-compress');
        } else {
          icon.classList.replace('fa-compress', 'fa-expand');
        }
      }
    }

    function setupLayoutControls() {
      const videoContainer = document.querySelector('.video-container');
      const pipLayoutBtn = document.getElementById('layout-pip');
      const gridLayoutBtn = document.getElementById('layout-grid');

      // 将 pip-layout 设置为默认布局，页面加载时保持该布局
      videoContainer.classList.add('pip-layout');

      pipLayoutBtn.addEventListener('click', function () {
        videoContainer.classList.remove('grid-layout');
        videoContainer.classList.add('pip-layout');
      });

      gridLayoutBtn.addEventListener('click', function () {
        videoContainer.classList.remove('pip-layout');
        videoContainer.classList.add('grid-layout');
      });
    }

    function handleFileUpload(event) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
          const fileData = e.target.result;
          let dataToSend = {
            roomId: roomId,
            fileName: file.name,
            fileData: fileData,
            fileType: file.type,
            sender: userName
          };

          // 显示文件在本地聊天框中
          addFileToChatBox(userName, fileData, file.name);

          // 发送数据到服务器
          if (file.type.startsWith('image/')) {
            createThumbnail(fileData, 100, 100, (thumbnailData) => {
              dataToSend.thumbnailData = thumbnailData;
              socket.emit('file-upload', dataToSend);
            });
          } else {
            socket.emit('file-upload', dataToSend);
          }
        };
        reader.readAsDataURL(file);
      }
    }

    function createThumbnail(dataUrl, maxWidth, maxHeight, callback) {
      const img = new Image();
      img.onload = function () {
        const canvas = document.createElement('canvas');
        let width = img.width;
        let height = img.height;

        if (width > height) {
          if (width > maxWidth) {
            height *= maxWidth / width;
            width = maxWidth;
          }
        } else {
          if (height > maxHeight) {
            width *= maxHeight / height;
            height = maxHeight;
          }
        }

        canvas.width = width;
        canvas.height = height;
        canvas.getContext('2d').drawImage(img, 0, 0, width, height);
        const thumbnailData = canvas.toDataURL('image/png');
        callback(thumbnailData);
      };
      img.src = dataUrl;
    }

    function setupRecording() {
      const recordButton = document.getElementById('toggle-recording');
      const recordingTimer = document.getElementById('recording-timer');
      
      recordButton.addEventListener('click', toggleRecording);
    }

    function toggleRecording() {
      if (!isRecording) {
        startRecording();
      } else {
        stopRecording();
      }
    }

    function startRecording() {
      try {
        const remoteVideo = document.getElementById('remoteVideo');
        const localVideo = document.getElementById('localVideo');
        
        // 創建畫布
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');
        
        // 設置畫布大小
        canvas.width = remoteVideo.videoWidth;
        canvas.height = remoteVideo.videoHeight;
        
        // 創建合併的音訊流
        const audioContext = new AudioContext();
        const destination = audioContext.createMediaStreamDestination();
        
        // 獲取遠端音訊
        if (remoteVideo.srcObject) {
          const remoteAudioTracks = remoteVideo.srcObject.getAudioTracks();
          if (remoteAudioTracks.length > 0) {
            const remoteAudioStream = new MediaStream([remoteAudioTracks[0]]);
            const remoteAudioSource = audioContext.createMediaStreamSource(remoteAudioStream);
            remoteAudioSource.connect(destination);
          }
        }
        
        // 獲取本地音訊
        if (localStream && localStream.getAudioTracks().length > 0) {
          const localAudioStream = new MediaStream([localStream.getAudioTracks()[0]]);
          const localAudioSource = audioContext.createMediaStreamSource(localAudioStream);
          localAudioSource.connect(destination);
        }
        
        // 創建錄影串流
        const canvasStream = canvas.captureStream(30); // 30 FPS
        const audioStream = destination.stream;
        const tracks = [...canvasStream.getTracks(), ...audioStream.getTracks()];
        const recordingStream = new MediaStream(tracks);
        
        // 初始化 MediaRecorder
        mediaRecorder = new MediaRecorder(recordingStream, {
          mimeType: 'video/webm;codecs=vp9,opus'
        });
        
        recordedChunks = [];
        mediaRecorder.ondataavailable = handleDataAvailable;
        mediaRecorder.onstop = handleStop;
        
        // 開始錄影
        mediaRecorder.start(1000);
        isRecording = true;
        
        // 更新 UI
        const recordButton = document.getElementById('toggle-recording');
        recordButton.innerHTML = '<i class="fas fa-stop-circle"></i>';
        recordButton.title = '停止錄影';
        
        // 顯示計時器
        recordingStartTime = Date.now();
        const timerDisplay = document.getElementById('recording-timer');
        timerDisplay.style.display = 'inline';
        startTimer();
        
        // 開始繪製畫面
        function drawFrame() {
          if (!isRecording) return;
          
          // 繪製遠端視訊
          ctx.drawImage(remoteVideo, 0, 0, canvas.width, canvas.height);
          
          // 在右下角繪製本地視訊
          const localWidth = canvas.width * 0.2;
          const localHeight = (localWidth / localVideo.videoWidth) * localVideo.videoHeight;
          const localX = canvas.width - localWidth - 10;
          const localY = canvas.height - localHeight - 10;
          
          ctx.drawImage(localVideo, localX, localY, localWidth, localHeight);
          
          requestAnimationFrame(drawFrame);
        }
        
        drawFrame();
        
      } catch (error) {
        console.error('Error starting recording:', error);
        alert('無法開始錄影：' + error.message);
      }
    }

    function startTimer() {
      const timerDisplay = document.getElementById('recording-timer');
      recordingTimer = setInterval(() => {
        const elapsed = Date.now() - recordingStartTime;
        const minutes = Math.floor(elapsed / 60000);
        const seconds = Math.floor((elapsed % 60000) / 1000);
        timerDisplay.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
      }, 1000);
    }

    function handleDataAvailable(event) {
      if (event.data.size > 0) {
        recordedChunks.push(event.data);
      }
    }

    function handleStop() {
      const blob = new Blob(recordedChunks, { type: 'video/webm' });
      const url = URL.createObjectURL(blob);
      const a = document.createElement('a');
      const timestamp = new Date().toISOString().replace(/[:.]/g, '-');
      a.href = url;
      a.download = `recorded-session-${timestamp}.webm`;
      a.click();
      URL.revokeObjectURL(url);
    }

    function stopRecording() {
      if (mediaRecorder && isRecording) {
        mediaRecorder.stop();
        isRecording = false;
        
        // 更新 UI
        const recordButton = document.getElementById('toggle-recording');
        recordButton.innerHTML = '<i class="fas fa-record-vinyl"></i>';
        recordButton.title = '開始錄影';
        
        // 停止計時器
        clearInterval(recordingTimer);
        const timerDisplay = document.getElementById('recording-timer');
        timerDisplay.style.display = 'none';
      }
    }

    function setupViewToggle() {
      const videoBtn = document.getElementById('video-view-btn');
      const whiteboardBtn = document.getElementById('whiteboard-view-btn');
      const videoContainer = document.querySelector('.video-container');
      const whiteboardContainer = document.querySelector('.whiteboard-container');

      videoBtn.addEventListener('click', function() {
        videoContainer.style.display = 'block';
        whiteboardContainer.style.display = 'none';
        videoBtn.classList.add('active');
        whiteboardBtn.classList.remove('active');
      });

      whiteboardBtn.addEventListener('click', function() {
        videoContainer.style.display = 'none';
        whiteboardContainer.style.display = 'block';
        whiteboardBtn.classList.add('active');
        videoBtn.classList.remove('active');
        
        // 重新調整白板大小並重新渲染
        setTimeout(() => {
          resizeWhiteboard();
          if (canvas) {
            canvas.renderAll();
          }
        }, 100);
      });
    }

    function resizeWhiteboard() {
      if (!canvas) return;
      
      const container = document.querySelector('.whiteboard-container');
      const width = container.offsetWidth;
      const height = container.offsetHeight;
      
      canvas.setDimensions({
        width: width,
        height: height
      });
    }

    function initializeWhiteboard() {
        const whiteboardCanvas = document.getElementById('whiteboard-canvas');
        canvas = new fabric.Canvas('whiteboard-canvas', {
            isDrawingMode: true,
            width: whiteboardCanvas.offsetWidth,
            height: whiteboardCanvas.offsetHeight,
            backgroundColor: '#ffffff'
        });

        // 設置初始畫筆
        canvas.freeDrawingBrush.width = brushSize;
        canvas.freeDrawingBrush.color = drawingColor;
    }

    function setupWhiteboardTools() {
        // 工具按鈕點擊事件
        const toolButtons = document.querySelectorAll('.tool-button[data-tool]');
        toolButtons.forEach(button => {
            button.addEventListener('click', function() {
                const tool = this.dataset.tool;
                currentTool = tool;
                
                // 移除所有工具按鈕的 active 類
                toolButtons.forEach(btn => btn.classList.remove('active'));
                // 添加當前工具按鈕的 active 類
                this.classList.add('active');

                // 根據工具設置畫布模式
                switch(tool) {
                    case 'pencil':
                        canvas.isDrawingMode = true;
                        canvas.freeDrawingBrush.width = brushSize;
                        canvas.freeDrawingBrush.color = drawingColor;
                        break;
                    case 'text':
                        canvas.isDrawingMode = false;
                        addText();
                        break;
                    case 'eraser':
                        canvas.isDrawingMode = true;
                        canvas.freeDrawingBrush.width = brushSize * 2;
                        canvas.freeDrawingBrush.color = '#ffffff';
                        break;
                    default:
                        canvas.isDrawingMode = false;
                        break;
                }
            });
        });

        // 添加文字功能
        function addText() {
            const text = new fabric.IText('點擊編輯文字', {
                left: canvas.width / 2,
                top: canvas.height / 2,
                fontFamily: 'Arial',
                fontSize: brushSize * 10,
                fill: drawingColor,
                editable: true
            });
            
            canvas.add(text);
            canvas.setActiveObject(text);
            text.enterEditing();
            text.selectAll();
            canvas.renderAll();
        }

        // 顏色選擇器事件
        const colorPicker = document.querySelector('.color-picker');
        colorPicker.addEventListener('input', function(e) {
            drawingColor = e.target.value;
            if (currentTool !== 'eraser') {
                canvas.freeDrawingBrush.color = drawingColor;
                // 如果當前有選中的文字物件，更新其顏色
                const activeObject = canvas.getActiveObject();
                if (activeObject && activeObject.type === 'i-text') {
                    activeObject.set('fill', drawingColor);
                    canvas.renderAll();
                }
            }
        });

        // 筆刷大小事件
        const brushSizeInput = document.querySelector('.brush-size');
        brushSizeInput.addEventListener('input', function(e) {
            brushSize = parseInt(e.target.value);
            canvas.freeDrawingBrush.width = currentTool === 'eraser' ? brushSize * 2 : brushSize;
            // 如果當前有選中的文字物件，更新其字體大小
            const activeObject = canvas.getActiveObject();
            if (activeObject && activeObject.type === 'i-text') {
                activeObject.set('fontSize', brushSize * 10);
                canvas.renderAll();
            }
        });

        // 動作按鈕事件
        const actionButtons = document.querySelectorAll('.tool-button[data-action]');
        actionButtons.forEach(button => {
            button.addEventListener('click', function() {
                const action = this.dataset.action;
                switch(action) {
                    case 'clear':
                        canvas.clear();
                        canvas.backgroundColor = '#ffffff';
                        canvas.renderAll();
                        socket.emit('whiteboard-clear', { roomId });
                        break;
                    case 'undo':
                        // TODO: 實現撤銷功能
                        break;
                    case 'redo':
                        // TODO: 實現重做功能
                        break;
                    case 'save':
                        const dataURL = canvas.toDataURL({
                            format: 'png',
                            quality: 1
                        });
                        const link = document.createElement('a');
                        link.download = 'whiteboard.png';
                        link.href = dataURL;
                        link.click();
                        break;
                }
            });
        });

        // 監聽畫布變化並同步
        canvas.on('path:created', function() {
            syncCanvas();
        });

        canvas.on('text:changed', function() {
            syncCanvas();
        });

        canvas.on('object:moving', function() {
            syncCanvas();
        });

        canvas.on('object:rotating', function() {
            syncCanvas();
        });

        canvas.on('object:scaling', function() {
            syncCanvas();
        });

        function syncCanvas() {
            const data = JSON.stringify(canvas.toJSON());
            socket.emit('whiteboard-draw', { roomId, data });
        }

        // 接收其他用戶的畫布更新
        socket.on('whiteboard-draw', function(data) {
            canvas.loadFromJSON(data, function() {
                canvas.renderAll();
            });
        });

        // 接收清除畫布的事件
        socket.on('whiteboard-clear', function() {
            canvas.clear();
            canvas.backgroundColor = '#ffffff';
            canvas.renderAll();
        });
    }
  </script>
  @endsection