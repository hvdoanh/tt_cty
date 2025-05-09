<?php

namespace App\Services;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LoggerService
{
    private Logger $logger;

    public function __construct()
    {
        $this->logger = new Logger('custom');
        $this->logger->pushHandler(new StreamHandler(storage_path('logs/custom.log')));
    }

    public function info(string $message, array $context = []): void
    {
        $this->logger->info($message, $context);
    }

    public function error(string $message, array $context = []): void
    {
        $this->logger->error($message, $context);
    }

    public function warning(string $message, array $context = []): void
    {
        $this->logger->warning($message, $context);
    }
} 