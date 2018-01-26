<?php

namespace LaravelEnso\Core\app\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $token;
    public $user;

    public function __construct($user, $token)
    {
        $this->token = $token;
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->line('Please set or reset your password by clicking the button below.')
            ->action('Direct Link', config('app.url').'/password/reset/'.$this->token)
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
