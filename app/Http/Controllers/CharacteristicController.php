<?php

namespace App\Http\Controllers;

use App\Characteristic;
use App\Media;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class CharacteristicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $characteristics = Characteristic::latest()->get();
        return view('characteristics.index', compact('characteristics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('characteristics.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('icon')){
            $file = $request->file('icon');
            $path = $file->hashName('public/characteristics');

            $image = Image::make($file);

            $image->fit(18, 18, function($constraint){
                $constraint->aspectRatio();
            });

            Storage::put($path, (string) $image->encode());

            $media = Media::create([
                'title' => $request->input('title'),
                'original_name' => $request->file('icon')->getClientOriginalName(),
                'url' => str_replace('public/', '', $path),
                'type' => 'image'
            ]);
            $request->merge(['icon_id' => $media->id]);
        }
        $characteristic = Characteristic::create($request->all());
        return redirect('admin/characteristics');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Characteristic  $characteristic
     * @return \Illuminate\Http\Response
     */
    public function show(Characteristic $characteristic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Characteristic  $characteristic
     * @return \Illuminate\Http\Response
     */
    public function edit(Characteristic $characteristic)
    {
        return view('characteristics.edit', compact('characteristic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Characteristic  $characteristic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Characteristic $characteristic)
    {
        if($request->hasFile('icon')){
            $file = $request->file('icon');
            $path = $file->hashName('public/characteristics');

            $image = Image::make($file);

            $image->fit(18, 18, function($constraint){
                $constraint->aspectRatio();
            });

            Storage::put($path, (string) $image->encode());

            $media = Media::create([
                'title' => $request->input('title'),
                'original_name' => $request->file('icon')->getClientOriginalName(),
                'url' => str_replace('public/', '', $path),
                'type' => 'image'
            ]);
            $request->merge(['icon_id' => $media->id]);
        }
        $characteristic->update($request->all());
        return redirect('admin/characteristics');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Characteristic  $characteristic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Characteristic $characteristic)
    {
        //
    }
}
