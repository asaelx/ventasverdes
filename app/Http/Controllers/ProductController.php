<?php

namespace App\Http\Controllers;

use App\Product;
use App\Variation;
use App\Option;
use App\Media;
use App\Category;
use App\Characteristic;
use Illuminate\Http\Request;
use Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == 'admin'){
            $products = Product::latest()->get();
        }elseif (Auth::user()->role == 'seller') {
            $products = Auth::user()->products()->latest()->get();
        }

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('title', 'id')->toArray();
        $characteristics = Characteristic::pluck('title', 'id')->toArray();
        return view('products.create', compact('categories', 'characteristics'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = $this->saveProduct($request);

        return redirect('admin/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::pluck('title', 'id')->toArray();
        $characteristics = Characteristic::pluck('title', 'id')->toArray();
        return view('products.edit', compact('product', 'categories', 'characteristics'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product = $this->saveProduct($request, $product);
        return redirect('admin/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    /**
     * Save Product in the database
     *
     * @param  Request  $request
     * @param  Product  $product (optional)
     * @return Product  $product
     */
    private function saveProduct($request, $product = null)
    {
        if(is_null($product))
            $product = Auth::user()->products()->create($request->all());
        else
            $product->update($request->all());

        // Options & Variations
        if($request->has('has_variations')){

            // Options
            $options_ids = [];

            foreach ($request->input('options') as $option) {

                $existing_option = Option::where('title', $option['title'])->get();

                if($existing_option->isEmpty()){

                    $newOption = Option::create(['title' => $option['title']]);

                    $options_ids[] = $newOption->id;

                }else{

                    $options_ids[] = $existing_option->first()->id;

                    $newOption = $existing_option->first();

                    foreach ($newOption->values as $value) {

                        $value->delete();

                    }

                }

                foreach ($option['values'] as $value) {

                    $newValue = $newOption->values()->create(['title' => $value]);

                }

            }

            $product->options()->sync($options_ids);

            // Variations
            if($product->variations->count() > 0){

                $product->variations()->detach();

                foreach ($product->variations as $variation) {
                    $variation->delete();
                }

            }

            $variations_ids = [];
            foreach ($request->input('variations_list') as $variation) {

                $sale_price = ($variation['sale_price'] != '') ? $variation['sale_price'] : null;
                $code = ($variation['code'] != '') ? $variation['code'] : null;

                $newVariation = Variation::create([
                    'code' => $code,
                    'title' => $variation['title'],
                    'regular_price' => $variation['regular_price'],
                    'sale_price' => $sale_price,
                    'stock' => $variation['stock'],
                    'length' => $request->input('length'),
                    'height' => $request->input('height'),
                    'width' => $request->input('width'),
                    'weight' => $request->input('weight')
                ]);

                $variations_ids[] = $newVariation->id;

            }

        }else{

            $sale_price = ($request->input('sale_price') != '') ? $request->input('sale_price') : null;
            $code = ($request->input('code') != '') ? $request->input('code') : null;

            $newVariation = Variation::create([
                'code' => $code,
                'title' => $request->input('title'),
                'regular_price' => $request->input('regular_price'),
                'sale_price' => $sale_price,
                'stock' => $request->input('stock'),
                'length' => $request->input('length'),
                'height' => $request->input('height'),
                'width' => $request->input('width'),
                'weight' => $request->input('weight')
            ]);

            $variations_ids[] = $newVariation->id;

        }

        $product->variations()->sync($variations_ids);

        // Photos
        if($request->hasFile('photos')){

            $medias_ids = [];

            foreach ($request->file('photos') as $photo) {

                $url = $photo->store('public/products/'.Auth::user()->username);

                $media = Media::create([
                    'title' => $photo->getClientOriginalName(),
                    'original_name' => $photo->getClientOriginalName(),
                    'url' => str_replace('public/', '', $url),
                    'type' => 'image'
                ]);

                $medias_ids[] = $media->id;

            }

        }

        // Video
        if($request->has('video')){

            $existing_media = Media::where('url', $request->input('video'))->get();

            if($existing_media->isEmpty()){

                $media = Media::create([
                    'title' => $product->title,
                    'original_name' => $product->title,
                    'url' => $request->input('video'),
                    'type' => 'youtube'
                ]);

                $medias_ids[] = $media->id;

            }else{

                $medias_ids[] = $existing_media->first()->id;

            }

        }

        // Existing Photos
        if($request->has('existing_photos')){

            foreach($request->input('existing_photos') as $existing_photo_id){
                $medias_ids[] = $existing_photo_id;
            }

        }

        $product->medias()->sync($medias_ids);

        // Categories
        $product->categories()->sync($request->input('category_list'));

        // Characteristics
        $product->characteristics()->sync($request->input('characteristic_list'));

        return $product;
    }

    /**
     * Display Product in the Frontend
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function displayProduct(Product $product)
    {
        $single = $product;
        $related = $single->categories()->first()->products()->where('id', '!=', $single->id)->get();
        return view('store.products.single_product', compact('single', 'related'));
    }
}
