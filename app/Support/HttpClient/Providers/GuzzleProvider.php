<?php

declare(strict_types=1);

namespace App\Support\HttpClient\Providers;

use App\Support\HttpClient\Exceptions\DataExtractingException;
use App\Support\HttpClient\Exceptions\RequestException;
use App\Support\HttpClient\Exceptions\UnauthorizedException;
use App\Support\HttpClient\Exceptions\WrongMethodException;
use App\Support\HttpClient\HttpClientProvider;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Psr\Http\Message\ResponseInterface;
use Exception;

class GuzzleProvider implements HttpClientProvider
{
    /** @var \GuzzleHttp\Client */
    protected Client $client;

    /**
     * GuzzleProvider constructor.
     * @param string $baseUri
     * @param array $defaultHeaders
     */
    public function __construct(string $baseUri, array $defaultHeaders = [])
    {
        $this->client = new Client([
            'base_uri' => $baseUri,
            'headers'  => $defaultHeaders
        ]);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $data
     * @return array
     * @throws \App\Support\HttpClient\Exceptions\DataExtractingException
     * @throws \App\Support\HttpClient\Exceptions\RequestException
     * @throws \App\Support\HttpClient\Exceptions\UnauthorizedException
     */
    protected function makeClientRequest(string $method, string $uri, array $data = []): array
    {
        try {
            $response = $this->client->request($method, $uri, $data);
        } catch (Exception $e) {
            Log::info(__METHOD__ . $e->getMessage());
            if ((int) $e->getCode() === 401) {
                throw new UnauthorizedException($e);
            }
            throw new RequestException($e);
        }

        return $this->extractDataFromResponse($response);
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @return array
     * @throws \App\Support\HttpClient\Exceptions\DataExtractingException
     */
    protected function extractDataFromResponse(ResponseInterface $response): array
    {
        try {
            $data = \json_decode($response->getBody()->getContents(), true);
            if (! \is_array($data)) {
                $data = [];
            }
        } catch (Exception $e) {
            throw new DataExtractingException($e);
        }

        return $data;
    }

    /**
     * @inheritDoc
     */
    public function makeRequest(string $method, string $uri, array $params = [], bool $json = false): array
    {
        $method = \mb_strtoupper($method);

        if ($json) {
            $data = [
                'json' => $params
            ];
        } else {
            switch ($method) {
                case HttpClientProvider::METHOD_GET:
                case HttpClientProvider::METHOD_PUT:
                    $data = [
                        'query' => $params
                    ];
                    break;
                case HttpClientProvider::METHOD_POST:
                    $data = [
                        'form_params' => $params
                    ];
                    break;
                case HttpClientProvider::METHOD_DELETE: //just for prevent exception
                    $data = [];
                    break;
                default:
                    throw new WrongMethodException();
            }
        }

        return $this->makeClientRequest($method, $uri, $data);
    }
}
