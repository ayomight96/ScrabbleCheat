<?php

declare(strict_types=1);

namespace App\Repository\EventSourcing;

use App\Domain\User;
use Broadway\EventHandling\EventBus;
use Broadway\EventSourcing\AggregateFactory\PublicConstructorAggregateFactory;
use Broadway\EventSourcing\EventSourcingRepository;
use Broadway\EventStore\EventStore;

class UserRepository extends EventSourcingRepository
{
    /**
     * Class constructor.
     */
    public function __construct(EventStore $eventStore, EventBus $eventBus)
    {
        parent::__construct($eventStore, $eventBus, User::class, new PublicConstructorAggregateFactory);

    }
}