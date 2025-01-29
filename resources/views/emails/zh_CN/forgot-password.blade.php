<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>重置密码通知</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #2196F3;">重置密码通知</h2>
        
        <p>您好！</p>
        
        <p>我们收到了重置您密码的请求。如果这不是您发起的请求，请忽略此邮件。</p>
        
        <p>若要重置密码，请点击下方按钮：</p>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ url('password/reset', $token) }}" 
               style="background-color: #2196F3; 
                      color: white; 
                      padding: 12px 30px; 
                      text-decoration: none; 
                      border-radius: 5px; 
                      display: inline-block;">
                重置密码
            </a>
        </div>
        
        <p>或者，您可以复制以下链接到浏览器：</p>
        <p style="word-break: break-all; color: #2196F3;">
            {{ url('password/reset', $token) }}
        </p>
        
        <p>此链接将在 24 小时后失效。</p>
        
        <hr style="border: none; border-top: 1px solid #eee; margin: 30px 0;">
        
        <p style="color: #666; font-size: 12px;">
            如果您没有请求重置密码，无需采取任何操作。<br>
            此邮件由系统自动发送，请勿回复。
        </p>
    </div>
</body>
</html> 