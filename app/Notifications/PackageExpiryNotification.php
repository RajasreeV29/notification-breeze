<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Package; 

class PackageExpiryNotification extends Notification
{
    use Queueable;
    protected $package;
    protected $resident;
    /**
     * Create a new notification instance.
     */
    public function __construct(Package $package)
    {
        $this->package =$package;
        $this->resident = $package->resident;    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Package Expiry Notice')
            ->line("Dear {$notifiable->res_name},")
            ->line("Your package {$this->package->package_name} will expire tomorrow.")
            ->line("Expiry Date: {$this->package->credit_due} ");
            // ->view('emails.PackageExpiryNotification');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    // public function toArray(object $notifiable): array
    // {
    //     return [
    //         //
    //     ];
    // }
}
