<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use DomainException;
use Mezzio\ProblemDetails\Exception\CommonProblemDetailsExceptionTrait;
use Mezzio\ProblemDetails\Exception\ProblemDetailsExceptionInterface;
use Throwable;

class GetWordException extends DomainException implements ProblemDetailsExceptionInterface
{
    use CommonProblemDetailsExceptionTrait;
    const TYPE = 'ScrabbleCheat.com';

    public static function invalidWordEntry(Throwable $th): self
    {
        $detail = sprintf(
            $th->getMessage()
        );
        $e = new self($detail);
        $e->status = 409;
        $e->type = self::TYPE;
        $e->title = 'Invalid Word Entry';
        $e->detail = $detail;

        return $e;
    }
}
