<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Package;
use App\Models\Resident;
use Illuminate\Foundation\Bus\Dispatchable;

class PackageExpiry extends Mailable
{
    use Dispatchable,  Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct( 
        public Package $package, public Resident $resident
        )
    {  }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Package Expiry',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.PackageExpiryNotification',
            with: [
                'ResidentName' => $this->resident->res_name,
                'ExpiryDate' => $this->package->credit_due,
                'package' => $this->package->package_name
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
