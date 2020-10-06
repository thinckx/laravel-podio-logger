<?php 

namespace ThomasInckx\PodioLogger;

use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;

class PodioLoggerHandler extends AbstractProcessingHandler
{
    protected function write(array $record): void
    {
        $level = strtolower(Logger::getLevelName($record['level']));

        $message = is_string($record['message']) ? $record['message'] : json_encode($record['message']);
        PodioLogger::log(json_encode($message, $level))
            ->send();
    }
}