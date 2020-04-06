<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

class ClearLogsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dainsys:logs 
        {filename=laravel- : The pattern with which filename starts.} 
        {--keep=4 : The number of files to keep.}
        {--clear : Remove all files except last (n) files, otherwise just print a list of filenames!}
   ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    protected $filesystem;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();

        
        $this->filesystem = $filesystem;
    }
    
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {      
        $files = $this->getFiles();

        if($this->option('clear'))
        {
            $deleted = $this->deleteFiles($files);
            $this->info("Deleted {$deleted} files!");
            return ;
        }

        $this->info($this->listFiles($files));
    }

    protected function deleteFiles($files): int
    {
        if ($files == null) {
            return 0;
        }
        $files->each(function($file) {
            $this->filesystem->delete($file);
        });

        return count($files);
    }

    protected function listFiles($files)
    {
        return $files == null 
            ? "Nothing to list!"
            : $files->map(function($file) {
                return $file->getFileName();
            });
    }

    protected function getFiles()
    {
        $files = collect(
            $this->filesystem->allFiles(storage_path('logs'))
        )->sortByDesc('mtime')->filter(function($file) {
            return Str::startsWith($file->getFilename(), $this->argument('filename'));
        });

        if($files->count() > $this->option('keep')) {
            $splice = $files->splice($files->count() - $this->option('keep'));

            return $files;
        }
    }
}
