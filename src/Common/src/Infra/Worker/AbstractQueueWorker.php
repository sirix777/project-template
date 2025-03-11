<?php

declare(strict_types=1);

namespace Common\Infra\Worker;

use Interop\Queue\Consumer;
use Interop\Queue\Context;
use Interop\Queue\Message;
use Override;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

use function memory_get_usage;
use function round;
use function sprintf;
use function time;
use function usleep;

abstract class AbstractQueueWorker extends Command
{
    protected const int TIMEOUT = 240;
    protected const float MEMORY = 128;
    protected bool $requeueOnFail = false;
    protected ?int $usleepOnCrash = null;

    private bool $consumerInUse = false;
    private readonly int $startTime;
    private Consumer $workerConsumer;
    private ?Message $message = null;

    public function __construct(
        protected Context $queueContext,
        protected LoggerInterface $logger,
        ?string $name = null
    ) {
        parent::__construct($name);

        $this->startTime = time();
    }

    #[Override]
    protected function configure(): void
    {
        $this->setCode(fn (InputInterface $input, OutputInterface $output) => $this->executionWrapper($input, $output));
    }

    protected function executionWrapper(InputInterface $input, OutputInterface $output): void
    {
        try {
            $this->execute($input, $output);
        } catch (Throwable $t) {
            $this->logger->error(sprintf(
                'Worker %s crashed: %s',
                $this->getName(),
                $t->getMessage()
            ));

            if ($this->consumerInUse && $this->message instanceof Message) {
                $this->reject($this->message, $this->requeueOnFail);
            }

            if (null === $this->usleepOnCrash) {
                return;
            }

            usleep($this->usleepOnCrash);
        }
    }

    protected function initConsumer(string $queueName, bool $requeueOnFail = false): void
    {
        $workerQueue = $this->queueContext->createQueue($queueName);

        $this->workerConsumer = $this->queueContext->createConsumer($workerQueue);

        $this->consumerInUse = true;
        $this->requeueOnFail = $requeueOnFail;
    }

    protected function receive(): ?Message
    {
        $this->message = $this->workerConsumer->receive();

        return $this->message;
    }

    protected function acknowledge(Message $message): void
    {
        $this->workerConsumer->acknowledge($message);
    }

    protected function reject(Message $message, bool $requeue = false): void
    {
        usleep(100_000);
        $this->workerConsumer->reject($message, $requeue);
    }

    protected function checkAndStopIfNecessary(): void
    {
        if ($this->timeoutReached() || $this->memoryExceeded()) {
            $this->stop();
        }
    }

    private function stop(): void
    {
        $this->logger->info(
            "Worker {$this->getName()} stop.",
            ['memory_usage' => $this->getMemoryUsage(), 'timeout_reached' => (int) $this->timeoutReached()]
        );

        exit;
    }

    private function getMemoryUsage(): float
    {
        return round(memory_get_usage() / 1024 / 1024);
    }

    private function timeoutReached(): bool
    {
        return time() - $this->startTime >= static::TIMEOUT;
    }

    private function memoryExceeded(): bool
    {
        return $this->getMemoryUsage() >= static::MEMORY;
    }
}
