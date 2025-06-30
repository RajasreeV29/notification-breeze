<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Carbon\Carbon;
use App\Models\Package; 
use App\Notifications\PackageExpiryNotification;
use App\Jobs\SendPackageExpiryNotification;
use App\Console\Commands\SendMail;
use Illuminate\Support\Facades\Schedule;
use App\Console\Commands\DeleteOldSoftDeletedPosts;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


// Schedule::command(SendMail::class)->everyTwoSeconds();
// Schedule::job(SendPackageExpiryNotification::class)->everyTwoSeconds();
Schedule::job(new SendPackageExpiryNotification)->everyTwoSeconds();
// ->everyTenMinutes();
// ->dailyAt('09:00');

Schedule::command(DeleteOldSoftDeletedPosts::class)->everyTwoSeconds();