<?php

use App\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Backup
        $setting = new Setting();
        $setting->option = 'backup';
        $setting->value = 'sunday';
        $setting->save();

        // Color Theme
        $setting = new Setting();
        $setting->option = 'theme';
        $setting->value = 'red';
        $setting->save();

        // User Enabled
        $setting = new Setting();
        $setting->option = 'user_enabled';
        $setting->value = 'true';
        $setting->save();
    }
}
