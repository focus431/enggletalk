<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>パスワードリセット通知</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #2196F3;">パスワードリセット通知</h2>
        
        <p>こんにちは！</p>
        
        <p>アカウントのパスワードリセットのリクエストを受け取りました。このリクエストをされていない場合は、このメールを無視してください。</p>
        
        <p>パスワードをリセットするには、以下のボタンをクリックしてください：</p>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ url('password/reset', $token) }}" 
               style="background-color: #2196F3; 
                      color: white; 
                      padding: 12px 30px; 
                      text-decoration: none; 
                      border-radius: 5px; 
                      display: inline-block;">
                パスワードリセット
            </a>
        </div>
        
        <p>または、以下のURLをブラウザにコピー＆ペーストしてください：</p>
        <p style="word-break: break-all; color: #2196F3;">
            {{ url('password/reset', $token) }}
        </p>
        
        <p>このリンクは24時間後に無効となります。</p>
        
        <hr style="border: none; border-top: 1px solid #eee; margin: 30px 0;">
        
        <p style="color: #666; font-size: 12px;">
            パスワードリセットをリクエストしていない場合は、何も操作する必要はありません。<br>
            これは自動送信メールです。返信はできません。
        </p>
    </div>
</body>
</html> 