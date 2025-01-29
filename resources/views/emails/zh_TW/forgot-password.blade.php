<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>重置密碼通知</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #2196F3;">重置密碼通知</h2>
        
        <p>您好！</p>
        
        <p>我們收到了重置您密碼的請求。如果這不是您發起的請求，請忽略此郵件。</p>
        
        <p>若要重置密碼，請點擊下方按鈕：</p>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ url('password/reset', $token) }}" 
               style="background-color: #2196F3; 
                      color: white; 
                      padding: 12px 30px; 
                      text-decoration: none; 
                      border-radius: 5px; 
                      display: inline-block;">
                重置密碼
            </a>
        </div>
        
        <p>或者，您可以複製以下連結到瀏覽器：</p>
        <p style="word-break: break-all; color: #2196F3;">
            {{ url('password/reset', $token) }}
        </p>
        
        <p>此連結將在 24 小時後失效。</p>
        
        <hr style="border: none; border-top: 1px solid #eee; margin: 30px 0;">
        
        <p style="color: #666; font-size: 12px;">
            如果您沒有請求重置密碼，無需採取任何操作。<br>
            此郵件由系統自動發送，請勿回覆。
        </p>
    </div>
</body>
</html> 