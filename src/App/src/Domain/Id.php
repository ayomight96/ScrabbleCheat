<?php

declare(strict_types=1);

namespace App\Domain;

use Ramsey\Uuid\Uuid;

abstract class Id
{
    protected function __construct(private string $id)
    {
    }

    public static function generate(): Id
    {
        return new static(Uuid::uuid4()->toString());
    }

    public function toString(): string
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return $this->toString();
    }
    
    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }
}