<?php

use Illuminate\Database\Seeder;
use App\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = Setting::create([
            'title' => 'Ventas Verdes',
            'description' => 'Tienda en línea',
            'footer' => '© Copyright 2016 - Green. Todos los derechos reservados.'
        ]);
    }
}
