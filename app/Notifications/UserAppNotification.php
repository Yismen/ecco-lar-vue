<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserAppNotification extends Notification
{
    use Queueable;

    protected $subject;

    protected $body;

    /**
     * Create a new notification instance
     *
     * @param String $subject
     * @param String $body
     */
    public function __construct($subject, $body)
    {        
        $this->subject = $subject;
        $this->body = $body;
    }
    
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject("Dainsys: ". $this->subject)
                    ->line($this->body)
                    ->action('Open App', url('/admin'));
    }
    
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'subject' => $this->subject,
            'body' => $this->body,
        ];
    }
}
