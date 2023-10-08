<?php

namespace App\Http\Controllers;

use App\Models\old;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class oldController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $old = old::selectRaw("id,
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
        return $old;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();

        // Creamos un nuevo objeto del modelo
        $old = new old();

        $old->weight = $data['weight'];
        $old->size = $data['size'];
        $old->imc = $data['imc'];
        $old->systolicPressure = $data['systolicPressure'];
        $old->diastolicPressure = $data['diastolicPressure'];
        $old->medicalHistory = $data['medicalHistory'];
        $old->completeVaccination = $data['completeVaccination'];
        $old->chronicConditions = $data['chronicConditions'];
        $old->disability = $data['disability'];
        $old->promotionHealth = $data['promotionHealth'];
        $old->oralHygiene = $data['oralHygiene'];
        $old->referralOptometry = $data['referralOptometry'];
        $old->consumptionTobacco = $data['consumptionTobacco'];
        $old->consumptionAlcohol = $data['consumptionAlcohol'];
        $old->psychoactiveSubstances = $data['psychoactiveSubstances'];
        $old->developmentPubertal = $data['developmentPubertal'];
        $old->homeLifeSexual = $data['homeLifeSexual'];
        $old->its = $data['its'];
        $old->chronicCough = $data['chronicCough'];
        $old->identitySexual = $data['identitySexual'];
        $old->psychosocialDevelopment = $data['psychosocialDevelopment'];
        $old->suicidalBehavior = $data['suicidalBehavior'];
        $old->ethnicGroups = $data['ethnicGroups'];
        $old->nutritionalProblems = $data['nutritionalProblems'];
        $old->malnutrition = $data['malnutrition'];
        $old->overweightObesity = $data['overweightObesity'];
        $old->signsDanger = $data['signsDanger'];
        $old->rapePhysicalPsychological = $data['rapePhysicalPsychological'];
        $old->rapeSexual = $data['rapeSexual'];
        $old->unschooling = $data['unschooling'];
        $old->schoolPerformance = $data['schoolPerformance'];
        $old->tripZonesEndemic = $data['tripZonesEndemic'];
        $old->personaId = $data['personaId'];
        $old->userId = $data['userId'];
        $old->viviendaId = $data['viviendaId'];
    
        // Guardamos el objeto en la base de datos
        $old->save();
    
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
            $result = DB::table('maite000003.old')
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
    public function update(Request $request, $userId, $personaId, $viviendaId)
    {
        $data = $request->all();
    
        // Encuentra el registro que deseas actualizar basado en los criterios de consulta
        $old = old::where('userId', $userId)
            ->where('personaId', $personaId)
            ->where('viviendaId', $viviendaId)
            ->first();
    
        // Verifica si se encontró el registro
        if (!$old) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }

        $old->weight = $data['weight'];
        $old->size = $data['size'];
        $old->imc = $data['imc'];
        $old->systolicPressure = $data['systolicPressure'];
        $old->diastolicPressure = $data['diastolicPressure'];
        $old->medicalHistory = $data['medicalHistory'];
        $old->completeVaccination = $data['completeVaccination'];
        $old->chronicConditions = $data['chronicConditions'];
        $old->disability = $data['disability'];
        $old->promotionHealth = $data['promotionHealth'];
        $old->oralHygiene = $data['oralHygiene'];
        $old->referralOptometry = $data['referralOptometry'];
        $old->consumptionTobacco = $data['consumptionTobacco'];
        $old->consumptionAlcohol = $data['consumptionAlcohol'];
        $old->psychoactiveSubstances = $data['psychoactiveSubstances'];
        $old->developmentPubertal = $data['developmentPubertal'];
        $old->homeLifeSexual = $data['homeLifeSexual'];
        $old->its = $data['its'];
        $old->chronicCough = $data['chronicCough'];
        $old->identitySexual = $data['identitySexual'];
        $old->psychosocialDevelopment = $data['psychosocialDevelopment'];
        $old->suicidalBehavior = $data['suicidalBehavior'];
        $old->ethnicGroups = $data['ethnicGroups'];
        $old->nutritionalProblems = $data['nutritionalProblems'];
        $old->malnutrition = $data['malnutrition'];
        $old->overweightObesity = $data['overweightObesity'];
        $old->signsDanger = $data['signsDanger'];
        $old->rapePhysicalPsychological = $data['rapePhysicalPsychological'];
        $old->rapeSexual = $data['rapeSexual'];
        $old->unschooling = $data['unschooling'];
        $old->schoolPerformance = $data['schoolPerformance'];
        $old->tripZonesEndemic = $data['tripZonesEndemic'];
        $old->personaId = $data['personaId'];
        $old->userId = $data['userId'];
        $old->viviendaId = $data['viviendaId'];

        // Guarda los cambios en la base de datos
        $old->save();
    
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
        old::where('id', $id)->where('id', $id)->delete();
    
        return response()->json(['message' => 'Dato borrado correctamente']);

    }
}
