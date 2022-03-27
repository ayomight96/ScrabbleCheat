<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Service\WordsApiService;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class GetWord implements MiddlewareInterface
{
    public function __construct(private WordsApiService $wordsApiService)
    {    
    }
    
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        $word = $request->getAttribute('word');
        $response = $this->wordsApiService->getWord($word);

        return new JsonResponse([$response]);
    }
}
