<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Service\WordsApiService;
use Psr\Container\ContainerInterface;

class GetWordFactory
{
    public function __invoke(ContainerInterface $container) : GetWord
    {
        return new GetWord($container->get(WordsApiService::class));
    }
}
