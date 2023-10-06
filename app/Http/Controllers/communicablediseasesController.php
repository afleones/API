<?php

namespace App\Http\Controllers;

use App\Models\communicablediseases;
use Illuminate\Http\Request;

class communicablediseasesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $communicablediseases = communicablediseases::selectRaw("
        id,
        fullName, 
        sex,
        otherSex, 
        age, 
        relationship, 
        occupation, 
        incomeContribution, 
        educationLevel, 
        affiliationType, 
        specialCareGroup, 
        speaksCreole, 
        covidVaccine, 
        vaccineDoses, 
        substanceUse, 
        substanceType, 
        userId, 
        personaId,
        viviendaId,
        created_at, 
        updated_at")->get();
        return $communicablediseases;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();

        
        // Creamos un nuevo objeto del modelo
        $communicablediseases = new communicablediseases();

        $communicablediseases->fullName = $data['fullName'];
        $communicablediseases->gender = $data['gender'];
        $communicablediseases->age = $data['age'];
        $communicablediseases->relationship = $data['relationship'];
        $communicablediseases->occupation = $data['occupation'];
        $communicablediseases->incomeContribution = $data['incomeContribution'];
        $communicablediseases->educationLevel = $data['educationLevel'];
        $communicablediseases->affiliationType = $data['affiliationType'];
        $communicablediseases->specialCareGroup = $data['specialCareGroup'];
        $communicablediseases->speaksCreole = $data['speaksCreole'];
        $communicablediseases->covidVaccine = $data['covidVaccine'];
        $communicablediseases->vaccineDoses = $data['vaccineDoses'];
        $communicablediseases->substanceUse = $data['substanceUse'];
        $communicablediseases->substanceType = $data['substanceType'];
        $communicablediseases->userId = $data['userId'];
        $communicablediseases->userId = $data['personaId'];
        $communicablediseases->userId = $data['viviendaId'];
        
        // Guardamos el objeto en la base de datos
        $communicablediseases->save();
    
    
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'Datos insertados correctamente']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, communicablediseases $communicablediseases)
    {
        //$data = $request->json()->all();
        $data = $request->all(); 
        //var_dump($data);exit();
        $userid = $data['userId'];
        //$fecha1 = $data['fecha1'];
        //$fecha2 = $data['fecha2'];
        

        $communicablediseases = communicablediseases::where('userId', $userid)
                         ->where(function($query) use ( $data) {
                            if (isset($data['id'])) {
                                $query->orWhere('id', $data['id']);
                            }
                            if (isset($data['personaId'])) {
                                $query->orWhere('personaId', $data['personaId']);
                            }
                            //$query->whereBetween(\DB::raw('DATE(created_at)'), [$fecha1, $fecha2]);
                         })
                         ->get();

       

        //$dataArray = array($communicablediseases);         
        $dataArray = ($communicablediseases);             
        return $dataArray;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->json()->all();

        $id = $data['id'];
        $communicablediseases->fullName = $data['fullName'];
        $communicablediseases->gender = $data['gender'];
        $communicablediseases->age = $data['age'];
        $communicablediseases->relationship = $data['relationship'];
        $communicablediseases->occupation = $data['occupation'];
        $communicablediseases->incomeContribution = $data['incomeContribution'];
        $communicablediseases->educationLevel = $data['educationLevel'];
        $communicablediseases->affiliationType = $data['affiliationType'];
        $communicablediseases->specialCareGroup = $data['specialCareGroup'];
        $communicablediseases->speaksCreole = $data['speaksCreole'];
        $communicablediseases->covidVaccine = $data['covidVaccine'];
        $communicablediseases->vaccineDoses = $data['vaccineDoses'];
        $communicablediseases->substanceUse = $data['substanceUse'];
        $communicablediseases->substanceType = $data['substanceType'];
        $communicablediseases->userId = $data['userId'];
        $communicablediseases->userId = $data['personaId'];
        $communicablediseases->userId = $data['viviendaId'];
    
        $tabla = communicablediseases::where('id', $id)->firstOrFail();

        $tabla->fullName = $data['fullName'];
        $tabla->gender = $data['gender'];
        $tabla->age = $data['age'];
        $tabla->relationship = $data['relationship'];
        $tabla->occupation = $data['occupation'];
        $tabla->incomeContribution = $data['incomeContribution'];
        $tabla->educationLevel = $data['educationLevel'];
        $tabla->affiliationType = $data['affiliationType'];
        $tabla->specialCareGroup = $data['specialCareGroup'];
        $tabla->speaksCreole = $data['speaksCreole'];
        $tabla->covidVaccine = $data['covidVaccine'];
        $tabla->vaccineDoses = $data['vaccineDoses'];
        $tabla->substanceUse = $data['substanceUse'];
        $tabla->substanceType = $data['substanceType'];
        $tabla->userId = $data['userId'];
        $tabla->userId = $data['personaId'];
        $tabla->userId = $data['viviendaId'];
        
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
        communicablediseases::where('id', $id)->where('id', $id)->delete();
    
        return response()->json(['message' => 'Dato borrado correctamente']);
    }
}
