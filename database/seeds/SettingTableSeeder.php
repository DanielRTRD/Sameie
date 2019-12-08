<?php

use Illuminate\Database\Seeder;
use anlutro\LaravelSettings\Facade as Setting;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (env('APP_LICENSE_KEY') && env('APP_ENV') && env('APP_LOG_LEVEL') == 'debug') {
            $license = env('APP_LICENSE_KEY');
        } else {
            $license = '';
        }
        Setting::set('APP_NAME', 'Sameie');
        Setting::set('APP_VERSION', '');
        Setting::set('APP_URL', 'http://infihex.com/');
        Setting::set('APP_LICENSE_STATUS', '');
        Setting::set('APP_LICENSE_STATUS_DESC', '');
        Setting::set('APP_LICENSE_LOCAL_KEY', '');
        Setting::set('APP_LICENSE_KEY', $license);
        Setting::set('APP_SHOW_RESETDB', true);

        Setting::save();
    }
}
