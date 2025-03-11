<?php

declare(strict_types=1);

namespace ApiGateway;

use function Sirix\Config\loadConfigFromGlob;

class ConfigProvider
{
    /**
     * @return array<string, mixed>
     */
    public function __invoke(): array
    {
        return loadConfigFromGlob(__DIR__ . '/../config/{,*.}config.php');
    }
}
