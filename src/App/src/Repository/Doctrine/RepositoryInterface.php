<?php

declare(strict_types=1);

namespace App\Repository\Doctrine;

use Broadway\Domain\AggregateRoot;
use Doctrine\Persistence\ObjectRepository;

interface RepositoryInterface extends ObjectRepository{
    public function save(AggregateRoot $document): void;
    public function update(AggregateRoot $document): void;
    public function remove(AggregateRoot $document): void;
    public function findOneAndRemove(array $criteria): void;
}