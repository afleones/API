<?php

namespace App\Http\Controllers;

use App\Models\communicablediseases;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $data = $request->all();
 
        // Creamos un nuevo objeto del modelo
        $communicablediseases = new communicablediseases();

        $communicablediseases->fullName = $data['fullName'];
        $communicablediseases->sex = $data['sex'];
        if (isset($data['otherSex'])) {
            $communicablediseases->otherSex = $data['otherSex'];
        } else {
            $communicablediseases->otherSex = null;
        }
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
        //Hacer el campo "viviendaId" nullable
        $adolescence->viviendaId = $data['viviendaId'] ?? null; // Usamos operador null coalesce
        
        // Guardamos el objeto en la base de datos
        $communicablediseases->save();
    
    
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'Datos insertados correctamente']);
    }

    /**
     * Display the specified resource.
     */

     public function show(Request $request,communicablediseases $communicablediseases )
     {
         $data = $request->all(); 
         $userId = $data['userId'];
 
         $communicablediseases = communicablediseases::where('userId', $userId)->where(function($query) use ($data) {  
             if (isset($data['id'])) {
                 $query->Where('id', $data['id']);
             }
             if (isset($data['personaId'])) {
                 $query->Where('personaId', $data['personaId']);
             }
             if (isset($data['viviendaId'])) {
                 $query->Where('viviendaId', $data['viviendaId']);
             }
         })->get();
 
         $dataArray = $communicablediseases;             
         return $dataArray;
     }
                   
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $userId, $personaId, $viviendaId)
    {
        $data = $request->all();
    
        // Encuentra el registro que deseas actualizar basado en los criterios de consulta
        $communicablediseases = Communicablediseases::where('userId', $userId)
            ->where('personaId', $personaId)
            ->where('viviendaId', $viviendaId)
            ->first();
    
        // Verifica si se encontró el registro
        if (!$communicablediseases) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
    
        // Actualiza los campos con los valores proporcionados en los datos
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
    
        // Guarda los cambios en la base de datos
        $communicablediseases->save();
    
        return response()->json(['message' => 'Registro actualizado con éxito']);
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
