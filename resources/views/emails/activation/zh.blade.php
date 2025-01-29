<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>帳號啟用</title>
    <style>
        body {
            font-family: 'Microsoft JhengHei', Arial, sans-serif;
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
            <h1>歡迎加入 EnggleTalk</h1>
        </div>
        
        <p>親愛的用戶，您好：</p>
        
        <p>感謝您註冊 EnggleTalk！為了確保您的帳號安全，請點擊下方按鈕啟用您的帳號：</p>
        
        <div style="text-align: center;">
            <a href="{{ $activationUrl }}" class="button">啟用帳號</a>
        </div>
        
        <p>如果按鈕無法點擊，您也可以複製以下連結到瀏覽器中開啟：<br>
        <small>{{ $activationUrl }}</small></p>
        
        <p>請注意：此啟用連結將在 24 小時後失效。如果您沒有註冊 EnggleTalk 帳號，請忽略此郵件。</p>
        
        <div class="footer">
            <p>需要協助？請聯繫我們的支援團隊：<br>
            <a href="mailto:support@enggletalk.com">support@enggletalk.com</a></p>
            
            <div class="social-links">
                <p>關注我們的社群媒體：</p>
                <a href="#">Facebook</a> |
                <a href="#">Instagram</a> |
                <a href="#">LinkedIn</a>
            </div>
            
            <p>&copy; {{ date('Y') }} EnggleTalk. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
