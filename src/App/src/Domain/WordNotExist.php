<?php

declare(strict_types=1);

namespace App\Domain;

use Broadway\EventSourcing\EventSourcedAggregateRoot;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * 
 * @ODM\Document(repositoryClass="App\Repository\Doctrine\Repository")
 */

class WordNotExist extends EventSourcedAggregateRoot
{
    /**
     * @ODM\Id(strategy="NONE", type="string")
     */
    protected string $id;
    /**
     * Class constructor.
     */
    private function __construct(
        WordNotExistId $wordNotExistId,
        /**
         * @ODM\Field(type="string")
         */
        private string $word
    ) {
        $this->id = $wordNotExistId->toString();
    }

    public function getAggregateRootId(): string
    {
        return $this->id;
    }

    public static function create(
        WordNotExistId $WordNotExistId,
        string $word
    ): self {
        return new self(
            wordNotExistId: $WordNotExistId,
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
