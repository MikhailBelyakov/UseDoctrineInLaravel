<?php

declare(strict_types=1);

namespace App\Support\HttpClient\Exceptions;

use Exception;
use Throwable;

abstract class HttpClientException extends Exception
{
    /**
     * @param string $message
     * @param \Throwable|null $previous
     */
    public function __construct(string $message, Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }
}
