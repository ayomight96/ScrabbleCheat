<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Decorator\DocumentManagerDecorator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class DocumentManagerMiddleware implements MiddlewareInterface
{
    private DocumentManagerDecorator $objectManagerDecorator;

    public function __construct(DocumentManagerDecorator $objectManagerDecorator)
    {
        $this->objectManagerDecorator = $objectManagerDecorator;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            $this->objectManagerDecorator->open();
            return $handler->handle($request);
        } finally {
            $this->objectManagerDecorator->clear();
        }
    }
}
