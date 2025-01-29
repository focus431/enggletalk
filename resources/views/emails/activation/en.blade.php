<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Account Activation</title>
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
      <h1>Welcome to EnggleTalk</h1>
    </div>
    
    <p>Dear User,</p>
    
    <p>Thank you for registering with EnggleTalk! To ensure the security of your account, please click the button below to activate your account:</p>
    
    <div style="text-align: center;">
      <a href="{{ $activationUrl }}" class="button">Activate Account</a>
    </div>
    
    <p>If the button doesn't work, you can copy and paste the following link into your browser:<br>
    <small>{{ $activationUrl }}</small></p>
    
    <p>Please note: This activation link will expire in 24 hours. If you didn't register for an EnggleTalk account, please ignore this email.</p>
    
    <div class="footer">
      <p>Need help? Contact our support team:<br>
      <a href="mailto:support@enggletalk.com">support@enggletalk.com</a></p>
      
      <div class="social-links">
        <p>Follow us on social media:</p>
        <a href="#">Facebook</a> |
        <a href="#">Instagram</a> |
        <a href="#">LinkedIn</a>
      </div>
      
      <p>&copy; {{ date('Y') }} EnggleTalk. All rights reserved.</p>
    </div>
  </div>
</body>

</html>
