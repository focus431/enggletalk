<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>계정 활성화</title>
    <style>
        body {
            font-family: 'Malgun Gothic', 'Apple SD Gothic Neo', sans-serif;
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
            <h1>EnggleTalk에 오신 것을 환영합니다</h1>
        </div>
        
        <p>안녕하세요,</p>
        
        <p>EnggleTalk에 가입해 주셔서 감사합니다! 계정의 보안을 위해 아래 버튼을 클릭하여 계정을 활성화해 주세요:</p>
        
        <div style="text-align: center;">
            <a href="{{ $activationUrl }}" class="button">계정 활성화</a>
        </div>
        
        <p>버튼이 작동하지 않는 경우, 아래 링크를 복사하여 브라우저에 붙여넣기 해주세요:<br>
        <small>{{ $activationUrl }}</small></p>
        
        <p>주의: 이 활성화 링크는 24시간 후에 만료됩니다. EnggleTalk 계정을 등록하지 않으셨다면 이 이메일을 무시해 주세요.</p>
        
        <div class="footer">
            <p>도움이 필요하신가요? 지원팀에 문의해 주세요:<br>
            <a href="mailto:support@enggletalk.com">support@enggletalk.com</a></p>
            
            <div class="social-links">
                <p>소셜 미디어에서 팔로우하세요:</p>
                <a href="#">Facebook</a> |
                <a href="#">Instagram</a> |
                <a href="#">LinkedIn</a>
            </div>
            
            <p>&copy; {{ date('Y') }} EnggleTalk. 모든 권리 보유.</p>
        </div>
    </div>
</body>
</html> 