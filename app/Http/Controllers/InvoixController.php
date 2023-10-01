<?php

namespace App\Http\Controllers;

use App\Models\maite;

use App\Models\detailmaite;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class maiteController extends Controller
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

        $proximoConsecutivo = maite::obtenerConsecutivo(['order_prefix' => $data['prefijo']]);


        // Creamos un nuevo objeto del modelo
        $maite = new maite();

        // Asignamos los datos a las propiedades del objeto
        $maite->order_prefix = $data['prefijo'];
        $maite->order_id = $proximoConsecutivo ;
        $maite->order_resolution = $data['resolution'];;
        $maite->user_id = $data['company_id'];//auth()->user()->id;
        $maite->order_receiver_name = $data['numberId'].'-'.$data['dv'].' -- '.$data['nombreTercero'];
        $maite->order_receiver_address = $data['order_receiver_address'];
        $maite->order_receiver_nit = $data['numberId'].'-'.$data['dv'];
        $maite->order_receiver_phone = $data['telefono'];
        $maite->order_date = $data['fecha'];
        $maite->payment_methods = $data['paymentOption'];
        $maite->payment_forms = $data['paymentMethod'];
        $maite->plazoPago = $data['plazoPago'];
        $maite->vencimiento = $data['vencimiento'];

        $maite->order_subtotal_before_tax  = $data['order_subtotal_before_tax'];
        $maite->order_total_desc  = $data['order_total_desc'];
        $maite->order_total_before_tax  = $data['order_total_before_tax'];
        $maite->order_total_tax = $data['order_total_tax'];
        $maite->order_tax_per = 0;
        $maite->order_total_after_tax = $data['order_total_after_tax'];
        $maite->order_amount_paid = $data['order_total_after_tax'];
        $maite->order_total_amount_due = 0;
        $maite->note = $data['observation'];
        $maite->cufe = 0;
        $maite->status = 0;



        // Guardamos el objeto en la base de datos
        $maite->save();
        return response()->json(['message' => 'Datos insertados correctamente',
                                 'prefijo' =>  $data['prefijo'],
                                 'consecutivo' => $proximoConsecutivo  
                                ]);
    }


    

    /**
     * Display the specified resource.
     */
    public function show(maite $maite)
    {
        //$maite=maite::all();
        $maite = maite::selectRaw("CONCAT(order_prefix, '', order_id)  AS Number,
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
        return $maite;
    }

    public function getinvoice(Request $request, maite $maite)
    {
        
        $data = $request->json()->all();
        //var_dump($data);exit();
        $prefix = $data['prefix'];
        $number = $data['number'];

        $maite = maite::where('order_prefix', $prefix)
                         ->where('order_id', $number)
                         ->get();

        $detailmaite = detailmaite::where('order_prefix', $prefix)
                         ->where('order_id', $number)
                         ->get();

        $dataArray = array($maite,$detailmaite);                 
        return $dataArray;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, maite $maite)
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
        
        $proximoConsecutivo = maite::obtenerConsecutivo(['order_prefix' => $data['prefix']]);

         $proximoConsecutivo= $proximoConsecutivo-1;

         if($proximoConsecutivo == $number){
            maite::where('order_prefix', $prefix)->where('order_id', $number)->delete();

            detailmaite::where('order_prefix', $prefix)->where('order_id', $number)->delete();

            return response()->json(['message' => 'Dato borrado correctamente']);
        }else{
            return response()->json(['message' => 'No es la ultima factura no se puede eliminar']);
        }

        
    }

/*    public function maite() {
        $maite=maite::all();
        return response()->json([
            "factura_orden"=>$maite
        ], Response::HTTP_OK);

        return response()->json([
            "message"=>"Ok",
            "userData"=>auth()->user()
        ], Response::HTTP_OK);
      
    }
*/  
}

