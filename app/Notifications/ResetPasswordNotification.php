<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;
    public $resetUrl;

    /**
     * Create a new notification instance.
     */
    public function __construct($token)
    {
        $this->token = $token;
        $this->resetUrl = url(route('password.reset', [
            'token' => $token,
        ], false));
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $resetUrl = $this->resetUrl . '?email=' . urlencode($notifiable->getEmailForPasswordReset());
        $name = $notifiable->nama ?? $notifiable->username ?? 'User';

        return (new MailMessage)
            ->subject('Reset Password - WebsiteDN')
            ->view('emails.reset-password-notification', [
                'resetUrl' => $resetUrl,
                'name' => $name,
            ]);
    }
}
