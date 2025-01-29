<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - EnggleTalk</title>
    <style>
        body {
            font-family: 'Microsoft JhengHei', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            padding: 20px 0;
            border-bottom: 2px solid #eee;
        }
        .content {
            padding: 20px 0;
        }
        .footer {
            text-align: center;
            padding: 20px 0;
            color: #666;
            font-size: 12px;
            border-top: 1px solid #eee;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('images/logo.png') }}" alt="EnggleTalk Logo" style="max-width: 200px;">
        </div>
        
        <div class="content">
            @yield('content')
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} EnggleTalk. 版權所有</p>
            <p>如果您有任何問題，請聯繫我們：{{ config('mail.from.address') }}</p>
        </div>
    </div>
</body>
</html> 