<?php

declare(strict_types=1);

namespace App\Support\HttpClient\Exceptions;

use Throwable;

class DataExtractingException extends HttpClientException
{
    public function __construct(Throwable $previous = null)
    {
        parent::__construct("Ошибка при извлечении данных.", $previous);
    }
}
