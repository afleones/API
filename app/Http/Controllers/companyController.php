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
        $company = company::selectRaw("id,
        nitCode, 
        businessName,
        address,
        telephoneType,
        telephone,
        email,
        responsible,
        userId,
        created_at, 
        updated_at")->get();
        return $company;
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
        $company->nitCode = $data['nitCode'];
        $company->businessName = $data['businessName'];
        $company->address = $data['address'];
        $company->telephoneType = $data['telephoneType'];
        $company->telephone = $data['telephone'];
        $company->email = $data['email'];
        $company->responsible = $data['responsible'];
        $company->userId = $data['userId'];

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->json()->all();

        $id = $data['id'];
        $company->nitCode = $data['nitCode'];
        $company->businessName = $data['businessName'];
        $company->address = $data['address'];
        $company->telephoneType = $data['telephoneType'];
        $company->telephone = $data['telephone'];
        $company->email = $data['email'];
        $company->responsible = $data['responsible'];
        $company->userId = $data['userId'];
        $company->personaId = $data['personaId'];
        $company->viviendaId = $data['viviendaId'];

        $table = weight::where('id', $id)->firstOrFail();

        $table->nitCode = $data['nitCode'];
        $table->businessName = $data['businessName'];
        $table->address = $data['address'];
        $table->telephoneType = $data['telephoneType'];
        $table->telephone = $data['telephone'];
        $table->email = $data['email'];
        $table->responsible = $data['responsible'];
        $table->userId = $data['userId'];
        $table->save();

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
