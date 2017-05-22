<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = file_get_contents(asset('json/categories.json'));
        $array = json_decode($json, true);

        foreach ($array['categories'] as $category) {
            Category::create([
                'title' => $category['title'],
                'description' => $category['description']
            ]);
        }
    }
}
