<?php

declare(strict_types=1);

namespace Common\Infra\Queue\Kafka;

use Enqueue\RdKafka\RdKafkaConnectionFactory;
use Enqueue\RdKafka\RdKafkaContext;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use RuntimeException;

class KafkaContextFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): RdKafkaContext
    {
        $config = $container->get('config');

        if (empty($config['kafka'])) {
            throw new RuntimeException('Kafka settings missing from config');
        }
        $kafkaConfig = $config['kafka'];

        $connectionFactory = new RdKafkaConnectionFactory($kafkaConfig);

        return $connectionFactory->createContext();
    }
}
