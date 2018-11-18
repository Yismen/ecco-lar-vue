<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use App\User;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewUserCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->user->email)->markdown('emails.new-user');
    }
}
