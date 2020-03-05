<?php

namespace App\Mail\Political;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

abstract class PoliticalMailBase extends Mailable
{
    use Queueable, SerializesModels;

    public $temporary_mail_attachment;

    public $report_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $distro, $filename, $report_name)
    {
        $this->temporary_mail_attachment = $filename;
        $this->report_name = $report_name;

        
        foreach ($distro as $recipient) {
            $this->to($recipient);
        }
    }

    public function defaultBuild($subject, $defaults = [])
    {
        $defaults = $this->mergeDefaults($defaults);

        return $this
            ->from($defaults['from'], 'Yisme Jorge')
            ->bcc($defaults['bcc'])
            ->view($defaults['view'])
            ->attachFromStorage($this->temporary_mail_attachment)
            ->subject($subject);
    }

    protected function mergeDefaults(array $defaults)
    {
        return array_merge([
            'from' => 'yjorge@eccocorpbpo.com',
            'bcc' => 'yjorge@eccocorpbpo.com',
            'view' => 'emails.political'
        ], $defaults);
    }
}
