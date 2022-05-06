<?php

declare(strict_types=1);

namespace App\Middleware;

use Psr\Container\ContainerInterface;

class RemoveResolvedWordsFactory
{
    public function __invoke(ContainerInterface $container) : RemoveResolvedWords
    {
        return new RemoveResolvedWords();
    }
}
