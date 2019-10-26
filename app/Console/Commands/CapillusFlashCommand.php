<?php

namespace App\Console\Commands;

use App\Mail\CapillusFlashMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CapillusFlashCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dainsys:capillus-flash';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send and email to the distro list with the Capillus Flash Report';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Mail::send(
            new CapillusFlashMail($this->distroList())
        );

        $this->info("Capillus lash report sent!");
    }

    /**
     * Parse the distro list from the dainsys config file
     *
     * @return array
     */
    protected function distroList(): array
    {
        $list = config('dainsys.capillus-flash-distro') ?? 
            abort(404, "Invalid distro list. Set it up in the .env, separated by pipe (|).");

        return explode("|", $list);
    }
}
