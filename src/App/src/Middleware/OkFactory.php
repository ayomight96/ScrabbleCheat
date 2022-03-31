<?php

declare(strict_types=1);

namespace App\Middleware;

use Psr\Container\ContainerInterface;

class OkFactory
{
    public function __invoke(ContainerInterface $container) : Ok
    {
        return new Ok();
    }
}
