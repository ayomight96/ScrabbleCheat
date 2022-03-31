<?php

declare(strict_types=1);

namespace App\Service;

use Closure;
use Swoole\Coroutine\Http\Client;

class WordsApiService
{
    private Closure $clientFactory;
    /**
     * Class constructor.
     */
    public function __construct(callable $clientFactory, private array $config)
    {
        $this->clientFactory = Closure::fromCallable($clientFactory);
    }

    public function getWord(string $word): mixed
    {
        $client = $this->getClient();
        $client->get(sprintf(
            'https://wordsapiv1.p.rapidapi.com/words/%s',
            $word
        ));
        return (array)json_decode(
            ($client->body), true
        );
    }

    private function getClient(): Client
    {
        /**@var Client */
        $client = ($this->clientFactory)();
        $client->setHeaders([
            'Content-Type' => 'application/json',
            'X-RapidAPI-Key' => $this->config['X-RapidAPI-Key']
        ]);
        return $client;
    }
}
