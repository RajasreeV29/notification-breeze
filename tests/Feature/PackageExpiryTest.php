<?php

namespace Tests\Feature;

use Tests\TestCase;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Mail\PackageExpiry;
use App\Models\Package;
use App\Models\Resident;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PackageExpiryTest extends TestCase
{
    use RefreshDatabase;

   public function test_it_builds_the_mail_with_correct_data_and_attachment()
{
    // Fake the public disk and create a dummy file
    Storage::disk('public')->put('dummy.pdf', 'Dummy file content');


    // Create Package
    $package = Package::factory()->create([
        'package_name' => 'Gold Plan',
        'credit_due' => '2025-06-30',
        'file_path' => 'dummy.pdf',
    ]);

    // Create Resident with that package
    $resident = Resident::factory()->create([
        'res_name' => 'John Doe',
        'email' => 'test@example.com',
        'package_id' => $package->id,
    ]);

    // Create and build the Mailable
    $mail = new PackageExpiry($package, $resident);
    
    // Assertions on view, data, subject
    $this->assertEquals('emails.PackageExpiryNotification', $mail->content()->view);
    $this->assertEquals('John Doe', $mail->content()->with['ResidentName']);
    $this->assertEquals('2025-06-30', $mail->content()->with['ExpiryDate']);
    $this->assertEquals('Gold Plan', $mail->content()->with['package']);

    // Subject
    $this->assertEquals('Package Expiry', $mail->envelope()->subject);


        $attachments = $mail->attachments();

        // Assert that one attachment exists
        $this->assertCount(1, $attachments);

        // Assert the attachment is an instance of the Attachment class
        $this->assertInstanceOf(\Illuminate\Mail\Mailables\Attachment::class, $attachments[0]);

        // Assert the file actually exists on disk (since it was added via `fromPath`)
        $this->assertTrue(
            file_exists(storage_path('app/public/package/SBYBUpLrawVWZFTQJr1U871a7IuHhb3FgKpjM357.jpg')),
            'Expected attachment file does not exist.'
        );


}

}
