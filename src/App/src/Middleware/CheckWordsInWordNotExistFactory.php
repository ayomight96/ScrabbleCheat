<?php

declare(strict_types=1);

namespace App\Middleware;

use Doctrine\Persistence\ObjectManager;
use Psr\Container\ContainerInterface;

class CheckWordsInWordNotExistFactory
{
    public function __invoke(ContainerInterface $container) : CheckWordsInWordNotExist
    {
        return new CheckWordsInWordNotExist($container->get(ObjectManager::class));
    }
}
