<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Domain\WordNotExist;
use Doctrine\Persistence\ObjectManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CheckWordsInWordNotExist implements MiddlewareInterface
{
    public function __construct(private ObjectManager $objectManager)
    {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $words = $request->getAttribute('words');
        $wordNotExistResults = [];
        if (is_array($words) && !empty($words)){
            foreach ($words as $word) {
                /**@var WordNotExist */
                $wordNotExist = $this->objectManager->getRepository(WordNotExist::class)
                    ->findOneBy(['word' => $word]);
                if ($wordNotExist) {
                    $wordNotExistResults [] = $wordNotExist->data()['word'];
                }
            }
            if (!empty($wordNotExistResults)) {
                return $handler->handle($request->withAttribute('wordNotExistResults', $wordNotExistResults));
            }
        }
        return $handler->handle($request);
    }
}
