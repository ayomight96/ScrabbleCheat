<?php

declare(strict_types=1);

namespace App\Client;

use Psr\Container\ContainerInterface;
use Swoole\Coroutine\Http\Client;

class WordsApiClientFactoryFactory
{
    public function __invoke(ContainerInterface $container) : callable
    {
        $factory = new WordsApiClientFactory();
        return function () use ($factory, $container): Client {
            return $factory($container);
        };
    }
}
