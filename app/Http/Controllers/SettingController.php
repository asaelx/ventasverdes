<?php

namespace App\Http\Controllers;

use App\Setting;
use App\Media;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::latest()->first();
        return view('settings.edit', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        if($request->hasFile('favicon')){
            $url = $request->file('favicon')->store('public/favicon');
            $data = [
                'title' => 'Favicon',
                'original_name' => $request->file('favicon')->getClientOriginalName(),
                'url' => str_replace('public/', '', $url),
                'type' => 'image'
            ];
            if(is_null($setting->favicon)){

                $media = Media::create($data);

                $setting->update(['favicon_id' => $media->id]);

            }else{

                $setting->favicon()->first()->update($data);

            }
        }

        if($request->hasFile('logo')){
            $url = $request->file('logo')->store('public/logo');
            $data = [
                'title' => 'Logo',
                'original_name' => $request->file('logo')->getClientOriginalName(),
                'url' => str_replace('public/', '', $url),
                'type' => 'image'
            ];
            if(is_null($setting->logo)){

                $media = Media::create($data);

                $setting->update(['logo_id' => $media->id]);

            }else{

                $setting->logo()->first()->update($data);

            }
        }

        $setting->update($request->all());

        return redirect('admin/settings');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
