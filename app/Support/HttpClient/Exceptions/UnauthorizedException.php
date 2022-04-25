<?php

declare(strict_types=1);

namespace App\Support\HttpClient\Exceptions;

use Throwable;

class UnauthorizedException extends HttpClientException
{
    public function __construct(Throwable $previous = null)
    {
        parent::__construct("Ошибка авторизации.", $previous);
    }
}
