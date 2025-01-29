<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>账号激活</title>
    <style>
        body {
            font-family: 'Microsoft YaHei', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .email-container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            max-width: 200px;
            height: auto;
            margin-bottom: 20px;
        }
        h1 {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }
        p {
            margin-bottom: 20px;
            font-size: 16px;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            margin: 20px 0;
            text-align: center;
        }
        .button:hover {
            background-color: #45a049;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: #666;
        }
        .social-links {
            margin-top: 20px;
            text-align: center;
        }
        .social-links a {
            margin: 0 10px;
            color: #666;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <img src="{{ asset('assets/img/logo.png') }}" alt="EnggleTalk Logo" class="logo">
            <h1>欢迎加入 EnggleTalk</h1>
        </div>
        
        <p>亲爱的用户，您好：</p>
        
        <p>感谢您注册 EnggleTalk！为了确保您的账号安全，请点击下方按钮激活您的账号：</p>
        
        <div style="text-align: center;">
            <a href="{{ $activationUrl }}" class="button">激活账号</a>
        </div>
        
        <p>如果按钮无法点击，您也可以复制以下链接到浏览器中打开：<br>
        <small>{{ $activationUrl }}</small></p>
        
        <p>请注意：此激活链接将在 24 小时后失效。如果您没有注册 EnggleTalk 账号，请忽略此邮件。</p>
        
        <div class="footer">
            <p>需要帮助？请联系我们的支持团队：<br>
            <a href="mailto:support@enggletalk.com">support@enggletalk.com</a></p>
            
            <div class="social-links">
                <p>关注我们的社交媒体：</p>
                <a href="#">Facebook</a> |
                <a href="#">Instagram</a> |
                <a href="#">LinkedIn</a>
            </div>
            
            <p>&copy; {{ date('Y') }} EnggleTalk. 保留所有权利。</p>
        </div>
    </div>
</body>
</html> 