<?php

declare(strict_types=1);

namespace App\Delegator;

use App\Decorator\DocumentManagerDecorator as DecoratorDocumentManagerDecorator;
use Helderjs\Component\DoctrineMongoODM\Decorator\ObjectManagerDecorator;
use Psr\Container\ContainerInterface;

class DocumentManagerDelegator
{
    public function __invoke(
        ContainerInterface $container,
        $serviceName,
        callable $callback
    ): ObjectManagerDecorator {
        return new DecoratorDocumentManagerDecorator($callback);
    }
}
