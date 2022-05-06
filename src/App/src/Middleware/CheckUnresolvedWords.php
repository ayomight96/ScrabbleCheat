<?php

declare(strict_types=1);

namespace App\Middleware;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CheckUnresolvedWords implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $words = $request->getAttribute('words');
        if (empty($words) || !isset($words)) {
            return new JsonResponse($request->getAttribute('wordExistResults'));
        }
        return $handler->handle($request);
    }
}
