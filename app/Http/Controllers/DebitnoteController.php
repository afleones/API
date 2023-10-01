<?php

namespace App\Http\Controllers;

use App\Models\debitnote;
use Illuminate\Http\Request;

class DebitnoteController extends Controller
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
    public function show(debitnote $debitnote)
    {
        //$debitnote=debitnote::all();
        $debitnote = debitnote::selectRaw("CONCAT(order_prefix, '', order_id)  AS Number,
                                     order_receiver_name AS Customer, 
                                     order_date AS Creation,
                                     order_date AS Expiration,
                                     order_total_after_tax AS Total,
                                     order_amount_paid AS Collected,
                                     (order_total_after_tax-order_amount_paid) AS Outstanding,
                                     Status AS StatusDian,
                                     Status
                                     ")->get();
        return $debitnote;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, debitnote $debitnote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(debitnote $debitnote)
    {
        //
    }
}
