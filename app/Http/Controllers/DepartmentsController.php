<?php

namespace App\Http\Controllers;

use App\Models\departments;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
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
    public function show(departments $departments)
    {
        $departments = departments::selectRaw("id,
                                     name
                                     ")
                                      ->orderBy('name', 'ASC')
                                      ->get();
        return $departments;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, departments $departments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(departments $departments)
    {
        //
    }
}
