<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Exports\CapillusFlashReportExport;

class CapillusFlashMail extends Mailable
{
    use Queueable, SerializesModels;

    public $capillus_file_name;


    public $distro;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $distro)
    {
        $this->distro = $distro;
        $instance = Carbon::now()->format('Ymd_His');

        $this->capillus_file_name = "KNYC E Flash Report {$instance} .xlsx";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        foreach ($this->distro as $recipient) {
            $this->to($recipient);
        }
        
        Excel::store(new CapillusFlashReportExport(), $this->capillus_file_name);

        return $this
            ->from('yjorge@eccocorpbpo.com', 'Yisme Jorge')
            ->bcc('yjorge@eccocorpbpo.com')
            ->view('emails.capillus-flash')
            ->attachFromStorage($this->capillus_file_name)
            ->subject("KNYC.E Flash Report");
    }
}
