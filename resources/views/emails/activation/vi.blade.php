<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kích hoạt tài khoản</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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
            <h1>Chào mừng đến với EnggleTalk</h1>
        </div>
        
        <p>Kính gửi người dùng,</p>
        
        <p>Cảm ơn bạn đã đăng ký EnggleTalk! Để đảm bảo an toàn cho tài khoản của bạn, vui lòng nhấp vào nút bên dưới để kích hoạt tài khoản:</p>
        
        <div style="text-align: center;">
            <a href="{{ $activationUrl }}" class="button">Kích hoạt tài khoản</a>
        </div>
        
        <p>Nếu nút không hoạt động, bạn có thể sao chép và dán liên kết sau vào trình duyệt của mình:<br>
        <small>{{ $activationUrl }}</small></p>
        
        <p>Lưu ý: Liên kết kích hoạt này sẽ hết hạn sau 24 giờ. Nếu bạn không đăng ký tài khoản EnggleTalk, vui lòng bỏ qua email này.</p>
        
        <div class="footer">
            <p>Cần giúp đỡ? Liên hệ với đội ngũ hỗ trợ của chúng tôi:<br>
            <a href="mailto:support@enggletalk.com">support@enggletalk.com</a></p>
            
            <div class="social-links">
                <p>Theo dõi chúng tôi trên mạng xã hội:</p>
                <a href="#">Facebook</a> |
                <a href="#">Instagram</a> |
                <a href="#">LinkedIn</a>
            </div>
            
            <p>&copy; {{ date('Y') }} EnggleTalk. Đã đăng ký bản quyền.</p>
        </div>
    </div>
</body>
</html> 