<?php

namespace App\Http\Controllers;

use App\Models\creditnote;
use Illuminate\Http\Request;

class CreditnoteController extends Controller
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
        $data = $request->all();

        $proximoConsecutivo = creditnote::obtenerConsecutivo(['order_prefix' => $data['prefijo']]);


        // Creamos un nuevo objeto del modelo
        $creditnote = new creditnote();

        // Asignamos los datos a las propiedades del objeto
        $creditnote->order_prefix = $data['prefijo'];
        $creditnote->order_id = $proximoConsecutivo ;
        $creditnote->order_resolution = '';
        $creditnote->user_id = auth()->user()->id;
        $creditnote->order_receiver_name = $data['numberId'].'-'.$data['dv'].' -- '.$data['nombreTercero'];
        $creditnote->order_receiver_address = 'direccion';
        $creditnote->order_receiver_nit = $data['numberId'].'-'.$data['dv'];
        $creditnote->order_receiver_phone = $data['telefono'];
        $creditnote->order_date = $data['fecha'];
        $creditnote->payment_methods = $data['paymentMethod'];
        $creditnote->payment_forms = $data['paymentOption'];
        $creditnote->plazoPago = $data['plazoPago'];
        $creditnote->vencimiento = $data['vencimiento'];

        $creditnote->order_total_before_tax  = $data['order_total_before_tax'];
        $creditnote->order_total_tax = $data['order_total_tax'];
        $creditnote->order_tax_per = 0;
        $creditnote->order_total_after_tax = $data['order_total_after_tax'];
        $creditnote->order_amount_paid = $data['order_total_after_tax'];
        $creditnote->order_total_amount_due = 0;
        $creditnote->note = $data['observation'];
        $creditnote->cufe = 0;
        $creditnote->status = 0;

        $creditnote->factura_acreditar = $data['factura_acreditar'];



        // Guardamos el objeto en la base de datos
        $creditnote->save();
        return response()->json(['message' => 'Datos insertados correctamente',
                                 'prefijo' =>  $data['prefijo'],
                                 'consecutivo' => $proximoConsecutivo  
                                ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(creditnote $creditnote)
    {
        $creditnote = creditnote::on('maite')->selectRaw("CONCAT(order_prefix, '', order_id)  AS Number,
                                     order_receiver_name AS Customer, 
                                     order_date AS DateNumber,
                                     order_total_after_tax AS Total,
                                     order_amount_paid AS ToApply
                                     ")->get();
        return $creditnote;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, creditnote $creditnote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(creditnote $creditnote)
    {
        //
    }
}
