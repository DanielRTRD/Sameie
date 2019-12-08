<?php

namespace Sameie\Console\Commands;

use Illuminate\Console\Command;
use anlutro\LaravelSettings\Facade as Setting;

class update extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sameie:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates needed application stuff.';

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
        $rev = exec('git rev-parse --short HEAD');
        $tag = exec('git describe --tags --abbrev=0');
        $ver = $tag.' ('.$rev.')';
        $this->info('Updating version...');
        if (Setting::get('APP_VERSION') != $ver) {
            $this->info('Current version: '.Setting::get('APP_VERSION'));
            Setting::set('APP_VERSION', $ver);
            $this->info('Updated version to: '.Setting::get('APP_VERSION'));
            Setting::save();
        }
        $this->info('Done.');
    }
}
