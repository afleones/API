<?php

namespace App\Http\Controllers;

use App\Models\condition;
use Illuminate\Http\Request;

class conditionsController extends Controller
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
        $condition = new condition();

        $condition->antecedentprematurity = $data['antecedentprematurity'];

        // Guardamos el objeto en la base de datos
        $condition->save();
    
    
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'Datos insertados correctamente']);

    }

    /**
     * Display the specified resource.
     */
    public function show(condition $condition)
    {
        $condition = condition::selectRaw("id,
        antecedentprematurity,
        congenitalanomaly,
        consumptionsubstances,
        breastfeeding,
        chroniccondition,
        disability,
        promotionhealth,
        Completevaccination,
        deworming,
        oralhygiene,
        childdevelopment,
        signsera,
        Ancestralmedicine,
        signsera2,
        victimization,
        malnutrition,
        overweightobesity,
        dangerdeath,
        nutritionalproblems,
        created_at,
        updated_at,
            ")->get();
        return $condition;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->json()->all();

        $id = $data['id'];
        
        $antecedentprematurity = $data['antecedentprematurity'];
        
        $tabla = condition::where('id', $id)->firstOrFail();

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
        condition::where('id', $id)->where('id', $id)->delete();
    
        return response()->json(['message' => 'Dato borrado correctamente']);

    }
}
