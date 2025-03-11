<?php

declare(strict_types=1);

use Common\Infra\Queue\Amqp\AmpqContextFactory;
use Enqueue\AmqpLib\AmqpContext;

use function Sirix\Config\env;

return [
    'dependencies' => [
        'factories' => [
            AmqpContext::class => AmpqContextFactory::class,
        ],
    ],
    'amqp' => [
        'host' => env('AMQP_HOST'),
        'port' => env('AMQP_PORT'),
        'vhost' => '/',
        'user' => env('AMQP_USER'),
        'pass' => env('AMQP_PASSWORD'),
        'persisted' => false,
    ],
];
