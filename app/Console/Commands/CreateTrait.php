<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateTrait extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'my_trait:create {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create my personal traits to decorate the controllers';

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
        //
    }
}
