<?php

namespace App\Http\Controllers;

use App\Models\adult;
use Illuminate\Http\Request;

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
        $adult->viviendaId = $data['viviendaId'];

                // Guardamos el objeto en la base de datos
        $adult->save();
    
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'Datos insertados correctamente']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, adult $adult)
    {
        $data = $request->all();
        $userid = $data['userId'];
        $viviendaid = $data['viviendaId'];
        $personaid = $data['personaId'];
        //$fecha1 = $data['fecha1'];
        //$fecha2 = $data['fecha2'];
        

        $adult = adult::where('userId', $userid)->where(function($query) use ($data) {  
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

       

        //$dataArray = array($adult);     
        $dataArray = $adult;             
        return $dataArray;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->json()->all();
        $id = $data['id'];
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
        $adult->userId = $data['userid'];
        $adult->viviendaId = $data['viviendaId'];        
        $tabla = adult::where('id', $id)->firstOrFail();
        $tabla->weight = $weight;
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
        adult::where('id', $id)->where('id', $id)->delete();
    
        return response()->json(['message' => 'Dato borrado correctamente']);

    }
}
