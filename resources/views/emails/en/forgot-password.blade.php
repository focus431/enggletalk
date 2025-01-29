<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Password Reset Notification</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #2196F3;">Password Reset Notification</h2>
        
        <p>Hello!</p>
        
        <p>You are receiving this email because we received a password reset request for your account. If you did not request a password reset, please ignore this email.</p>
        
        <p>To reset your password, please click the button below:</p>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ url('password/reset', $token) }}" 
               style="background-color: #2196F3; 
                      color: white; 
                      padding: 12px 30px; 
                      text-decoration: none; 
                      border-radius: 5px; 
                      display: inline-block;">
                Reset Password
            </a>
        </div>
        
        <p>Or copy and paste this URL into your browser:</p>
        <p style="word-break: break-all; color: #2196F3;">
            {{ url('password/reset', $token) }}
        </p>
        
        <p>This password reset link will expire in 24 hours.</p>
        
        <hr style="border: none; border-top: 1px solid #eee; margin: 30px 0;">
        
        <p style="color: #666; font-size: 12px;">
            If you did not request a password reset, no further action is required.<br>
            This is an automated email, please do not reply.
        </p>
    </div>
</body>
</html> 