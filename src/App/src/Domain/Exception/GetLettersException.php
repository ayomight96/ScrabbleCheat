<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use DomainException;
use Mezzio\ProblemDetails\Exception\CommonProblemDetailsExceptionTrait;
use Mezzio\ProblemDetails\Exception\ProblemDetailsExceptionInterface;
use Throwable;

class GetLettersException extends DomainException implements ProblemDetailsExceptionInterface
{
    use CommonProblemDetailsExceptionTrait;
    const TYPE = 'ScrabbleCheat.com';

    public static function invalidLettersEntry(Throwable $th): self
    {
        $detail = sprintf(
            $th->getMessage()
        );
        $e = new self($detail);
        $e->status = 409;
        $e->type = self::TYPE;
        $e->title = 'Invalid Letters Entry';
        $e->detail = $detail;

        return $e;
    }
}
