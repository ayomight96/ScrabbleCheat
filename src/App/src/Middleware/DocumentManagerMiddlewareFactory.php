<?php

declare(strict_types=1);

namespace App\Middleware;

use Doctrine\Persistence\ObjectManager;
use Psr\Container\ContainerInterface;

class DocumentManagerMiddlewareFactory
{
    public function __invoke(ContainerInterface $container) : DocumentManagerMiddleware
    {
        //alias for document manager decorator
        $odmDecorator = $container->get(ObjectManager::class);
        return new DocumentManagerMiddleware($odmDecorator);
    }
}
