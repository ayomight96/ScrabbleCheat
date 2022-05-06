<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Service\WordsApiService;
use Doctrine\Persistence\ObjectManager;
use Psr\Container\ContainerInterface;

class CheckWordsViaApiFactory
{
    public function __invoke(ContainerInterface $container): CheckWordsViaApi
    {
        return new CheckWordsViaApi(
            $container->get(ObjectManager::class),
            $container->get(WordsApiService::class)
        );
    }
}
