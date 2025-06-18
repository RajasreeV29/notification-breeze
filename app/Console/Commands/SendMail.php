<?php

namespace App\Console\Commands;
use App\Models\Resident;
use Carbon\Carbon;
use App\Notifications\PackageExpiryNotification;
use Illuminate\Support\Facades\Mail;
use App\Mail\PackageExpiry;

use Illuminate\Console\Command;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command for sending mail to residents whose package is about to expire';

    /**
     * Execute the console command.
     */
    public function handle()
    {
       $residents = Resident::with('package')->get();
       foreach($residents as $resident) {
        if($resident->package) {
        $expiryDate = Carbon::parse($resident->package->credit_due); 
        $today = Carbon::today();
        if ($resident->package && $expiryDate->subDay()->isSameDay($today)) {
        $resident->notify(new PackageExpiryNotification($resident->package));
    //  Mail::to($resident->email)->send(new PackageExpiry($package));
        
        
    }
        }
    }
    }
}
