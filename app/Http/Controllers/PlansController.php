<?php

namespace App\Http\Controllers;

use App\Models\plans;
use Illuminate\Http\Request;

class PlansController extends Controller
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
    public function show(plans $plans)
    {
        $plans=plans::all();
        return $plans;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, plans $plans)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(plans $plans)
    {
        //
    }
}
