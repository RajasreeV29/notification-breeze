<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendPackageExpiryNotification;
use App\Mail\PackageExpiry;
use App\Models\Resident;
use App\Models\Package;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;

class SendPackageExpiryNotificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_sends_mail_to_resident_with_package_expiring_tomorrow()
    {
        Mail::fake();

        $package = Package::factory()->create([
            'credit_due' => Carbon::tomorrow()->format('Y-m-d'),
        ]);

        $resident = Resident::factory()->create([
            'email' => 'test@example.com',
            'package_id' => $package->id,
        ]);


        // Attach the package to the resident
        $resident->package()->associate($package);
        $resident->save();

        // Run the job
        $job = new SendPackageExpiryNotification();
        $job->handle();

        // Assert the email was sent
        Mail::assertSent(PackageExpiry::class, function ($mail) use ($resident) {
            return $mail->hasTo('test@example.com');
        });
    }

    
}
