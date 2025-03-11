<?php

declare(strict_types=1);

use Common\Infra\Queue\Kafka\KafkaContextFactory;
use Enqueue\RdKafka\RdKafkaContext;

use function Sirix\Config\env;

return [
    'dependencies' => [
        'factories' => [
            RdKafkaContext::class => KafkaContextFactory::class,
        ],
    ],
    'kafka' => [
        'dsn' => 'kafka://',
        'global' => [
            'group.id' => 'kafka-group',
            'metadata.broker.list' => env('KAFKA_BROKER_LIST'),
            'sasl.username' => env('KAFKA_SASL_USERNAME'),
            'sasl.password' => env('KAFKA_SASL_PASSWORD'),
            'enable.ssl.certificate.verification' => env('KAFKA_ENABLE_SSL_CERT_VERIFICATION'),
            'security.protocol' => 'sasl_ssl',
            'sasl.mechanism' => 'SCRAM-SHA-512',
            'enable.auto.commit' => 'false',
            'allow.auto.create.topics' => 'true',
            'acks' => 'all',
        ],
    ],
];
