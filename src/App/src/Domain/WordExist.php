<?php

declare(strict_types=1);

namespace App\Domain;

use Broadway\EventSourcing\EventSourcedAggregateRoot;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * 
 * @ODM\Document(repositoryClass="App\Repository\Doctrine\Repository")
 */

class WordExist extends EventSourcedAggregateRoot
{
    /**
     * @ODM\Id(strategy="NONE", type="string")
     */
    protected string $id;
    /**
     * Class constructor.
     */
    private function __construct(
        WordExistId $wordExistId,
        /**
         * @ODM\Field(type="string")
         */
        private string $word,
    ) {
        $this->id = $wordExistId->toString();
    }

    public function getAggregateRootId(): string
    {
        return $this->id;
    }

    public static function create(
        WordExistId $wordExistId,
        string $word
    ): self {
        return new self(
            wordExistId: $wordExistId,
            word: $word
        );
    }

    public function data(): array
    {
        return [
            'word' => $this->word
        ];
    }
}
