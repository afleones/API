<?php

namespace App\Http\Controllers;

use App\Models\company;
use Illuminate\Http\Request;

class companyController extends Controller
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
        $company = new company();

        // Asignamos los datos a las propiedades del objeto
        $company->nitcode= $data['nitcode'];

        // Guardamos el objeto en la base de datos
        $company->save();
    
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'Correctly Registered Company']);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $company = company::selectRaw("id,
        nitcode,
        businessname,
        address,
        telephonetype,
        telephone,
        email,
        responsible,  
        created_at,
        updated_at
        ")->get();
        return $company;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->json()->all();

        $id = $data['id'];
        
        $nitcode = $data['nitcode'];
        
        $tabla = weight::where('id', $id)
                   
                   ->firstOrFail();

        $tabla->nitcode = $nitcode;
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
