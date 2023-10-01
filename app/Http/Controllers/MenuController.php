<?php

namespace App\Http\Controllers;

use App\Models\menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function getMenuWithItems()
    {
        $menu = Menu::with(['items' => function($query) {
            $query->select('id_menu','title','icon','link','type');
        }])->select('id','title', 'icon', 'type')->get();
        $menu = Menu::with('items')->get(['id', 'title', 'icon', 'type']);
        $menu = Menu::with('items:id_menu,title,icon,link,type')->select('id','title', 'icon', 'type')->get();
        $dash='{
            title: "Dashboard",
            icon: "M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z",
            link:"/",
            type: "link",
            role: "free",
        },';
        return response()->json(['menu' => $menu], 200);
    }
    
    public function index()
    {



    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, menu $menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(menu $menu)
    {
        //
    }
}
