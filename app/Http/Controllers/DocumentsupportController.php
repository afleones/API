<?php

namespace App\Http\Controllers;

use App\Models\documentsupport;
use Illuminate\Http\Request;

class DocumentsupportController extends Controller
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
    public function show(documentsupport $documentsupport)
    {
        //$documentsupport=documentsupport::all();
        $documentsupport = documentsupport::selectRaw("CONCAT(order_prefix, '', order_id)  AS Number,
                                     order_receiver_name AS Supplier, 
                                     order_date AS Creation,
                                     order_date AS Expiration,
                                     order_total_after_tax AS Total,
                                     order_amount_paid AS Paid,
                                     (order_total_after_tax-order_amount_paid) AS Payable
                                     ")->get();
        return $documentsupport;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, documentsupport $documentsupport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(documentsupport $documentsupport)
    {
        //
    }
}
