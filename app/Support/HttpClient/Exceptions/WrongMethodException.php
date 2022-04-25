<?php

declare(strict_types=1);

namespace App\Support\HttpClient\Exceptions;

use Throwable;

class WrongMethodException extends HttpClientException
{
    public function __construct(Throwable $previous = null)
    {
        parent::__construct("Неподдерживаемый HTTP-метод.", $previous);
    }
}
