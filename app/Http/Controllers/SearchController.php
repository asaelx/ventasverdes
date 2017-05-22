<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        if(empty($request->all())){
            $s = '';
            $products = Product::latest();
        }
        elseif($request->input('search') == ''){
            $s = '';
            $products = Product::where('products.title', '!=', $s);
        }else{
            $s = $request->input('search');

            $products = Product::where('products.title', 'LIKE', '%' . $s . '%');
        }

        if($request->has('category')){
            $category_id = $request->input('category');
            $products->whereHas('categories', function($q) use($request){
                $q->where('category_id', $request->input('category'));
            });
        }else{
            $category_id = null;
        }

        if($request->has('price_from') && $request->has('price_to')){
            $products->whereHas('variations', function($q) use($request){
                $q->whereBetween(\DB::Raw('ifnull(sale_price, regular_price)'), [$request->input('price_from'), $request->input('price_to')]);
            });
        }
        if($request->has('sorting')){
            $sorting = $request->input('sorting');
            switch ($request->input('sorting')) {
                case 'low to high':
                    $products->join('product_variation', 'product_variation.product_id', '=', 'products.id')
                            ->join('variations', 'product_variation.variation_id', '=', 'variations.id')
                            ->select([
                                'variations.regular_price',
                                'variations.id AS variation_id',
                                'products.*'
                            ])
                            ->orderByRaw('ifnull(sale_price, regular_price) asc');
                    break;
                case 'high to low':
                    $products->join('product_variation', 'product_variation.product_id', '=', 'products.id')
                            ->join('variations', 'product_variation.variation_id', '=', 'variations.id')
                            ->select([
                                'variations.regular_price',
                                'variations.id AS variation_id',
                                'products.*'
                            ])
                            ->orderByRaw('ifnull(sale_price, regular_price) desc');
                    break;
                case 'most rated':
                    $products->join('reviews', 'reviews.product_id', '=', 'products.id')
                            ->select([
                                'reviews.rating',
                                'reviews.id AS review_id',
                                'products.*'
                            ])
                            ->orderBy('reviews.rating', 'desc');
                    break;
                case 'newest':
                    $products->orderBy('created_at', 'desc');
                    break;
            }
        }else{
            $sorting = null;
        }

        // dd($products->toSql(), $products->getBindings());

        $products = $products->get();

        $categories = [];
        $price_from = 0;
        $price_to = 0;
        $price_min = 0;
        $price_max = 0;

        $all_categories = Category::all();
        $all_products = Product::all();

        foreach ($products as $product) {
            // $product_categories = $product->categories;
            //
            // foreach ($product_categories as $product_category) {
            //     $categories[$product_category->id]['title'] = $product_category->title;
            //     $categories[$product_category->id]['count'] = (isset($categories[$product_category->id]['count'])) ? $categories[$product_category->id]['count'] + 1 : 1;
            // }

            $variations = $product->variations;

            foreach ($variations as $variation) {
                $price = (is_null($variation->sale_price)) ? $variation->regular_price : $variation->sale_price;
                $price_from = ($price_from == 0 || $price < $price_from) ? $price : $price_from;
                $price_to = ($price_to == 0 || $price > $price_to) ? $price : $price_to;
            }
        }

        foreach ($all_products as $all_product) {
            $variations = $all_product->variations;
            foreach ($variations as $variation) {
                $price = (is_null($variation->sale_price)) ? $variation->regular_price : $variation->sale_price;
                $price_min = ($price_min == 0 || $price < $price_min) ? $price : $price_min;
                $price_max = ($price_max == 0 || $price > $price_max) ? $price : $price_max;
            }
        }

        if($price_from == $price_to){
            $price_from = $price_min;
            $price_to = $price_max;
        }

        if($request->has('price_from') && $request->has('price_to')){
            $price_from = $request->input('price_from');
            $price_to = $request->input('price_to');
        }

        return view('store.search.index', compact(
            'products',
            's',
            'all_categories',
            'price_from',
            'price_to',
            'price_min',
            'price_max',
            'category_id',
            'sorting')
        );
    }
}
