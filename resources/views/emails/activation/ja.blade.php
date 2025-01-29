<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>アカウントの有効化</title>
    <style>
        body {
            font-family: 'Hiragino Kaku Gothic Pro', 'Meiryo', sans-serif;
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
            <h1>EnggleTalkへようこそ</h1>
        </div>
        
        <p>お客様、</p>
        
        <p>EnggleTalkにご登録いただき、ありがとうございます！アカウントのセキュリティを確保するため、以下のボタンをクリックしてアカウントを有効化してください：</p>
        
        <div style="text-align: center;">
            <a href="{{ $activationUrl }}" class="button">アカウントを有効化する</a>
        </div>
        
        <p>ボタンが機能しない場合は、以下のリンクをブラウザにコピー＆ペーストしてください：<br>
        <small>{{ $activationUrl }}</small></p>
        
        <p>ご注意：この有効化リンクは24時間後に期限切れとなります。EnggleTalkアカウントを登録していない場合は、このメールを無視してください。</p>
        
        <div class="footer">
            <p>サポートが必要な場合は、サポートチームにお問い合わせください：<br>
            <a href="mailto:support@enggletalk.com">support@enggletalk.com</a></p>
            
            <div class="social-links">
                <p>ソーシャルメディアでフォローする：</p>
                <a href="#">Facebook</a> |
                <a href="#">Instagram</a> |
                <a href="#">LinkedIn</a>
            </div>
            
            <p>&copy; {{ date('Y') }} EnggleTalk. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
