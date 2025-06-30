<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Category;

class CategoryCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The category instance.
     *
     * @var \App\Models\Category
     */
   public $category;
    public $adminName;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\Category $category
     */
    public function __construct(Category $category, string $adminName)
    {
        $this->category = $category;
        $this->adminName= $adminName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Category Created Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.categoryMail',
            with: [
                'category' => $this->category->name,
                'created_at'=>$this->category->created_at,
                'name'=>$this->adminName,
                
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
