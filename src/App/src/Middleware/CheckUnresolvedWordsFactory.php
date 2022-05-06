<?php

declare(strict_types=1);

namespace App\Middleware;

use Psr\Container\ContainerInterface;

class CheckUnresolvedWordsFactory
{
    public function __invoke(ContainerInterface $container) : CheckUnresolvedWords
    {
        return new CheckUnresolvedWords();
    }
}
