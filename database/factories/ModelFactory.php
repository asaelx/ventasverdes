<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Media::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->randomNumber(),
        'original_name' => $faker->randomNumber(),
        'type' => 'image'
    ];
});

$factory->define(App\Variation::class, function (Faker\Generator $faker) {
    return [
        'code' => strtoupper(str_random(5)),
        'title' => $faker->sentence(3),
        'regular_price' => $faker->randomFloat(2, 10, 400),
        'sale_price' => $faker->randomFloat(2, 9, 380),
        'stock' => $faker->numberBetween(10, 100),
        'length' => $faker->randomFloat(2, 1, 10),
        'height' => $faker->randomFloat(2, 1, 10),
        'width' => $faker->randomFloat(2, 1, 10),
        'weight' => $faker->randomFloat(2, 1, 10)
    ];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(6),
        'description' => $faker->text(400)
    ];
});

$factory->define(App\Option::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(1)
    ];
});

$factory->define(App\Value::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(1)
    ];
});

$factory->define(App\Question::class, function (Faker\Generator $faker) {
    return [
        'content' => '¿' . $faker->sentence(5) . '?',
        'product_id' => function() {
            $product = App\Product::orderByRaw("RAND()")->first();
            return $product->id;
        }
    ];
});

$factory->define(App\Review::class, function (Faker\Generator $faker) {
    return [
        'rating' => $faker->numberBetween(1, 5),
        'content' => $faker->sentence(5),
        'product_id' => function() {
            $product = App\Product::orderByRaw("RAND()")->first();
            return $product->id;
        }
    ];
});
