<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Thông báo đặt lại mật khẩu</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #2196F3;">Thông báo đặt lại mật khẩu</h2>
        
        <p>Xin chào!</p>
        
        <p>Chúng tôi đã nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn. Nếu bạn không yêu cầu đặt lại mật khẩu, vui lòng bỏ qua email này.</p>
        
        <p>Để đặt lại mật khẩu, vui lòng nhấp vào nút bên dưới:</p>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ url('password/reset', $token) }}" 
               style="background-color: #2196F3; 
                      color: white; 
                      padding: 12px 30px; 
                      text-decoration: none; 
                      border-radius: 5px; 
                      display: inline-block;">
                Đặt lại mật khẩu
            </a>
        </div>
        
        <p>Hoặc sao chép và dán URL sau vào trình duyệt của bạn:</p>
        <p style="word-break: break-all; color: #2196F3;">
            {{ url('password/reset', $token) }}
        </p>
        
        <p>Liên kết này sẽ hết hạn sau 24 giờ.</p>
        
        <hr style="border: none; border-top: 1px solid #eee; margin: 30px 0;">
        
        <p style="color: #666; font-size: 12px;">
            Nếu bạn không yêu cầu đặt lại mật khẩu, không cần thực hiện thêm hành động nào.<br>
            Đây là email tự động, vui lòng không trả lời.
        </p>
    </div>
</body>
</html> 