<?php

declare(strict_types=1);

namespace App\Client;

use Psr\Container\ContainerInterface;
use Swoole\Coroutine\Http\Client;

class WordsApiClientFactory
{
    public function __invoke(ContainerInterface $container) : Client
    {
        $config = $container->get('config')['wordsApi'];
        $client = new Client($config['X-RapidAPI-Host'], 443, true);
        return $client;
    }
}
