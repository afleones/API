<?php

namespace App\Http\Controllers;

use App\Models\resolution;
use Illuminate\Http\Request;

class ResolutionController extends Controller
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
    public function show(resolution $resolution)
    {
        
        $resolution = resolution::selectRaw("prefix,
                                             resolution,
                                             company_id
                                     ")
                                      ->where('resolution', '!=', NULL)
                                      ->get();
        
        $newArray = array();
        foreach ($resolution as $item) {
            $newObject = array(
                ['prefix' => $item->prefix],
                ['resolution' => $item->resolution],
                ['company_id' => $item->company_id]
            );
            $newArray = $newObject;
        }

        return $newArray;
    }

    public function showresolution(resolution $resolution)
    {
        
        $resolution = resolution::all();
        return $resolution;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, resolution $resolution)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(resolution $resolution)
    {
        //
    }
}
