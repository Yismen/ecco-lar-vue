<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ConsoleCommandFailedNotification extends Notification
{
    use Queueable;

    protected $command;

    protected $exception_message;

    /**
     * Create a new notification instance
     *
     * @param array $roles
     * @param [type] $command
     */
    public function __construct($command, $exception_message)
    {        
        $this->command = $command;
        $this->exception_message = $exception_message;

    }
    
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            'body' => $this->messageBody()
        ];
    }
    
    /**
     * Construct the defult messageBody
     *
     * @return string
     */
    protected function messageBody()
    {
        $time = now();

        return "Command {$this->command} failed at ! {$time}" . 
            " with exception {$this->exception_message}";
    }
}
