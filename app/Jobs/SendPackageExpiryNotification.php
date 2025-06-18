<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Package;
use App\Models\Resident;
use App\Mail\PackageExpiry;
use Illuminate\Support\Facades\Mail;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Notifications\PackageExpiryNotification;

class SendPackageExpiryNotification implements ShouldQueue
{
    use Queueable;
use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    /**
     * Create a new job instance.
     */

    public $timeout = 30;
    public function __construct()
    {
        // $this->onQueue('notifications');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
       
        $residents = Resident::with('package')->get();
        foreach($residents as $resident) {
        if($resident->package) {
        $expiryDate = Carbon::parse($resident->package->credit_due); 
        $today = Carbon::today();
        if ($resident->package && $expiryDate->subDay()->isSameDay($today)) {
        // $resident->notify(new PackageExpiryNotification($resident->package));
        Mail::to($resident->email)->send(new PackageExpiry($resident->package, $resident));
        
        
    }
        }
    }

    }
}
