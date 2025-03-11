<?php

declare(strict_types=1);

namespace Common\Infra\HttpClient\Exception;

use InvalidArgumentException;

use function get_debug_type;
use function sprintf;

class InvalidHttpMiddlewareException extends InvalidArgumentException
{
    public static function fromMiddleware(mixed $middleware): self
    {
        return new self(sprintf(
            'Provided middleware does not have a valid type. Expected callable, %s provided',
            get_debug_type($middleware),
        ));
    }
}
