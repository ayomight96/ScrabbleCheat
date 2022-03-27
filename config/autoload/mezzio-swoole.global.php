<?php

use Mezzio\Swoole\ConfigProvider;

return array_merge((new ConfigProvider())(), [
    'mezzio-swoole' => [
        'enable_coroutine' => true,
        'swoole-http-server' => [
            'host' => '0.0.0.0',
            'port' => 5000, // use an integer value here
            'mode' => SWOOLE_PROCESS,
            'options' => [
                'hook_flags' => SWOOLE_HOOK_NATIVE_CURL,
                'task_enable_coroutine' => true,
                'package_max_length' => 20 * 1024 * 1024,
                'worker_num'      => 8, // The number of HTTP Server Workers
                // 'task_worker_num' => 8, // The number of Task Workers
            ]
        ]
    ],
]);
