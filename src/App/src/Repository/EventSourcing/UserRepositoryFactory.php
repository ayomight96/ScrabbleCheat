<?php

declare(strict_types=1);

namespace App\Repository\EventSourcing;

use Broadway\EventHandling\EventBus;
use Broadway\EventStore\EventStore;
use Psr\Container\ContainerInterface;

class UserRepositoryFactory
{
    public function __invoke(ContainerInterface $container) : UserRepository
    {
        $eventBus = $container->get(EventBus::class);
        $eventStore = $container->get(EventStore::class);
        return new UserRepository($eventStore, $eventBus);
    }
}
