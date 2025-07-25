<?php

namespace App\Notifications;

use App\Enums\PositionStatusEnum;
use App\Models\Position;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class NewPositionNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Position $position)
    {
        //
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
        $publishUrl = URL::temporarySignedRoute('position-update-status-link',now()->addDay(),  ['position' => $this->position, 'status' => PositionStatusEnum::PUBLISH]);
        $spamUrl = URL::temporarySignedRoute('position-update-status-link',now()->addDay(),  ['position' => $this->position, 'status' => PositionStatusEnum::SPAM]);
        return (new MailMessage)->markdown('mail.position.new', [
            'position' => $this->position,
            'publishUrl' => $publishUrl,
            'spamUrl' => $spamUrl,
            'notifiable' =>  $notifiable
        ]);
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
