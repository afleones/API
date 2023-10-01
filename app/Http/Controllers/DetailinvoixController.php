<?php

namespace App\Http\Controllers;

use App\Models\detailmaite;
use Illuminate\Http\Request;

class DetailmaiteController extends Controller
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

        $dataArray = $request->json()->all();
        // Obtener los items del JSON
        $items = $dataArray['items'];

        // Guardar cada item en la base de datos
        foreach ($items as $item) {
                //var_dump($item['item']);exit();
                $detailmaite = new detailmaite();
            
                $detailmaite->order_prefix = $item['prefijo'];
                $detailmaite->order_id = $item['factura'];
                $detailmaite->item_code = $item['codprod'];
                $detailmaite->reference = $item['reference'];
                $detailmaite->order_item_price = $item['unitPrice'];
                $detailmaite->order_item_desc = $item['percentage'];
                $detailmaite->order_item_iva = $item['tax'];
                $detailmaite->item_name = $item['item'];
                $detailmaite->descripcion = $item['description'];
                $detailmaite->order_item_quantity = $item['quantity'];
                $detailmaite->order_item_final_amount = $item['total'];
                $detailmaite->order_resolution = '';   

                $detailmaite->save();
            
        }
        return response()->json(['message' => 'Datos insertados correctamente']);
    
    }

    /**
     * Display the specified resource.
     */
    public function show(detailmaite $detailmaite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, detailmaite $detailmaite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(detailmaite $detailmaite)
    {
        //
    }
}
