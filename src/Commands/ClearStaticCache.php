<?php

namespace MScharl\LaravelStaticImageCache\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class ClearStaticCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'static-image-cache:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear static image caches';

    /**
     * @var Filesystem
     */
    private $files;

    /**
     * Create a new command instance.
     *
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        $this->files = $files;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->clearStorageDirectory(config('static-image-cache.cache_path_prefix'));

        $this->info('Static caches cleared!');
    }

    /**
     * @param $storage_path
     */
    private function clearStorageDirectory($storage_path)
    {
        $storage_path = public_path($storage_path);
        $this->comment("Clearing `{$storage_path}`…");

        if($this->files->isDirectory($storage_path))
        {
            $this->files->deleteDirectory($storage_path, true);
        }
    }
}
