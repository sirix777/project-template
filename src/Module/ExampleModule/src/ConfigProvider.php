<?php

declare(strict_types=1);

namespace ExampleModule;

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
