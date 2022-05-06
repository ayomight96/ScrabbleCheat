<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Domain\Exception\GetLettersException;
use Assert\Assertion;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use BenTools\StringCombinations\StringCombinations;

class GenerateWords implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $post = $request->getParsedBody();
        $letters = $request->getAttribute('letters');
        try {
            Assertion::string(strtolower($letters), 'You must Enter a string of letters');
            $wordGenerator = new StringCombinations($letters, 2);
            $words = $wordGenerator->withoutDuplicates()->asArray();
            return $handler->handle($request->withAttribute('words', $words));
        } catch (\Throwable $th) {
            throw GetLettersException::invalidLettersEntry($th);
        }
    }
}
