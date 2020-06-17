<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommandsBaseMail extends Mailable
{
    use Queueable, SerializesModels;

    public $temporary_mail_attachment;

    public $subject;

    protected $distro;

    protected $options;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $distro, $filename, $subject, $options = [])
    {
        $this->distro = $distro;
        $this->temporary_mail_attachment = $filename;
        $this->subject = $subject;
        $this->options = $this->mergeDefaults($options);
    }

    public function build()
    {
        return $this
            ->from($this->options['from'], 'Yisme Jorge')
            ->to($this->distro)
            ->bcc($this->options['bcc'])
            ->view($this->options['view'])
            ->attachFromStorage($this->temporary_mail_attachment)
            ->subject($this->subject);
    }

    protected function mergeDefaults(array $defaults)
    {
        return array_merge([
            'from' => 'yjorge@eccocorpbpo.com',
            'bcc' => 'yjorge@eccocorpbpo.com',
            'view' => 'emails.commands-email'
        ], $defaults);
    }
}
