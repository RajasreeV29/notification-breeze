<?php

namespace App\Services;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\App;

class CustomLoggerService
{
    protected string $logFile;
    
    public function __construct()
    {
        $this->logFile = storage_path('logs/custom.log');
    }

    public function log(string $message): void
    {
        $timestamp = now()->toDateTimeString();
        File::append($this->logFile, "[$timestamp] $message" . PHP_EOL);
    }
}
