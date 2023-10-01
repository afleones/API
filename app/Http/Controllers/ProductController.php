<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
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

        
        // Creamos un nuevo objeto del modelo
        $product = new product();

        // Asignamos los datos a las propiedades del objeto
        $product->tipo = $data['tipo'];
        $product->referencia = '';
        $product->nombre = $data['nombreItem'];
        $product->bodega = $data['bodega'];
        $product->cantidad = $data['cantidad'];
        $product->costoInicial = $data['costoInicial'];
        $product->impuesto = $data['impuesto'];
        $product->precio = $data['precio'];
        $product->totalItem = $data['totalItem'];
        $product->unidadDeMedida =  $data['unidadDeMedida'];
        
        // Guardamos el objeto en la base de datos
        $product->save();
    
    
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'Datos insertados correctamente']);
    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        $product = product::selectRaw("nombre AS nombreItem,
                                        tipo ,
                                        bodega,
                                        cantidad,
                                        costoInicial,
                                        impuesto, 
                                        precio,
                                        totalItem,
                                        unidadDeMedida
                                     ")->get();
        return $product;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product)
    {
        //
    }
}
