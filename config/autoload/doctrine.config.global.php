<?php

declare(strict_types=1);

use Doctrine\Common\Cache\ArrayCache;
use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;
use Doctrine\Persistence\Mapping\Driver\MappingDriver;
use MongoDB\Client;

return [
    'doctrine' => [
        'default' => 'odm_default',
        'connection' => [
            'odm_default' => [
                'connection_string' => getenv('MONGO_URL'),
                'options'          => [],
                //will use login through admin db with access to all dbs in cluster
            ],
        ],
        'configuration' => [
            'odm_default' => [
                'driver'             => MappingDriver::class,
                'generate_proxies'   => Configuration::AUTOGENERATE_FILE_NOT_EXISTS,
                'proxy_dir'          => 'data/DoctrineMongoODMModule/Proxy',
                'proxy_namespace'    => 'DoctrineMongoODMModule\Proxy',
                'generate_hydrators' => Configuration::AUTOGENERATE_FILE_NOT_EXISTS,
                'hydrator_dir'       => 'data/DoctrineMongoODMModule/Hydrator',
                'hydrator_namespace' => 'DoctrineMongoODMModule\Hydrator',
                'default_db'         => getenv('MONGO_DB'),
            ]
        ],
        'documentmanager' => [
            'odm_default' => [
                'connection'    => Client::class,
                'configuration' => \Doctrine\ODM\MongoDB\Configuration::class,
            ],
        ],
        'driver' => [
            'odm_default' => [
                AnnotationDriver::class => [
                    'documents_dir' => [
                    ]
                ]
            ]
        ]
    ]
];
