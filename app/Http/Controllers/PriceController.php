<?php

namespace App\Http\Controllers;

use App\Models\price;

use App\Models\detailprice;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PriceController extends Controller
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

        $proximoConsecutivo = price::obtenerConsecutivo(['order_prefix' => $data['prefijo']]);


        // Creamos un nuevo objeto del modelo
        $price = new price();

        // Asignamos los datos a las propiedades del objeto
        $price->order_prefix = $data['prefijo'];
        $price->order_id = $proximoConsecutivo ;
        $price->order_resolution = '';
        $price->user_id = auth()->user()->id;
        $price->order_receiver_name = $data['numberId'].'-'.$data['dv'].' -- '.$data['nombreTercero'];
        $price->order_receiver_address = 'direccion';
        $price->order_receiver_nit = $data['numberId'].'-'.$data['dv'];
        $price->order_receiver_phone = $data['telefono'];
        $price->order_date = $data['fecha'];
        $price->payment_methods = $data['paymentMethod'];
        $price->payment_forms = $data['paymentOption'];
        $price->plazoPago = $data['plazoPago'];
        $price->vencimiento = $data['vencimiento'];

        $price->order_total_before_tax  = $data['order_total_before_tax'];
        $price->order_total_tax = $data['order_total_tax'];
        $price->order_tax_per = 0;
        $price->order_total_after_tax = $data['order_total_after_tax'];
        $price->order_amount_paid = $data['order_total_after_tax'];
        $price->order_total_amount_due = 0;
        $price->note = $data['observation'];
        $price->cufe = 0;
        $price->status = 0;



        // Guardamos el objeto en la base de datos
        $price->save();
        return response()->json(['message' => 'Datos insertados correctamente',
                                 'prefijo' =>  $data['prefijo'],
                                 'consecutivo' => $proximoConsecutivo  
                                ]);
    }


    

    /**
     * Display the specified resource.
     */
    public function show(price $price)
    {
        //$price=price::all();
        $price = price::selectRaw("CONCAT(order_prefix, '', order_id)  AS Number,
                                     order_receiver_name AS Customer, 
                                     order_date AS Creation,
                                     order_date AS Expiration,
                                     order_total_after_tax AS Total,
                                     order_amount_paid AS Collected,
                                     cufe,
                                     (order_total_after_tax-order_amount_paid) AS Outstanding,
                                     Status
                                     ")
                                      ->orderBy('order_id', 'DESC')
                                      ->get();
        return $price;
    }

    public function getinvoice(Request $request, maite $price)
    {
        
        $data = $request->json()->all();
        //var_dump($data);exit();
        $prefix = $data['prefix'];
        $number = $data['number'];

        $price = maite::where('order_prefix', $prefix)
                         ->where('order_id', $number)
                         ->get();

        $detailmaite = detailprice::where('order_prefix', $prefix)
                         ->where('order_id', $number)
                         ->get();

        $dataArray = array($price,$detailmaite);                 
        return $dataArray;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, maite $price)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        $data = $request->json()->all();
        //var_dump($data);exit();
        $prefix = $data['prefix'];
        $number = $data['number'];
        
        $proximoConsecutivo = price::obtenerConsecutivo(['order_prefix' => $data['prefix']]);

         $proximoConsecutivo= $proximoConsecutivo-1;

         if($proximoConsecutivo == $number){
            price::where('order_prefix', $prefix)->where('order_id', $number)->delete();

            detailprice::where('order_prefix', $prefix)->where('order_id', $number)->delete();

            return response()->json(['message' => 'Dato borrado correctamente']);
        }else{
            return response()->json(['message' => 'No es la ultima factura no se puede eliminar']);
        }

        
    }

/*    public function maite() {
        $price=maite::all();
        return response()->json([
            "factura_orden"=>$price
        ], Response::HTTP_OK);

        return response()->json([
            "message"=>"Ok",
            "userData"=>auth()->user()
        ], Response::HTTP_OK);
      
    }
*/  
}

