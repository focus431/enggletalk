<?php

return [
  'default_currency' => 'USD', // 默认货币
  'api_key' => env('EXCHANGE_RATES_API_KEY', ''), // 从环境变量获取API密钥
  'base_currency' => 'USD', // 基准货币
  'currencies' => ['TWD', 'JPY', 'KRW', 'CNY', 'VND'], // 需要获取汇率的货币列表
];

