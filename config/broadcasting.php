<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Broadcaster
    |--------------------------------------------------------------------------
    |
    | This option controls the default broadcaster that will be used by the
    | framework when an event needs to be broadcast. You may set this to
    | any of the connections defined in the "connections" array below.
    |
    | Supported: "pusher", "ably", "redis", "log", "null"
    |
    */

    'default' => env('BROADCAST_DRIVER', 'pusher'),

    /*
    |--------------------------------------------------------------------------
    | Broadcast Connections
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the broadcast connections that will be used
    | to broadcast events to other systems or over websockets. Samples of
    | each available type of connection are provided inside this array.
    |
    */

    'connections' => [

        'pusher' => [
            // 'driver' 改为 'websocket'
            'driver' => 'websocket',

            // Laravel Websockets 的主机和端口配置
            'host' => env('WS_HOST', 'localhost'),
            'port' => env('WS_PORT', 6001),

            // 使用 SSL 加密（如果需要）
            'ssl' => false,

            // 其他配置选项
            // ...
            'cluster' => env('PUSHER_APP_CLUSTER'),
            // 认证配置（如果需要）
            'auth' => [
                'headers' => [
                    'Authorization' => 'Bearer ' . env('WS_JWT'),
                ],
            ],
        ],

        'ably' => [
            'driver' => 'ably',
            'key' => env('ABLY_KEY'),
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => 'default',
        ],

        'log' => [
            'driver' => 'log',
        ],

        'null' => [
            'driver' => 'null',
        ],

    ],

];
