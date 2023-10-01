<?php

namespace App\Http\Controllers;

use App\Models\detailprice;
use Illuminate\Http\Request;

class DetailpriceController extends Controller
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
                $detailprice = new detailprice();
            
                $detailprice->order_prefix = $item['prefijo'];
                $detailprice->order_id = $item['factura'];
                $detailprice->item_code = $item['codprod']; 
                $detailprice->reference = $item['reference'];
                $detailprice->order_item_price = $item['unitPrice'];
                $detailprice->order_item_desc = $item['percentage'];
                $detailprice->order_item_iva = $item['tax'];
                $detailprice->item_name = $item['item'];
                $detailprice->descripcion = $item['description'];
                $detailprice->order_item_quantity = $item['quantity'];
                $detailprice->order_item_final_amount = $item['total'];
                $detailprice->order_resolution = '';   

                $detailprice->save();
            
        }
        return response()->json(['message' => 'Datos insertados correctamente']);
    
    }

    /**
     * Display the specified resource.
     */
    public function show(detailmaite $detailprice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, detailmaite $detailprice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(detailmaite $detailprice)
    {
        //
    }
}
