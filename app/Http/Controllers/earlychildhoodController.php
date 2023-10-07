<?php

namespace App\Http\Controllers;

use App\Models\earlychildhood;
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
        $earlychildhood->viviendaId = $data['viviendaId'];
                
        //Guardamos el objeto en la base de datos
        $earlychildhood->save();
    
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'Datos insertados correctamente']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        // Accede a los datos de la solicitud POST
        $data = $request->all();
    
        // Valida que los parámetros requeridos estén presentes en la solicitud
        if (
            isset($data['userId']) &&
            isset($data['personaId']) &&
            isset($data['viviendaId'])
        ) {
            // Realiza una consulta en la base de datos para encontrar una coincidencia
            $result = DB::table('maite000003.earlyChildHood')
                ->where([
                    ['userId', '=', $data['userId']],
                    ['personaId', '=', $data['personaId']],
                    ['viviendaId', '=', $data['viviendaId']]
                ]) ->first(); // Obtén la primera coincidencia
    
            if ($result) {
                // Envía la respuesta en un arreglo
                return response()->json(['data' => [$result]], 200);
            } else {
                // Si no se encuentra una coincidencia, devuelve una respuesta de error
                return response()->json(['message' => 'No se encontraron coincidencias'], 404);
            }
            } else {
                // Si falta alguno de los parámetros requeridos, devuelve una respuesta de error
                return response()->json(['message' => 'Parámetros faltantes'], 400);
            }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $earlychildhood->id = $data['id'];
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

        $tabla = earlyChildHood::where('id', $id)->firstOrFail();


        $tabla->weight = $data['weight'];
        $tabla->size = $data['size'];
        $tabla->headCircunference = $data['headCircunference'];
        $tabla->gillPerimeter = $data['gillPerimeter'];
        $tabla->perimeterWaist = $data['perimeterWaist'];
        $tabla->perimeterHip = $data['perimeterHip'];
        $tabla->systolicPressure = $data['systolicPressure'];
        $tabla->diastolicPressure = $data['diastolicPressure'];
        $tabla->antecedentPrematurity = $data['antecedentPrematurity'];
        $tabla->congenitalAnomaly = $data['congenitalAnomaly'];
        $tabla->consumptionSubstances = $data['consumptionSubstances'];
        $tabla->breastfeeding = $data['breastfeeding'];
        $tabla->chronicCondition = $data['chronicCondition'];
        $tabla->disability = $data['disability'];
        $tabla->promotionHealth = $data['promotionHealth'];
        $tabla->completeVaccination = $data['completeVaccination'];
        $tabla->deworming = $data['deworming'];
        $tabla->oralHygiene = $data['oralHygiene'];
        $tabla->childDevelopment = $data['childDevelopment'];
        $tabla->signSera = $data['signSera'];
        $tabla->ancestralMedicine = $data['ancestralMedicine'];
        $tabla->signSera2 = $data['signSera2'];
        $tabla->victimization = $data['victimization'];
        $tabla->malnutrition = $data['malnutrition'];
        $tabla->overweightObesity = $data['overweightObesity'];
        $tabla->dangerDeath = $data['dangerDeath'];
        $tabla->nutritionalProblems = $data['nutritionalProblems'];
        $tabla->dresserChronic = $data['dresserChronic'];
        $tabla->tripZonesEndemic = $data['tripZonesEndemic'];
        $tabla->userId = $data['userId'];
        $tabla->personaId = $data['personaId'];
        $tabla->viviendaId = $data['viviendaId'];

        $table->save();

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
