<?php

namespace App\Http\Controllers;

use App\Models\detailcreditnote;
use Illuminate\Http\Request;

class DetailcreditnoteController extends Controller
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
                $detailcreditnote = new detailcreditnote();
            
                $detailcreditnote->order_prefix = $item['prefijo'];
                $detailcreditnote->order_id = $item['factura'];
                $detailcreditnote->item_code = $item['codprod'];
                $detailcreditnote->reference = $item['reference'];
                $detailcreditnote->order_item_price = $item['unitPrice'];
                $detailcreditnote->order_item_desc = $item['percentage'];
                $detailcreditnote->order_item_iva = $item['tax'];
                $detailcreditnote->item_name = $item['item'];
                $detailcreditnote->descripcion = $item['description'];
                $detailcreditnote->order_item_quantity = $item['quantity'];
                $detailcreditnote->order_item_final_amount = $item['total'];
                $detailcreditnote->order_resolution = '';   

                $detailcreditnote->save();
            
        }
        return response()->json(['message' => 'Datos insertados correctamente']);
    
    }

    /**
     * Display the specified resource.
     */
    public function show(detailcreditnote $detailcreditnote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, detailcreditnote $detailcreditnote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(detailcreditnote $detailcreditnote)
    {
        //
    }
}
