<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Domain\Exception\GetWordException;
use App\Domain\Word;
use App\Domain\WordId;
use App\Domain\WordNotExist;
use App\Domain\WordNotExistId;
use App\Service\WordsApiService;
use Assert\Assertion;
use Doctrine\Persistence\ObjectManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class GetWord implements MiddlewareInterface
{
    public function __construct(
        private WordsApiService $wordsApiService,
        private ObjectManager $objectManager
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $word = $request->getAttribute('word');

        try {
            Assertion::notEmpty($word, 'Kindly input a Word');
            $response = $this->wordsApiService->getWord($word);
            if (isset($response['message'])) {
                $this->objectManager->persist(
                        WordNotExist::create(
                            WordNotExistId::generate(),
                            $word
                        )
                    );
                $this->objectManager->flush();
                return $handler->handle($request);

            }

            $word = Word::create(
                WordId::generate(),
                $word,
                $response['results'][12]['definition']
            );

            $this->objectManager->persist($word);
            $this->objectManager->flush();

            return $handler->handle($request);
        } catch (\Throwable $th) {
            throw GetWordException::invalidWordEntry($th);
        }
    }
}
