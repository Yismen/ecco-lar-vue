<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class UpdateSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dainsys:re-slug {model} {--field=slug}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset the slug field on a given model';

    /**
     * Create a new command instance.
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
        $model = 'App\\'.$this->argument('model');
        $field = $this->option('field');

        if (!class_exists($model)) {
            return $this->error("Model {$model} Not Found...");
        }

        if (!Schema::hasColumn((new $model())->getTable(), $field)) {
            return $this->error("Field {$field} does not exists in model {$model}");
        }

        $collection = (new $model())->all();

        $bar = $this->output->createProgressBar($collection->count());

        $bar->start();

        foreach ($collection as $row) {
            $row->$field = Str::slug($row->$field);

            $row->save();

            $bar->advance();
        }

        $bar->finish();

        return $this->info("Re-slug process completed in model {$model}");
    }
}
