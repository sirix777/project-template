<?php

declare(strict_types=1);

use Common\Infra\HttpClient\HttpClientFactory;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

return [
    'http_client' => [
        'request_middlewares' => [],
        'response_middlewares' => [],
    ],
    'dependencies' => [
        'factories' => [
            Client::class => HttpClientFactory::class,
        ],
        'aliases' => [
            'httpClient' => Client::class,
            ClientInterface::class => Client::class,
        ],
    ],
];
