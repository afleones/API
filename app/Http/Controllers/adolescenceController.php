<?php

namespace App\Http\Controllers;

use App\Models\adolescence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adolescenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adolescence = adolescence::selectRaw("id,
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
        return $adolescence;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        // Creamos un nuevo objeto del modelo
        $adolescence = new adolescence();
        $adolescence->weight = $data['weight'];
        $adolescence->size = $data['size'];
        $adolescence->imc = $data['imc'];
        $adolescence->systolicPressure = $data['systolicPressure'];
        $adolescence->diastolicPressure = $data['diastolicPressure'];
        $adolescence->medicalHistory = $data['medicalHistory'];
        $adolescence->completeVaccination = $data['completeVaccination'];
        $adolescence->chronicConditions = $data['chronicConditions'];
        $adolescence->disability = $data['disability'];
        $adolescence->promotionHealth = $data['promotionHealth'];
        $adolescence->oralHygiene = $data['oralHygiene'];
        $adolescence->referralOptometry = $data['referralOptometry'];
        $adolescence->consumptionTobacco = $data['consumptionTobacco'];
        $adolescence->consumptionAlcohol = $data['consumptionAlcohol'];
        $adolescence->psychoactiveSubstances = $data['psychoactiveSubstances'];
        $adolescence->developmentPubertal = $data['developmentPubertal'];
        $adolescence->homeLifeSexual = $data['homeLifeSexual'];
        $adolescence->its = $data['its'];
        $adolescence->chronicCough = $data['chronicCough'];
        $adolescence->identitySexual = $data['identitySexual'];
        $adolescence->psychosocialDevelopment = $data['psychosocialDevelopment'];
        $adolescence->suicidalBehavior = $data['suicidalBehavior'];
        $adolescence->ethnicGroups = $data['ethnicGroups'];
        $adolescence->nutritionalProblems = $data['nutritionalProblems'];
        $adolescence->malnutrition = $data['malnutrition'];
        $adolescence->overweightObesity = $data['overweightObesity'];
        $adolescence->signsDanger = $data['signsDanger'];
        $adolescence->rapePhysicalPsychological = $data['rapePhysicalPsychological'];
        $adolescence->rapeSexual = $data['rapeSexual'];
        $adolescence->unschooling = $data['unschooling'];
        $adolescence->schoolPerformance = $data['schoolPerformance'];
        $adolescence->tripZonesEndemic = $data['tripZonesEndemic'];
        $adolescence->userId = $data['userId'];
        $adolescence->personaId = $data['personaId'];
        $adolescence->viviendaId = $data['viviendaId'];
        // Guardamos el objeto en la base de datos
        $adolescence->save();

        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'Datos insertados correctamente']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,adolescence $adolescence )
    {
        $data = $request->all(); 
        $userId = $data['userId'];

        $adolescence = adolescence::where('userId', $userId)->where(function($query) use ($data) {  
            if (isset($data['id'])) {
                $query->Where('id', $data['id']);
            }
            if (isset($data['personaId'])) {
                $query->Where('personaId', $data['personaId']);
            }
            if (isset($data['viviendaId'])) {
                $query->Where('viviendaId', $data['viviendaId']);
            }
                            
            //$query->whereBetween(\DB::raw('DATE(created_at)'), [$fecha1, $fecha2]);
            })
            ->get();

       

        //$dataArray = array($adolescence);     
        $dataArray = $adolescence;             
        return $dataArray;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $userId, $personaId, $viviendaId)
    {
        $data = $request->all();
    
        // Encuentra el registro que deseas actualizar basado en los criterios de consulta
        $adolescence = adolescence::where('userId', $userId)
            ->where('personaId', $personaId)
            ->where('viviendaId', $viviendaId)
            ->first();
    
        // Verifica si se encontró el registro
        if (!$adolescence) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
    
        // Actualiza los campos con los valores proporcionados en los datos
        $adolescence->weight = $data['weight'];
        $adolescence->size = $data['size'];
        $adolescence->imc = $data['imc'];
        $adolescence->systolicPressure = $data['systolicPressure'];
        $adolescence->diastolicPressure = $data['diastolicPressure'];
        $adolescence->medicalHistory = $data['medicalHistory'];
        $adolescence->completeVaccination = $data['completeVaccination'];
        $adolescence->chronicConditions = $data['chronicConditions'];
        $adolescence->disability = $data['disability'];
        $adolescence->promotionHealth = $data['promotionHealth'];
        $adolescence->oralHygiene = $data['oralHygiene'];
        $adolescence->referralOptometry = $data['referralOptometry'];
        $adolescence->consumptionTobacco = $data['consumptionTobacco'];
        $adolescence->consumptionAlcohol = $data['consumptionAlcohol'];
        $adolescence->psychoactiveSubstances = $data['psychoactiveSubstances'];
        $adolescence->developmentPubertal = $data['developmentPubertal'];
        $adolescence->homeLifeSexual = $data['homeLifeSexual'];
        $adolescence->its = $data['its'];
        $adolescence->chronicCough = $data['chronicCough'];
        $adolescence->identitySexual = $data['identitySexual'];
        $adolescence->psychosocialDevelopment = $data['psychosocialDevelopment'];
        $adolescence->suicidalBehavior = $data['suicidalBehavior'];
        $adolescence->ethnicGroups = $data['ethnicGroups'];
        $adolescence->nutritionalProblems = $data['nutritionalProblems'];
        $adolescence->malnutrition = $data['malnutrition'];
        $adolescence->overweightObesity = $data['overweightObesity'];
        $adolescence->signsDanger = $data['signsDanger'];
        $adolescence->rapePhysicalPsychological = $data['rapePhysicalPsychological'];
        $adolescence->rapeSexual = $data['rapeSexual'];
        $adolescence->unschooling = $data['unschooling'];
        $adolescence->schoolPerformance = $data['schoolPerformance'];
        $adolescence->tripZonesEndemic = $data['tripZonesEndemic'];
        $adolescence->userId = $data['userId'];
        $adolescence->personaId = $data['personaId'];
        $adolescence->viviendaId = $data['viviendaId'];
    
        // Guarda los cambios en la base de datos
        $adolescence->save();
    
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
        adolescence::where('id', $id)->where('id', $id)->delete();
    
        return response()->json(['message' => 'Dato borrado correctamente']);

    }
}
