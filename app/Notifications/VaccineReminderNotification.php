<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VaccineReminderNotification extends Notification implements ShouldQueue
{
    use Queueable;
    protected $user;
    protected $scheduledDate;
    protected $centerName;

    /**
     * Create a new notification instance.
     */
    public function __construct($user, $scheduledDate, $centerName)
    {
        $this->user = $user;
        $this->scheduledDate = $scheduledDate;
        $this->centerName = $centerName;
    }

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
                    ->line('Covid Vaccination Reminder')
                    ->line('Hello ' . $this->user->name)
                    ->line('This is a reminder that your vaccination is scheduled on ' . $this->scheduledDate . ' at ' . $this->centerName . '.')
                    ->line('Please make sure to visit the center in time.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
