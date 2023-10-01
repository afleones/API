<?php

namespace App\Http\Controllers;

use App\Models\typedocumentidentifications;
use Illuminate\Http\Request;

class TypedocumentidentificationsController extends Controller
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
    public function show(typedocumentidentifications $typedocumentidentifications)
    {
         $typedocumentidentifications = typedocumentidentifications::selectRaw("id,
                                     name
                                     ")
                                      ->orderBy('name', 'ASC')
                                      ->get();
        return $typedocumentidentifications;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, typedocumentidentifications $typedocumentidentifications)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(typedocumentidentifications $typedocumentidentifications)
    {
        //
    }
}
