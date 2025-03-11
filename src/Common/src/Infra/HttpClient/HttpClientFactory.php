<?php

declare(strict_types=1);

namespace Common\Infra\HttpClient;

use Common\Infra\HttpClient\Exception\InvalidHttpMiddlewareException;
use GuzzleHttp;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

use function is_callable;
use function is_string;

class HttpClientFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): GuzzleHttp\Client
    {
        $handler = GuzzleHttp\HandlerStack::create(new GuzzleHttp\Handler\CurlHandler());

        [$requestMiddlewares, $responseMiddlewares] = $this->getRegisteredMiddlewares($container);

        foreach ($requestMiddlewares as $middleware) {
            $middlewareInstance = $this->resolveMiddleware($middleware, $container);
            $handler->push(GuzzleHttp\Middleware::mapRequest($middlewareInstance));
        }

        foreach ($responseMiddlewares as $middleware) {
            $middlewareInstance = $this->resolveMiddleware($middleware, $container);
            $handler->push(GuzzleHttp\Middleware::mapResponse($middlewareInstance));
        }

        return new GuzzleHttp\Client(['handler' => $handler]);
    }

    /**
     * @return array<int, array<int, string>>
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function getRegisteredMiddlewares(ContainerInterface $container): array
    {
        $config = $container->get('config')['http_client'] ?? [];

        return [
            $config['request_middlewares'] ?? [],
            $config['response_middlewares'] ?? [],
        ];
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function resolveMiddleware(mixed $middleware, ContainerInterface $container): callable
    {
        $middlewareInstance = is_string($middleware) ? $container->get($middleware) : $middleware;
        if (! is_callable($middlewareInstance)) {
            throw InvalidHttpMiddlewareException::fromMiddleware($middlewareInstance);
        }

        return $middlewareInstance;
    }
}
