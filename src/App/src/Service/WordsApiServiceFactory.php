<?php

declare(strict_types=1);

namespace App\Service;

use App\Client\WordsApiClientFactoryFactory;
use App\Service\WordsApiService;
use Psr\Container\ContainerInterface;

class WordsApiServiceFactory
{
    public function __invoke(ContainerInterface $container): WordsApiService
    {
        $config = $container->get('config')['wordsApi'];
        $clientFactory = $container->get(WordsApiClientFactoryFactory::class);
        return new WordsApiService($clientFactory, $config);
    }
}
