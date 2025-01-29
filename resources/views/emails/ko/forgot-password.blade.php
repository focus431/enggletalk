<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>비밀번호 재설정 알림</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #2196F3;">비밀번호 재설정 알림</h2>
        
        <p>안녕하세요!</p>
        
        <p>귀하의 계정에 대한 비밀번호 재설정 요청을 받았습니다. 만약 비밀번호 재설정을 요청하지 않으셨다면 이 이메일을 무시하시기 바랍니다.</p>
        
        <p>비밀번호를 재설정하려면 아래 버튼을 클릭하세요:</p>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ url('password/reset', $token) }}" 
               style="background-color: #2196F3; 
                      color: white; 
                      padding: 12px 30px; 
                      text-decoration: none; 
                      border-radius: 5px; 
                      display: inline-block;">
                비밀번호 재설정
            </a>
        </div>
        
        <p>또는 아래 URL을 브라우저에 복사하여 붙여넣으세요:</p>
        <p style="word-break: break-all; color: #2196F3;">
            {{ url('password/reset', $token) }}
        </p>
        
        <p>이 링크는 24시간 후에 만료됩니다.</p>
        
        <hr style="border: none; border-top: 1px solid #eee; margin: 30px 0;">
        
        <p style="color: #666; font-size: 12px;">
            비밀번호 재설정을 요청하지 않으셨다면 추가 조치가 필요하지 않습니다.<br>
            이 메일은 자동으로 발송되었습니다. 회신하지 마시기 바랍니다.
        </p>
    </div>
</body>
</html> 