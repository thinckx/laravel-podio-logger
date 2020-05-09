<?php 

namespace ThomasInckx\PodioLogger;

use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;

class PodioLoggerHandler extends AbstractProcessingHandler
{
    protected function write(array $record): void
    {
        $level = strtolower(Logger::getLevelName($record['level']));

        PodioLogger::log($record['message'], $level)
            ->send();
    }
}