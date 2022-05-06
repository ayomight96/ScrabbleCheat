<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Domain\WordExist;
use App\Domain\WordExistId;
use App\Domain\WordNotExist;
use App\Domain\WordNotExistId;
use App\Service\WordsApiService;
use Doctrine\Persistence\ObjectManager;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CheckWordsViaApi implements MiddlewareInterface
{
    public function __construct(
        private ObjectManager $objectManager,
        private WordsApiService $wordsApiService
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $words = $request->getAttribute('words');
        $wordExist = [];
        foreach ($words as $word) {
            $response = $this->wordsApiService->getWord($word);
            if (!isset($response['message'])) {
                $wordExist [] = $word;
            } 
        }
        return new JsonResponse($wordExist);
    }
}
