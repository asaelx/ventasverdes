<?php

namespace App\Http\Controllers;

use App\Page;
use App\Media;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::latest()->get();
        return view('pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('cover')){
            $file = $request->file('cover');
            $path = $file->hashName('public/pages');

            $image = Image::make($file);

            $image->fit(1400, 600);

            Storage::put($path, (string) $image->encode());

            $media = Media::create([
                'title' => $request->input('title'),
                'original_name' => $file->getClientOriginalName(),
                'url' => str_replace('public/', '', $path),
                'type' => 'image'
            ]);

            $request->merge(['cover_id' => $media->id]);
        }
        $page = Page::create($request->all());
        return redirect('admin/pages');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        if($request->hasFile('cover')){
            $file = $request->file('cover');
            $path = $file->hashName('public/pages');

            $image = Image::make($file);

            $image->fit(1400, 600);

            Storage::put($path, (string) $image->encode());

            $media = Media::create([
                'title' => $request->input('title'),
                'original_name' => $file->getClientOriginalName(),
                'url' => str_replace('public/', '', $path),
                'type' => 'image'
            ]);

            $request->merge(['cover_id' => $media->id]);
        }
        $page->update($request->all());
        return redirect('admin/pages');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return redirect('admin/pages');
    }
}
