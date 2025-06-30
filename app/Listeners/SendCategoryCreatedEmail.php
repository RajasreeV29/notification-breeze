<?php

namespace App\Listeners;

use App\Events\CategoryEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Category;
use Illuminate\Support\Facades\Mail;
use App\Mail\CategoryCreatedMail;

class SendCategoryCreatedEmail
{
 
    /**
     * Handle the event.
     */
    public function handle(CategoryEvent $event): void
    {
   $adminEmail = 'rajasree@ecaret.com';
   $adminName = 'Rajasree';
   Mail::to($adminEmail)->send(new CategoryCreatedMail($event->category,$adminName));
}
}