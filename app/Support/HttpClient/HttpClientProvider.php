<?php

declare(strict_types=1);

namespace App\Support\HttpClient;

interface HttpClientProvider
{
    public const METHOD_GET = 'GET';
    public const METHOD_POST = 'POST';
    public const METHOD_PUT = 'PUT';
    public const METHOD_DELETE = 'DELETE';

    /**
     * @param string $method
     * @param string $uri
     * @param array $params
     * @param bool $json
     * @return array
     * @throws \App\Support\HttpClient\Exceptions\DataExtractingException
     * @throws \App\Support\HttpClient\Exceptions\RequestException
     * @throws \App\Support\HttpClient\Exceptions\UnauthorizedException
     * @throws \App\Support\HttpClient\Exceptions\WrongMethodException
     */
    public function makeRequest(string $method, string $uri, array $params = [], bool $json = false): array;
}
