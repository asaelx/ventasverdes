<?php

use Illuminate\Database\Seeder;
use App\Characteristic;

class CharacteristicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = file_get_contents(asset('json/characteristics.json'));
        $array = json_decode($json, true);

        foreach ($array['characteristics'] as $category) {
            Characteristic::create([
                'title' => $category['title'],
                'description' => $category['description']
            ]);
        }
    }
}
