<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Page;
use App\Link;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::latest()->get();
        return view('menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pages = Page::pluck('title', 'id');
        return view('menus.create', compact('pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $menu = Menu::create($request->all());
        $links_ids = [];

        foreach ($request->input('links') as $link) {
            if(isset($link['page']))
                $links_ids[] = Link::create(['title' => $link['title'], 'page_id' => $link['page']])->id;
            if(isset($link['url']))
                $links_ids[] = Link::create(['title' => $link['title'], 'url' => $link['url']])->id;
        }

        $menu->links()->sync($links_ids);
        return redirect('admin/menus');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $pages = Page::pluck('title', 'id');
        return view('menus.edit', compact('menu', 'pages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $menu->update($request->all());
        $links_ids = [];

        foreach ($request->input('links') as $link) {
            if(isset($link['page']))
                $links_ids[] = Link::create(['title' => $link['title'], 'page_id' => $link['page']])->id;
            if(isset($link['url']))
                $links_ids[] = Link::create(['title' => $link['title'], 'url' => $link['url']])->id;
        }

        $menu->links()->sync($links_ids);
        return redirect('admin/menus');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect('admin/menus');
    }
}
