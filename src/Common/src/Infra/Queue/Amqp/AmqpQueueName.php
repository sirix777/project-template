<?php

declare(strict_types=1);

namespace Common\Infra\Queue\Amqp;

enum AmqpQueueName: string
{
    case SendToMonitorForIncomingTransaction
    = 'cryptoprocessing_service.send_exchange_to_monitor_for_incoming_transaction';
    case GetMonitoringResult
    = 'crypto_monitoring_service.send_exchange_monitoring_result';
}
