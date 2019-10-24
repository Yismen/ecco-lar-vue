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

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->capillus_file_name = "KNYC E Flash Report " . $timestamp = Carbon::now()->format('Ymd_His') . '.xlsx';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        Excel::store(new CapillusFlashReportExport(), $this->capillus_file_name);

        return $this
            ->to('KipanyCapillus@kipany.com')
            ->to('eccocapillus@eccocorpbpo.com')
            ->from('yjorge@eccocorpbpo.com', 'Yisme Jorge')
            ->bcc('yjorge@eccocorpbpo.com')
            ->view('emails.capillus-flash')
            ->subject("KNYC E Flash Report")
            ->attachFromStorage($this->capillus_file_name);
    }
}
