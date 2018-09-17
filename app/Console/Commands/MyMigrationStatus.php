<?php

namespace App\Console\Commands;

use App\User;
use App\Migration;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MyMigrationStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mymigration:status {--dirname=migrations}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Print the status of the migration table';

    protected $migration_array = [];
    protected $headers = [];

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
        \Log::error('Error Message');
        $this->setMigrationsArray()
            ->setHeaders()
            ->table($this->headers, $this->migration_array);
    }

    /**
     * Update the migrations array.
     */
    private function setMigrationsArray()
    {
        foreach ($this->getMigrationFiles($this->option('dirname')) as $partial) {
            $partial = pathinfo($partial);
            $name = $partial["filename"];
            $migrated = $this->getMigration($name);

            $array = [
                'name'=>$name,
                'batch'=>"Pending",
            ];

            if ($migrated) {
                $array = array_merge($array, [
                    'name'=>$migrated['migration'],
                    'batch'=>$migrated['batch'],
                ]);
            }
            array_push($this->migration_array, $array);
        }
        return $this;
    }

    public function setHeaders()
    {
        $this->headers = ['Name', 'Batch'];

        return $this;
    }

    /**
     * Retrieve a row from the migration table filtered by the name of the file.
     * @param  string $name The name of the migration file.
     * @return Model       An instance of the migration based on the name. Null
     * if not found.
     */
    private function getMigration($name)
    {
        return Migration::where('migration', $name)->first();
    }

    /**
     * Retrieve all the migration files located in a given path.
     * @param  string $dir The name of the folder withing the migration folder.
     * @return [type]      [description]
     */
    private function getMigrationFiles($dir)
    {
        return File::files(database_path()."/{$dir}");
    }
}
