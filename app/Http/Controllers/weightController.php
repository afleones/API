<?php

namespace App\Http\Controllers;

use App\Models\weight;
use Illuminate\Http\Request;

class weightController extends Controller
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
        $data = $request->all();

        
        // Creamos un nuevo objeto del modelo
        $weight = new weight();

        $weight->size = $data['size'];

        // Guardamos el objeto en la base de datos
        $weight->save();
    
    
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'Datos insertados correctamente']);

    }

    /**
     * Display the specified resource.
     */
    public function show(weight $weight)
    {
        $weight = weight::selectRaw("id,
        size,
        headcircunference,
        gillperimeter,
        perimeterwaist,
        perimeterHip,
        bloodpressure,
        created_at,
        updated_at,
        ")->get();
        return $weight;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->json()->all();

        $id = $data['id'];
        
        $size = $data['size'];
        
        $tabla = weight::where('id', $id)->firstOrFail();

        $tabla->size = $size;
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
        weight::where('id', $id)->where('id', $id)->delete();
    
        return response()->json(['message' => 'Dato borrado correctamente']);

    }
}
