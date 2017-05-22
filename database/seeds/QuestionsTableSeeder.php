<?php

use Illuminate\Database\Seeder;
use App\User;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer = User::where('role', 'customer')->first();
        $questions = factory('App\Question', 40)->create(['user_id' => $customer->id]);
    }
}
