<?php

use Monolog\Logger;

return [
    'monolog' =>
    [
        'logger_name' => 'MyLog',
        'loggables' => '[{host}] {request}/{response}', // optional and current one is default format that will be logged
        'handlers' =>
        [
            'main'   =>  [
                'type'   => 'stream',
                'path'   => "php://stderr",
                'level'  => Logger::DEBUG,
            ],
        ],
    ],
];
