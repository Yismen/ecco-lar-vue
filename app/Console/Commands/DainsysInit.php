<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DainsysInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dainsys:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        try {
            $this->askForEnv()
                ->askForComposer()
                ->askForNpm()
                ->askForMigration()
                ->askForSeeders();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    protected function askForComposer()
    {
        if ($this->confirm('Do you want to instal COMPOSER dependencies?')) {
            shell_exec('composer isntall');
        }
        return $this;
    }

    protected function askForNpm()
    {
        if ($this->confirm('Do you want to instal NODE NPM dependencies?')) {
            shell_exec('npm isntall');
        }
        return $this;
    }

    protected function askForEnv()
    {
        if (!file_exists('.env') && file_exists('.env.example')) {
            if ($this->confirm('Do you want to copy env file?')) {
                copy('.env.example', '.env');

                $this->call('key:generate');
            }
        }
        return $this;
    }

    protected function askForMigration()
    {
        if ($this->confirm('Do you want to migrate?')) {
            $this->call('migrate', [
                '--step'
            ]);
        }
        return $this;
    }

    protected function askForSeeders()
    {
        if ($this->confirm('Do you want to seed the database?')) {
            $this->call('db:seed');
        }
        return $this;
    }
}
