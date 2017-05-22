<?php

use Illuminate\Database\Seeder;
use App\User;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer = User::where('role', 'customer')->first();
        $reviews = factory('App\Review', 30)->create(['user_id' => $customer->id]);
    }
}
