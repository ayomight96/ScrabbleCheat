<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Domain\WordExist;
use Doctrine\Persistence\ObjectManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CheckWordsInWordExist implements MiddlewareInterface
{
    public function __construct(private ObjectManager $objectManager)
    {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $words = $request->getAttribute('words');
        $wordExistResults = [];
        if (is_array($words) && !empty($words)){
            foreach ($words as $word) {
                /**@var WordExist */
                $wordExist = $this->objectManager->getRepository(WordExist::class)
                    ->findOneBy(['word' => $word]);
                if ($wordExist) {
                    $wordExistResults [] = $wordExist->data()['word'];
                }
            }
            if (!empty($wordExistResults)) {
                return $handler->handle($request->withAttribute('wordExistResults', $wordExistResults));
            }
        }
        return $handler->handle($request);
    }
}
