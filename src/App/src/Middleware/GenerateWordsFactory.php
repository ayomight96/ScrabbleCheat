<?php

declare(strict_types=1);

namespace App\Middleware;

use Psr\Container\ContainerInterface;

class GenerateWordsFactory
{
    public function __invoke(ContainerInterface $container) : GenerateWords
    {
        return new GenerateWords();
    }
}
