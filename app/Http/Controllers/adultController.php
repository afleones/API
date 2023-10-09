<?php

namespace App\Http\Controllers;

use App\Models\adult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adult = adult::selectRaw("id,
        weight,
        size,
        imc,
        systolicPressure,
        diastolicPressure,
        medicalHistory,
        completeVaccination,
        chronicConditions,
        disability,
        promotionHealth,
        oralHygiene,
        referralOptometry,
        consumptionTobacco,
        consumptionAlcohol,
        psychoactiveSubstances,
        developmentPubertal,
        homeLifeSexual,
        its,
        chronicCough,
        identitySexual,
        psychosocialDevelopment,
        suicidalBehavior,
        ethnicGroups,
        nutritionalProblems,
        malnutrition,
        overweightObesity,
        signsDanger,
        rapePhysicalPsychological,
        rapeSexual,
        unschooling,
        schoolPerformance,
        tripZonesEndemic,
        userId,
        personaId,
        viviendaId,
        created_at,
		updated_at")->get();
        return $adult;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();

        // Creamos un nuevo objeto del modelo
        $adult = new adult();

        $adult->weight = $data['weight'];
        $adult->size = $data['size'];
        $adult->imc = $data['imc'];
        $adult->systolicPressure = $data['systolicPressure'];
        $adult->diastolicPressure = $data['diastolicPressure'];
        $adult->medicalHistory = $data['medicalHistory'];
        $adult->completeVaccination = $data['completeVaccination'];
        $adult->chronicConditions = $data['chronicConditions'];
        $adult->disability = $data['disability'];
        $adult->promotionHealth = $data['promotionHealth'];
        $adult->oralHygiene = $data['oralHygiene'];
        $adult->referralOptometry = $data['referralOptometry'];
        $adult->consumptionTobacco = $data['consumptionTobacco'];
        $adult->consumptionAlcohol = $data['consumptionAlcohol'];
        $adult->psychoactiveSubstances = $data['psychoactiveSubstances'];
        $adult->developmentPubertal = $data['developmentPubertal'];
        $adult->homeLifeSexual = $data['homeLifeSexual'];
        $adult->its = $data['its'];
        $adult->chronicCough = $data['chronicCough'];
        $adult->identitySexual = $data['identitySexual'];
        $adult->psychosocialDevelopment = $data['psychosocialDevelopment'];
        $adult->suicidalBehavior = $data['suicidalBehavior'];
        $adult->ethnicGroups = $data['ethnicGroups'];
        $adult->nutritionalProblems = $data['nutritionalProblems'];
        $adult->malnutrition = $data['malnutrition'];
        $adult->overweightObesity = $data['overweightObesity'];
        $adult->signsDanger = $data['signsDanger'];
        $adult->rapePhysicalPsychological = $data['rapePhysicalPsychological'];
        $adult->rapeSexual = $data['rapeSexual'];
        $adult->unschooling = $data['unschooling'];
        $adult->schoolPerformance = $data['schoolPerformance'];
        $adult->tripZonesEndemic = $data['tripZonesEndemic'];
        $adult->personaId = $data['personaId'];
        $adult->userId = $data['userId'];
        //Hacer el campo "viviendaId" nullable
        $adult->viviendaId = $data['viviendaId'] ?? null; // Usamos operador null coalesce

        // Guardamos el objeto en la base de datos
        $adult->save();
    
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'Datos insertados correctamente']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,adult $adult )
    {
        $data = $request->all(); 
        $userId = $data['userId'];

        $adult = adult::where('userId', $userId)->where(function($query) use ($data) {  
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

        $dataArray = $adult;             
        return $dataArray;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $userId, $personaId, $viviendaId)
    {
        $data = $request->all();
    
        // Encuentra el registro que deseas actualizar basado en los criterios de consulta
        $adult = adult::where('userId', $userId)
            ->where('personaId', $personaId)
            ->where('viviendaId', $viviendaId)
            ->first();
    
        // Verifica si se encontró el registro
        if (!$adult) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
    
        // Actualiza los campos con los valores proporcionados en los datos
        $adult->weight = $data['weight'];
        $adult->size = $data['size'];
        $adult->imc = $data['imc'];
        $adult->systolicPressure = $data['systolicPressure'];
        $adult->diastolicPressure = $data['diastolicPressure'];
        $adult->medicalHistory = $data['medicalHistory'];
        $adult->completeVaccination = $data['completeVaccination'];
        $adult->chronicConditions = $data['chronicConditions'];
        $adult->disability = $data['disability'];
        $adult->promotionHealth = $data['promotionHealth'];
        $adult->oralHygiene = $data['oralHygiene'];
        $adult->referralOptometry = $data['referralOptometry'];
        $adult->consumptionTobacco = $data['consumptionTobacco'];
        $adult->consumptionAlcohol = $data['consumptionAlcohol'];
        $adult->psychoactiveSubstances = $data['psychoactiveSubstances'];
        $adult->developmentPubertal = $data['developmentPubertal'];
        $adult->homeLifeSexual = $data['homeLifeSexual'];
        $adult->its = $data['its'];
        $adult->chronicCough = $data['chronicCough'];
        $adult->identitySexual = $data['identitySexual'];
        $adult->psychosocialDevelopment = $data['psychosocialDevelopment'];
        $adult->suicidalBehavior = $data['suicidalBehavior'];
        $adult->ethnicGroups = $data['ethnicGroups'];
        $adult->nutritionalProblems = $data['nutritionalProblems'];
        $adult->malnutrition = $data['malnutrition'];
        $adult->overweightObesity = $data['overweightObesity'];
        $adult->signsDanger = $data['signsDanger'];
        $adult->rapePhysicalPsychological = $data['rapePhysicalPsychological'];
        $adult->rapeSexual = $data['rapeSexual'];
        $adult->unschooling = $data['unschooling'];
        $adult->schoolPerformance = $data['schoolPerformance'];
        $adult->tripZonesEndemic = $data['tripZonesEndemic'];
        $adult->personaId = $data['personaId'];
        $adult->userId = $data['userId'];
        $adult->viviendaId = $data['viviendaId'];
    
        // Guarda los cambios en la base de datos
        $adult->save();
    
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
        adult::where('id', $id)->where('id', $id)->delete();
    
        return response()->json(['message' => 'Dato borrado correctamente']);

    }
}
