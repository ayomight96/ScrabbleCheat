<?php

declare(strict_types=1);

use Doctrine\Common\EventManager;
use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\Persistence\Mapping\Driver\MappingDriver;
use Doctrine\Persistence\ObjectManager;
use Helderjs\Component\DoctrineMongoODM\AnnotationDriverFactory;
use Helderjs\Component\DoctrineMongoODM\ConfigurationFactory;
use Helderjs\Component\DoctrineMongoODM\ConnectionFactory;
use Helderjs\Component\DoctrineMongoODM\DocumentManagerFactory;
use Helderjs\Component\DoctrineMongoODM\EventManagerFactory;
use MonologMiddleware\Factory\MonologMiddlewareFactory;
use MonologMiddleware\MonologMiddleware;
use MongoDB\Client;

return [
    // Provides application-wide services.
    // We recommend using fully-qualified class names whenever possible as
    // service names.
    'dependencies' => [
        // Use 'aliases' to alias a service name to another service. The
        // key is the alias name, the value is the service to which it points.
        'aliases' => [
            // Fully\Qualified\ClassOrInterfaceName::class => Fully\Qualified\ClassName::class,
        ],
        // Use 'invokables' for constructor-less services, or services that do
        // not require arguments to the constructor. Map a service name to the
        // class name.
        'invokables' => [
            // Fully\Qualified\InterfaceName::class => Fully\Qualified\ClassName::class,
        ],
        // Use 'factories' for services provided by callbacks/factory classes.
        'factories' => [
            ObjectManager::class => DocumentManagerFactory::class,
            Configuration::class => ConfigurationFactory::class,
            Client::class => ConnectionFactory::class,
            EventManager::class => EventManagerFactory::class,
            MappingDriver::class => AnnotationDriverFactory::class,
            MonologMiddleware::class => MonologMiddlewareFactory::class
            // Fully\Qualified\ClassName::class => Fully\Qualified\FactoryName::class,
        ],
        'delegators' => [
            // \Swoole\Http\Server::class => [
            //     \App\Delegator\TaskWorkerDelegator::class
            // ],
            ObjectManager::class => [//used because of swoole
                \App\Delegator\DocumentManagerDelegator::class
            ]
        ]
    ],
];
