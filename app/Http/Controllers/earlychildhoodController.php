<?php

namespace App\Http\Controllers;

use App\Models\earlychildhood;
use Illuminate\Http\Request;

class earlychildhoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $earlychildhood = earlychildhood::selectRaw("id,
        weight,
        size,
        headcircunference,
        gillperimeter,
        perimeterwaist,
        perimeterHip,
        systolicPressure,
        diastolicPressure,
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
        dresserChronic,
        tripZonesEndemic,
        created_at,
        updated_at")->get();
        return $earlychildhood;

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        // Creamos un nuevo objeto del modelo
        $earlychildhood = new earlychildhood();
        $earlychildhood->weight = $data['weight'];
        $earlychildhood->size = $data['size'];
        $earlychildhood->headcircunference = $data['headcircunference'];
        $earlychildhood->gillperimeter = $data['gillperimeter'];
        $earlychildhood->perimeterwaist = $data['perimeterwaist'];
        $earlychildhood->perimeterHip = $data['siperimeterHipze'];
        $earlychildhood->systolicPressure = $data['systolicPressure'];
        $earlychildhood->diastolicPressure = $data['diastolicPressure'];
        $earlychildhood->antecedentprematurity = $data['antecedentprematurity'];
        $earlychildhood->congenitalanomaly = $data['congenitalanomaly'];
        $earlychildhood->consumptionsubstances = $data['consumptionsubstances'];
        $earlychildhood->breastfeeding = $data['breastfeeding'];
        $earlychildhood->chroniccondition = $data['chroniccondition'];
        $earlychildhood->disability = $data['disability'];
        $earlychildhood->promotionhealth = $data['promotionhealth'];
        $earlychildhood->Completevaccination = $data['Completevaccination'];
        $earlychildhood->deworming = $data['deworming'];
        $earlychildhood->oralhygiene = $data['oralhygiene'];
        $earlychildhood->childdevelopment = $data['childdevelopment'];
        $earlychildhood->signsera = $data['signsera'];
        $earlychildhood->Ancestralmedicine = $data['Ancestralmedicine'];
        $earlychildhood->signsera2 = $data['signsera2'];
        $earlychildhood->victimization = $data['victimization'];
        $earlychildhood->malnutrition = $data['malnutrition'];
        $earlychildhood->overweightobesity = $data['overweightobesity'];
        $earlychildhood->dangerdeath = $data['dangerdeath'];
        $earlychildhood->nutritionalproblems = $data['nutritionalproblems'];
        $earlychildhood->dresserChronic = $data['dresserChronic'];
        $earlychildhood->tripZonesEndemic = $data['tripZonesEndemic'];
        $earlychildhood->personaid = $data['personaid'];
        $earlychildhood->useriduserid = $data['userid'];
        // Guardamos el objeto en la base de datos
        $earlychildhood->save();
    
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'Datos insertados correctamente']);
    }

    /**
     * Display the specified resource.
     */
    public function show(earlychildhood $earlychildhood)
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
        $size = $data['size'];    
        $tabla = earlychildhood::where('id', $id)->firstOrFail();
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
        earlychildhood::where('id', $id)->where('id', $id)->delete();   
        return response()->json(['message' => 'Dato borrado correctamente']);

    }
}
