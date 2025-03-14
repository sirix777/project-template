<?php

declare(strict_types=1);

namespace ApiGatewayTest\Infra\Handler;

use const JSON_THROW_ON_ERROR;

use ApiGateway\Infra\Handler\PingHandler;
use JsonException;
use Laminas\Diactoros\Response\JsonResponse;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

use function json_decode;
use function property_exists;

#[CoversClass(PingHandler::class)]
class PingHandlerTest extends TestCase
{
    /**
     * @throws JsonException
     */
    public function testResponse(): void
    {
        $pingHandler = new PingHandler();
        $response = $pingHandler->handle(
            $this->createMock(ServerRequestInterface::class)
        );

        $json = json_decode((string) $response->getBody(), null, 512, JSON_THROW_ON_ERROR);

        self::assertInstanceOf(JsonResponse::class, $response);
        self::assertTrue(property_exists($json, 'ack') && null !== $json->ack);
    }
}
