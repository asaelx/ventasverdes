<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(CharacteristicsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(QuestionsTableSeeder::class);
        $this->call(ReviewsTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
    }
}