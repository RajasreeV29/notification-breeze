<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PackageAsign extends Notification
{
    use Queueable;

   protected $package;
//    protected $resident;

    public function __construct($package)
    {
        $this->package = $package;
        // $this->$resident =$resident;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Package Assigned')
            ->line('$this->mailData["Hi"]')
            ->line('$this->mailData["Package"]')
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            // 'resident_id' => $this->resident->id,
            // 'resident_name' => $this->resident->name,
            'package_id' => $this->package->id,
            'package_name' => $this->package->package_name,
            'message' => "Dear {$notifiable->res_name}, Package {$this->package->id} - {$this->package->package_name} has been assigned to you",
        ];
    }
}
