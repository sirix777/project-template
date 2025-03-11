<?php

declare(strict_types=1);

use Monolog\Handler\ErrorLogHandler;
use Monolog\Level;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Sirix\Monolog\Formatter\JsonFormatter;
use Sirix\Monolog\MonologFactory;

use function Sirix\Config\env;

return [
    'dependencies' => [
        'factories' => [
            Logger::class => MonologFactory::class,
        ],
        'aliases' => [
            'logger' => Logger::class,
            LoggerInterface::class => Logger::class,
        ],
    ],
    'monolog' => [
        'formatters' => [
            'json' => [
                'type' => 'json',
                'options' => [
                    'batchMode' => JsonFormatter::BATCH_MODE_JSON,
                    'appendNewline' => true,
                    'maskKeys' => [],
                ],
            ],
        ],
        'handlers' => [
            'default' => [
                'type' => 'stream',
                'formatter' => 'json',
                'options' => [
                    'stream' => env('LOG_STREAM', 'php://stderr'),
                ],
                'processors' => [],
            ],
            'error' => [
                'type' => 'errorlog',
                'formatter' => 'json',
                'options' => [
                    'messageType' => ErrorLogHandler::OPERATING_SYSTEM,
                    'level' => Level::Error,
                    'bubble' => true,
                    'expandNewlines' => true,
                ],
                'processors' => [],
            ],
        ],
        'processors' => [
            'uid' => [
                'type' => 'uid',
                'options' => [
                    'length' => 32,
                ],
            ],
            'introspection' => [
                'type' => 'introspection',
                'options' => [
                    'level' => Level::Error,
                    'skipClassesPartials' => [],
                    'skipStackFramesCount' => 0,
                ],
            ],
            'memoryUsage' => [
                'type' => 'memoryUsage',
                'options' => [],
            ],
            'memoryPeak' => [
                'type' => 'memoryPeak',
                'options' => [],
            ],
        ],
        'channels' => [
            'default' => [
                'name' => 'ServiceNameService',
                'handlers' => ['default', 'error'],
                'processors' => [
                    'uid',
                    'introspection',
                    'memoryUsage',
                    'memoryPeak',
                ],
            ],
        ],
    ],
];
