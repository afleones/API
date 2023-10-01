<?php

namespace App\Http\Controllers;

use App\Models\municipalities;
use Illuminate\Http\Request;

class MunicipalitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(municipalities $municipalities)
    {
        
        $municipalities = municipalities::selectRaw("id,
                                     name
                                     ")
                                      ->orderBy('name', 'ASC')
                                      ->get();
        return $municipalities;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, municipalities $municipalities)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(municipalities $municipalities)
    {
        //
    }
}
