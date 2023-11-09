<?php

namespace App\Http\controllers\Documents;

use App\Http\Controllers\Controller;
use App\Models\Documents\earlychildhood;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

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
        headCircunference,
        gillPerimeter,
        perimeterWaist,
        perimeterHip,
        systolicPressure,
        diastolicPressure,
        antecedentPrematurity,
        congenitalAnomaly,
        consumptionSubstances,
        breastfeeding,
        chronicCondition,
        disability,
        promotionHealth,
        completeVaccination,
        deworming,
        oralHygiene,
        childDevelopment,
        signSera,
        ancestralMedicine,
        signSera2,
        victimization,
        malnutrition,
        overweightObesity,
        dangerDeath,
        nutritionalProblems,
        dresserChronic,
        tripZonesEndemic,
        userId,
        personaId,
        viviendaId,
        created_at
        updated_at")->get();
        return $earlychildhood;

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // $validatedData = $request->validate($rules);
    
        // Creamos un nuevo objeto del modelo
        $earlychildhood = new earlychildhood();
        $earlychildhood->weight = $data['weight'];
        $earlychildhood->size = $data['size'];
        $earlychildhood->headCircunference = $data['headCircunference'];
        $earlychildhood->gillPerimeter = $data['gillPerimeter'];
        $earlychildhood->perimeterWaist = $data['perimeterWaist'];
        $earlychildhood->perimeterHip = $data['perimeterHip'];
        $earlychildhood->systolicPressure = $data['systolicPressure'];
        $earlychildhood->diastolicPressure = $data['diastolicPressure'];
        $earlychildhood->antecedentPrematurity = $data['antecedentPrematurity'];
        $earlychildhood->congenitalAnomaly = $data['congenitalAnomaly'];
        $earlychildhood->consumptionSubstances = $data['consumptionSubstances'];
        $earlychildhood->breastfeeding = $data['breastfeeding'];
        $earlychildhood->chronicCondition = $data['chronicCondition'];
        $earlychildhood->disability = $data['disability'];
        $earlychildhood->promotionHealth = $data['promotionHealth'];
        $earlychildhood->completeVaccination = $data['completeVaccination'];
        $earlychildhood->deworming = $data['deworming'];
        $earlychildhood->oralHygiene = $data['oralHygiene'];
        $earlychildhood->childDevelopment = $data['childDevelopment'];
        $earlychildhood->signSera = $data['signSera'];
        $earlychildhood->ancestralMedicine = $data['ancestralMedicine'];
        $earlychildhood->signSera2 = $data['signSera2'];
        $earlychildhood->victimization = $data['victimization'];
        $earlychildhood->malnutrition = $data['malnutrition'];
        $earlychildhood->overweightObesity = $data['overweightObesity'];
        $earlychildhood->dangerDeath = $data['dangerDeath'];
        $earlychildhood->nutritionalProblems = $data['nutritionalProblems'];
        $earlychildhood->dresserChronic = $data['dresserChronic'];
        $earlychildhood->tripZonesEndemic = $data['tripZonesEndemic'];
        $earlychildhood->userId = $data['userId'];
        $earlychildhood->personaId = $data['personaId'];
        //Hacer el campo "viviendaId" nullable
        $earlychildhood->viviendaId = $data['viviendaId'] ?? 0;
                
        //Guardamos el objeto en la base de datos
        $earlychildhood->save();
    
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'Datos insertados correctamente']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,earlychildhood $earlychildhood )
    {
        $data = $request->all(); 
        $userId = $data['userId'];

        $earlychildhood = earlychildhood::where('userId', $userId)->where(function($query) use ($data) {  
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

        $dataArray = $earlychildhood;             
        return $dataArray;
    }
   /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $userId, $personaId, $viviendaId)
    {
        $data = $request->all();
    
        // Encuentra el registro que deseas actualizar basado en los criterios de consulta
        $earlychildhood = earlyearlychildhood::where('userId', $userId)
            ->where('personaId', $personaId)
            ->where('viviendaId', $viviendaId)
            ->first();
    
        // Verifica si se encontró el registro
        if (!$earlychildhood) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        
        $earlychildhood->weight = $data['weight'];
        $earlychildhood->size = $data['size'];
        $earlychildhood->headCircunference = $data['headCircunference'];
        $earlychildhood->gillPerimeter = $data['gillPerimeter'];
        $earlychildhood->perimeterWaist = $data['perimeterWaist'];
        $earlychildhood->perimeterHip = $data['perimeterHip'];
        $earlychildhood->systolicPressure = $data['systolicPressure'];
        $earlychildhood->diastolicPressure = $data['diastolicPressure'];
        $earlychildhood->antecedentPrematurity = $data['antecedentPrematurity'];
        $earlychildhood->congenitalAnomaly = $data['congenitalAnomaly'];
        $earlychildhood->consumptionSubstances = $data['consumptionSubstances'];
        $earlychildhood->breastfeeding = $data['breastfeeding'];
        $earlychildhood->chronicCondition = $data['chronicCondition'];
        $earlychildhood->disability = $data['disability'];
        $earlychildhood->promotionHealth = $data['promotionHealth'];
        $earlychildhood->completeVaccination = $data['completeVaccination'];
        $earlychildhood->deworming = $data['deworming'];
        $earlychildhood->oralHygiene = $data['oralHygiene'];
        $earlychildhood->childDevelopment = $data['childDevelopment'];
        $earlychildhood->signSera = $data['signSera'];
        $earlychildhood->ancestralMedicine = $data['ancestralMedicine'];
        $earlychildhood->signSera2 = $data['signSera2'];
        $earlychildhood->victimization = $data['victimization'];
        $earlychildhood->malnutrition = $data['malnutrition'];
        $earlychildhood->overweightObesity = $data['overweightObesity'];
        $earlychildhood->dangerDeath = $data['dangerDeath'];
        $earlychildhood->nutritionalProblems = $data['nutritionalProblems'];
        $earlychildhood->dresserChronic = $data['dresserChronic'];
        $earlychildhood->tripZonesEndemic = $data['tripZonesEndemic'];
        $earlychildhood->userId = $data['userId'];
        $earlychildhood->personaId = $data['personaId'];
        $earlychildhood->viviendaId = $data['viviendaId'];

        // Guarda los cambios en la base de datos
        $earlychildhood->save();
    
        return response()->json(['message' => 'Registro actualizado con éxito']);

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $data = $request->json()->all();
        //var_dump($data);exit();
        $id = $data['personid'];
        earlychildhood::where('', $id)->where('personid', $id)->delete();   
        return response()->json(['message' => 'Dato borrado correctamente']);

    }
}
