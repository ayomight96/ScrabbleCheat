<?php

declare(strict_types=1);

namespace App\Domain;

use Broadway\EventSourcing\EventSourcedAggregateRoot;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * 
 * @ODM\Document(repositoryClass="App\Repository\Doctrine\Repository")
 */

class Word extends EventSourcedAggregateRoot
{
    /**
     * @ODM\Id(strategy="NONE", type="string")
     */
    protected string $id;
    /**
     * Class constructor.
     */
    private function __construct(
        WordId $wordId,
        /**
         * @ODM\Field(type="string")
         */
        private string $word,
        /**
         * @ODM\Field(type="string")
         */
        private string $definition
    ) {
        $this->id = $wordId->toString();
    }

    public function getAggregateRootId(): string
    {
        return $this->id;
    }

    public static function create(
        WordId $wordId,
        string $word,
        string $definition
    ): self {
        return new self(
            wordId: $wordId,
            word: $word,
            definition: $definition
        );
    }

    public function data(): array
    {
        return [
            'wordId' => $this->id,
            'word' => $this->word,
            'definition' => $this->definition
        ];
    }
}
