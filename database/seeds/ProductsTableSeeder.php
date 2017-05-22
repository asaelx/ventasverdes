<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Category;
use App\Characteristic;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seller = User::where('role', 'seller')->first();

        foreach (range(1,30) as $index) {

            $category = Category::orderByRaw("RAND()")->first();
            $characteristic = Characteristic::orderByRaw("RAND()")->first();
            $media = factory('App\Media')->create(['url' => 'products/examples/' . $index . '.jpeg']);
            $variation = factory('App\Variation')->create();

            $product = factory('App\Product')->create(['user_id' => $seller->id]);

            $product->categories()->sync([$category->id]);
            $product->characteristics()->sync([$characteristic->id]);
            $product->medias()->sync([$media->id]);
            $product->variations()->sync([$variation->id]);

        }
    }
}
