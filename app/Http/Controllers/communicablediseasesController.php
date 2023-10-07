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
        $communicablediseases->sex = $data['sex'];
        $communicablediseases->otherSex = isset($data['otherSex']) ? $data['otherSex'] : null;
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
        $communicablediseases->personaId = $data['personaId'];
        $communicablediseases->viviendaId = $data['viviendaId'];
        
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
        $data = $request->all();
        $userid = $data['userId'];
        $viviendaid = $data['viviendaId'];
        $personaid = $data['personaId'];
        //$fecha1 = $data['fecha1'];
        //$fecha2 = $data['fecha2'];
        

        $communicablediseases = communicablediseases::where('userId', $userid)->where(function($query) use ($data) {  
            if (isset($data['id'])) {
            $query->Where('id', $data['id']);
            }
            if (isset($data['viviendaId'])) {
                $query->Where('viviendaId', $data['viviendaId']);
            }
            if (isset($data['personaId'])) {
                $query->Where('personaId', $data['personaId']);
            }
            //$query->whereBetween(\DB::raw('DATE(created_at)'), [$fecha1, $fecha2]);
             })->get();

       

        //$dataArray = array($communicablediseases);     
        $dataArray = $communicablediseases;             
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
        $communicablediseases->sex = $data['sex'];
        $communicablediseases->otherSex = isset($data['otherSex']) ? $data['otherSex'] : null;
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
        $communicablediseases->personaId = $data['personaId'];
        $communicablediseases->viviendaId = $data['viviendaId'];
        $table = communicablediseases::where('id', $id)->firstOrFail();

        $table->fullName = $data['fullName'];
        $table->sex = $data['sex'];
        $table->otherSex = isset($data['otherSex']) ? $data['otherSex'] : null;
        $table->age = $data['age'];
        $table->relationship = $data['relationship'];
        $table->occupation = $data['occupation'];
        $table->incomeContribution = $data['incomeContribution'];
        $table->educationLevel = $data['educationLevel'];
        $table->affiliationType = $data['affiliationType'];
        $table->specialCareGroup = $data['specialCareGroup'];
        $table->speaksCreole = $data['speaksCreole'];
        $table->covidVaccine = $data['covidVaccine'];
        $table->vaccineDoses = $data['vaccineDoses'];
        $table->substanceUse = $data['substanceUse'];
        $table->substanceType = $data['substanceType'];
        $table->userId = $data['userId'];
        $table->personaId = $data['personaId'];
        $table->viviendaId = $data['viviendaId'];
        
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
        communicablediseases::where('id', $id)->where('id', $id)->delete();
    
        return response()->json(['message' => 'Dato borrado correctamente']);
    }
}
