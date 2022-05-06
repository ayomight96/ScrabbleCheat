<?php

declare(strict_types=1);

namespace App\Middleware;

use Doctrine\Persistence\ObjectManager;
use Psr\Container\ContainerInterface;

class CheckWordsInWordExistFactory
{
    public function __invoke(ContainerInterface $container) : CheckWordsInWordExist
    {
        return new CheckWordsInWordExist($container->get(ObjectManager::class));
    }
}
