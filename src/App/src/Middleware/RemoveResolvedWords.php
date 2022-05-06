<?php

declare(strict_types=1);

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RemoveResolvedWords implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $wordExistResults = $request->getAttribute('wordExistResults');
        $wordNotExistResults = $request->getAttribute('wordNotExistResults');
        $words = $request->getAttribute('words');
        if (!empty($words)) {
            if (!empty($wordExistResults)) {
                foreach ($wordExistResults as $wordExistResult) {
                    $key = array_search($wordExistResult, $words);
                    unset($words[$key]);
                }
            } elseif (!empty($wordNotExistResults)) {
                foreach ($wordNotExistResults as $wordNotExistResult) {
                    $key = array_search($wordNotExistResult, $words);
                    unset($words[$key]);
                }
            }
        }
        return $handler->handle($request->withAttribute('words', array_values($words)));
    }
}
