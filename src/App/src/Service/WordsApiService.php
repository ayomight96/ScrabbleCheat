<?php

declare(strict_types=1);

namespace App\Service;

use Closure;

class WordsApiService
{
    private Closure $clientFactory;
    /**
     * Class constructor.
     */
    public function __construct(callable $clientFactory)
    {
        $this->clientFactory = Closure::fromCallable($clientFactory);
    }

    public function getWord(string $word): mixed
    {
        $client = ($this->clientFactory)();
        $client->get(sprintf('https://wordsapiv1.p.rapidapi.com/words/%s', $word));
        return (array)json_decode($client->body);
    }

}
