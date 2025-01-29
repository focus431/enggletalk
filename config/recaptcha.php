<?php

return [
    'api_site_key'      => env('RECAPTCHA_SITE_KEY', ''),
    'api_secret_key'    => env('RECAPTCHA_SECRET_KEY', ''),
    'version'           => 'v3',
    'skip_ip'          => [], // 可以跳過驗證的IP列表
    'default_validation_rules' => [
        'required',
        'string',
    ],
    'default_token_parameter' => 'g-recaptcha-response',
    'default_score_threshold' => 0.5,
]; 