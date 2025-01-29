const express = require('express');
const cors = require('cors'); // 导入 CORS 中间件

const app = express();

// 使用 CORS 中间件，允许所有来源的跨域请求
app.use(cors());

// 定义您的路由和其他中间件
app.get('/', (req, res) => {
  res.send('Hello, World!');
});

// 启动 Express 服务器
const port = process.env.PORT || 3000;
app.listen(port, () => {
  console.log(`Server is running on port ${port}`);
});
