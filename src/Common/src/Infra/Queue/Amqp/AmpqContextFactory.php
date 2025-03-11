<?php

declare(strict_types=1);

namespace Common\Infra\Queue\Amqp;

use Enqueue\AmqpLib\AmqpConnectionFactory;
use Enqueue\AmqpLib\AmqpContext;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use RuntimeException;

class AmpqContextFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): AmqpContext
    {
        $config = $container->get('config');

        if (! isset($config['amqp'])) {
            throw new RuntimeException('Amqp settings missing from config');
        }

        $amqpConfig = $config['amqp'];
        $connectionFactory = new AmqpConnectionFactory($amqpConfig);

        return $connectionFactory->createContext();
    }
}
