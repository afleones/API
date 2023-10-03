<?php

namespace App\Http\Controllers;

use App\Models\prueba;
use Illuminate\Http\Request;

class pruebaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       //
       $prueba = prueba::selectRaw("id,
       campo_de_prueba
       ")->get();
       return $prueba;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        // Creamos un nuevo objeto del modelo
        $prueba = new prueba();
        $prueba->campo_de_prueba = $data['campo_de_prueba'];
        // Guardamos el objeto en la base de datos
        $prueba->save();
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'Prueba Correcta']);
    }

    /**
     * Display the specified resource.
     */
    public function show(prueba $prueba)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->json()->all();

        $id = $data['id'];
        
        $campo_de_prueba = $data['campo_de_prueba'];
        $tabla = prueba::where('id', $id)
                   
                   ->firstOrFail();

        $tabla->campo_de_prueba = $campo_de_prueba;
        $tabla->save();

        // Puedes retornar una respuesta o redireccionar a otra página
        return response()->json(['message' => 'Datos Actualizado correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $data = $request->json()->all();
        //var_dump($data);exit();
        $id = $data['id'];
        prueba::where('id', $id)->where('id', $id)->delete();
    
        return response()->json(['message' => 'Dato borrado correctamente']);

    }
}
