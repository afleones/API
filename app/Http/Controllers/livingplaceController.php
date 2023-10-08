<?php

namespace App\Http\Controllers;

use App\Models\livingplace;
use Illuminate\Http\Request;

class livingplaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $livingplace = livingplace::selectRaw("id,
        division_geografica,
        direccion,
        territorio,
        microterritorio,
        tipo_vivienda,
        tenencia_vivienda,
        estrato,
        num_habitantes,
        num_familias,
        num_hogares,
        material_paredes,
        estado_paredes,
        material_piso,
        material_techo,
        estado_techo,
        num_habitaciones,
        hacinamiento,
        actividad_economica,
        acceso_vivienda,
        cerca_vivienda,
        desplazamiento_familia,
        escenarios_riesgo,
        fuente_agua,
        agua_potable,
        tratamiento_agua,
        horas_agua,
        tanque_agua,
        frecuencia_lavado_tanque,
        sistema_excretas,
        separacion_residuos,
        disposicion_residuos,
        sistema_aguas_residuales,
        condiciones_higiene,
        lavado_manos,
        cepillado_dientes,
        comparten_implementos,
        implementos_disposicion,
        fuente_energia,
        convive_con_animales,
        animales_conviven,
        desparasita_animales,
        vacuna_animales,
        excretas_animales,
        presencia_vectores,
        vectores_presentes,
        criaderos_vectores,
        animales_venenosos,
        animales_venenosos_presentes,
        almacenamiento_productos,
        almacenamiento_quimicos,
        disposicion_residuos_aseo,
        disposicion_residuos_peligrosos,
        sintomas_menores_5,
        sintomas_mayores_5,
        almacenamiento_alimentos,
        limpieza_cocina,
        tipo_familia,
        num_personas_familia,
        curso_vida_familia,
        integrantes_comunidad_LGBTI,
        cuidados_momentos_curso_vida,
        estilo_vida_predominante,
        antecedentes_enfermedades_familiares,
        riesgos_psicosociales_familiares,
        subsidio_institucion_nacional,
        tipo_subsidio_aporte,
        integrante_situacion_discapacidad,
        familiar_victima_conflicto_armado,
        hecho_victimizante_conflicto_armado,
        percepcion_funcionabilidad_familiar,
        cuidador_principal,
        sobrecarga_cuidador,
        mapa_relaciones_recursos,
        cuidador_principal_nombre,
        imagen_vivienda,
        otro_tipo_vivienda,
        otro_tenencia_vivienda,
        otro_material_paredes,
        otro_material_piso,
        otro_material_techo,
        otro_cerca_vivienda,
        otro_acceso_vivienda,
        otro_desplazamiento_familia,
        otro_fuente_agua,
        otro_tratamiento_agua,
        otro_frecuencia_lavado_tanque,
        otro_sistema_excretas,
        otro_sistema_aguas_residuales,
        otro_disposicion_residuos,
        otro_implementos_disposicion,
        otro_fuente_energia,
        otro_animales_conviven,
        otro_vectores_presentes,
        otro_animales_venenosos_presentes,
        otro_disposicion_residuos_aseo,
        otro_disposicion_residuos_peligrosos,
        otro_sintomas_menores_5,
        otro_sintomas_mayores_5,
        latitud,
        longitud,
        nombre_nucleo,
        userid
        ")->get();
        return $livingplace;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $data = $request->all();

        
        // Creamos un nuevo objeto del modelo
        $livingplace = new livingplace();

        // Asignamos los datos a las propiedades del objeto
        $livingplace->division_geografica= $data['division_geografica'];
        
        $livingplace->direccion= $data['direccion'];
        $livingplace->territorio= $data['territorio'];
        $livingplace->microterritorio= $data['microterritorio'];
        $livingplace->tipo_vivienda= $data['tipo_vivienda'];
        $livingplace->tenencia_vivienda= $data['tenencia_vivienda'];
        $livingplace->estrato= $data['estrato'];
        $livingplace->num_habitantes= $data['num_habitantes'];
        $livingplace->num_familias= $data['num_familias'];
        $livingplace->num_hogares= $data['num_hogares'];
        $livingplace->material_paredes= $data['material_paredes'];
        $livingplace->estado_paredes= $data['estado_paredes'];
        $livingplace->material_piso= $data['material_piso'];
        $livingplace->material_techo= $data['material_techo'];
        $livingplace->estado_techo= $data['estado_techo'];
        $livingplace->num_habitaciones= $data['num_habitaciones'];
        $livingplace->hacinamiento= $data['hacinamiento'];
        $livingplace->actividad_economica= $data['actividad_economica'];
        $livingplace->acceso_vivienda= $data['acceso_vivienda'];
        $livingplace->cerca_vivienda= $data['cerca_vivienda'];
        $livingplace->desplazamiento_familia= $data['desplazamiento_familia'];
        $livingplace->escenarios_riesgo= $data['escenarios_riesgo'];
        $livingplace->fuente_agua= $data['fuente_agua'];
        $livingplace->agua_potable= $data['agua_potable'];
        $livingplace->tratamiento_agua= $data['tratamiento_agua'];
        $livingplace->horas_agua= $data['horas_agua'];
        $livingplace->tanque_agua= $data['tanque_agua'];
        $livingplace->frecuencia_lavado_tanque= $data['frecuencia_lavado_tanque'];
        $livingplace->sistema_excretas= $data['sistema_excretas'];
        $livingplace->separacion_residuos= $data['separacion_residuos'];
        $livingplace->disposicion_residuos= $data['disposicion_residuos'];
        $livingplace->sistema_aguas_residuales= $data['sistema_aguas_residuales'];
        $livingplace->condiciones_higiene= $data['condiciones_higiene'];
        $livingplace->lavado_manos= $data['lavado_manos'];
        $livingplace->cepillado_dientes= $data['cepillado_dientes'];
        $livingplace->comparten_implementos= $data['comparten_implementos'];
        $livingplace->implementos_disposicion= $data['implementos_disposicion'];
        $livingplace->fuente_energia= $data['fuente_energia'];
        $livingplace->convive_con_animales= $data['convive_con_animales'];
        $livingplace->animales_conviven= $data['animales_conviven'];
        $livingplace->desparasita_animales= $data['desparasita_animales'];
        $livingplace->vacuna_animales= $data['vacuna_animales'];
        $livingplace->excretas_animales= $data['excretas_animales'];
        $livingplace->presencia_vectores= $data['presencia_vectores'];
        $livingplace->vectores_presentes= $data['vectores_presentes'];
        $livingplace->criaderos_vectores= $data['criaderos_vectores'];
        $livingplace->animales_venenosos= $data['animales_venenosos'];
        $livingplace->animales_venenosos_presentes= $data['animales_venenosos_presentes'];
        $livingplace->almacenamiento_productos= $data['almacenamiento_productos'];
        $livingplace->almacenamiento_quimicos= $data['almacenamiento_quimicos'];
        $livingplace->disposicion_residuos_aseo= $data['disposicion_residuos_aseo'];
        $livingplace->disposicion_residuos_peligrosos= $data['disposicion_residuos_peligrosos'];
        $livingplace->sintomas_menores_5= $data['sintomas_menores_5'];
        $livingplace->sintomas_mayores_5= $data['sintomas_mayores_5'];
        $livingplace->almacenamiento_alimentos= $data['almacenamiento_alimentos'];
        $livingplace->limpieza_cocina= $data['limpieza_cocina'];
        $livingplace->tipo_familia= $data['tipo_familia'];
        $livingplace->num_personas_familia= $data['num_personas_familia'];
        $livingplace->curso_vida_familia= $data['curso_vida_familia'];
        $livingplace->integrantes_comunidad_LGBTI= $data['integrantes_comunidad_LGBTI'];
        $livingplace->cuidados_momentos_curso_vida= $data['cuidados_momentos_curso_vida'];
        $livingplace->estilo_vida_predominante= $data['estilo_vida_predominante'];
        $livingplace->antecedentes_enfermedades_familiares= $data['antecedentes_enfermedades_familiares'];
        $livingplace->riesgos_psicosociales_familiares= $data['riesgos_psicosociales_familiares'];
        $livingplace->subsidio_institucion_nacional= $data['subsidio_institucion_nacional'];
        $livingplace->tipo_subsidio_aporte= $data['tipo_subsidio_aporte'];
        $livingplace->integrante_situacion_discapacidad= $data['integrante_situacion_discapacidad'];
        $livingplace->familiar_victima_conflicto_armado= $data['familiar_victima_conflicto_armado'];
        $livingplace->hecho_victimizante_conflicto_armado= $data['hecho_victimizante_conflicto_armado'];
        $livingplace->percepcion_funcionabilidad_familiar= $data['percepcion_funcionabilidad_familiar'];
        $livingplace->cuidador_principal= $data['cuidador_principal'];
        $livingplace->sobrecarga_cuidador= $data['sobrecarga_cuidador'];
        $livingplace->mapa_relaciones_recursos= $data['mapa_relaciones_recursos'];
        $livingplace->cuidador_principal_nombre= $data['cuidador_principal_nombre'];
        $livingplace->imagen_vivienda= $data['imagen_vivienda'];
        $livingplace->otro_tipo_vivienda= $data['otro_tipo_vivienda'];
        $livingplace->otro_tenencia_vivienda= $data['otro_tenencia_vivienda'];
        $livingplace->otro_material_paredes= $data['otro_material_paredes'];
        $livingplace->otro_material_piso= $data['otro_material_piso'];
        $livingplace->otro_material_techo= $data['otro_material_techo'];
        $livingplace->otro_cerca_vivienda= $data['otro_cerca_vivienda'];
        $livingplace->otro_acceso_vivienda= $data['otro_acceso_vivienda'];
        $livingplace->otro_desplazamiento_familia= $data['otro_desplazamiento_familia'];
        $livingplace->otro_fuente_agua= $data['otro_fuente_agua'];
        $livingplace->otro_tratamiento_agua= $data['otro_tratamiento_agua'];
        $livingplace->otro_frecuencia_lavado_tanque= $data['otro_frecuencia_lavado_tanque'];
        $livingplace->otro_sistema_excretas= $data['otro_sistema_excretas'];
        $livingplace->otro_sistema_aguas_residuales= $data['otro_sistema_aguas_residuales'];
        $livingplace->otro_disposicion_residuos= $data['otro_disposicion_residuos'];
        $livingplace->otro_implementos_disposicion= $data['otro_implementos_disposicion'];
        $livingplace->otro_fuente_energia= $data['otro_fuente_energia'];
        $livingplace->otro_animales_conviven= $data['otro_animales_conviven'];
        $livingplace->otro_vectores_presentes= $data['otro_vectores_presentes'];
        $livingplace->otro_animales_venenosos_presentes= $data['otro_animales_venenosos_presentes'];
        $livingplace->otro_disposicion_residuos_aseo= $data['otro_disposicion_residuos_aseo'];
        $livingplace->otro_disposicion_residuos_peligrosos= $data['otro_disposicion_residuos_peligrosos'];
        $livingplace->otro_sintomas_menores_5= $data['otro_sintomas_menores_5'];
        $livingplace->otro_sintomas_mayores_5= $data['otro_sintomas_mayores_5'];
        $livingplace->latitud= $data['latitud'];
        $livingplace->longitud= $data['longitud'];
        $livingplace->nombre_nucleo= $data['nombre_nucleo'];
        
        $livingplace->userid= $data['userid'];

        
        // Guardamos el objeto en la base de datos
        $livingplace->save();
    
    
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'Datos insertados correctamente']);

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, livingplace $livingplace)
    {
        //$data = $request->json()->all();  recibe por raw
        $data = $request->all();   //recibe por json
        //var_dump($data);exit();
        $userid = $data['userid'];
        $fecha1 = $data['fecha1'];
        $fecha2 = $data['fecha2'];
        

        $livingplace = livingplace::where('userid', $userid)
                         ->where(function($query) use ($fecha1, $fecha2, $data) {
                            if (isset($data['id'])) {
                                $query->orWhere('id', $data['id']);
                            }
                            // if (isset($data['territorio'])) {
                            //     $query->orWhere('territorio', $data['territorio']);
                            // }
                            $query->whereBetween(\DB::raw('DATE(created_at)'), [$fecha1, $fecha2]);
                         })
                         ->get();     

        //$dataArray = array($livingplace);
        $dataArray = ($livingplace);   //CORRECCION DE MOSTREO DE VIVIENDA 2023-10-06      OTRA VEZ                                   
        
        return $dataArray;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->json()->all();

        $id = $data['id'];
        $division_geografica= $data['division_geografica'];
        
        $direccion= $data['direccion'];
        $territorio= $data['territorio'];
        $microterritorio= $data['microterritorio'];
        $tipo_vivienda= $data['tipo_vivienda'];
        $tenencia_vivienda= $data['tenencia_vivienda'];
        $estrato= $data['estrato'];
        $num_habitantes= $data['num_habitantes'];
        $num_familias= $data['num_familias'];
        $num_hogares= $data['num_hogares'];
        $material_paredes= $data['material_paredes'];
        $estado_paredes= $data['estado_paredes'];
        $material_piso= $data['material_piso'];
        $material_techo= $data['material_techo'];
        $estado_techo= $data['estado_techo'];
        $num_habitaciones= $data['num_habitaciones'];
        $hacinamiento= $data['hacinamiento'];
        $actividad_economica= $data['actividad_economica'];
        $acceso_vivienda= $data['acceso_vivienda'];
        $cerca_vivienda= $data['cerca_vivienda'];
        $desplazamiento_familia= $data['desplazamiento_familia'];
        $escenarios_riesgo= $data['escenarios_riesgo'];
        $fuente_agua= $data['fuente_agua'];
        $agua_potable= $data['agua_potable'];
        $tratamiento_agua= $data['tratamiento_agua'];
        $horas_agua= $data['horas_agua'];
        $tanque_agua= $data['tanque_agua'];
        $frecuencia_lavado_tanque= $data['frecuencia_lavado_tanque'];
        $sistema_excretas= $data['sistema_excretas'];
        $separacion_residuos= $data['separacion_residuos'];
        $disposicion_residuos= $data['disposicion_residuos'];
        $sistema_aguas_residuales= $data['sistema_aguas_residuales'];
        $condiciones_higiene= $data['condiciones_higiene'];
        $lavado_manos= $data['lavado_manos'];
        $cepillado_dientes= $data['cepillado_dientes'];
        $comparten_implementos= $data['comparten_implementos'];
        $implementos_disposicion= $data['implementos_disposicion'];
        $fuente_energia= $data['fuente_energia'];
        $convive_con_animales= $data['convive_con_animales'];
        $animales_conviven= $data['animales_conviven'];
        $desparasita_animales= $data['desparasita_animales'];
        $vacuna_animales= $data['vacuna_animales'];
        $excretas_animales= $data['excretas_animales'];
        $presencia_vectores= $data['presencia_vectores'];
        $vectores_presentes= $data['vectores_presentes'];
        $criaderos_vectores= $data['criaderos_vectores'];
        $animales_venenosos= $data['animales_venenosos'];
        $animales_venenosos_presentes= $data['animales_venenosos_presentes'];
        $almacenamiento_productos= $data['almacenamiento_productos'];
        $almacenamiento_quimicos= $data['almacenamiento_quimicos'];
        $disposicion_residuos_aseo= $data['disposicion_residuos_aseo'];
        $disposicion_residuos_peligrosos= $data['disposicion_residuos_peligrosos'];
        $sintomas_menores_5= $data['sintomas_menores_5'];
        $sintomas_mayores_5= $data['sintomas_mayores_5'];
        $almacenamiento_alimentos= $data['almacenamiento_alimentos'];
        $limpieza_cocina= $data['limpieza_cocina'];
        $tipo_familia= $data['tipo_familia'];
        $num_personas_familia= $data['num_personas_familia'];
        $curso_vida_familia= $data['curso_vida_familia'];
        $integrantes_comunidad_LGBTI= $data['integrantes_comunidad_LGBTI'];
        $cuidados_momentos_curso_vida= $data['cuidados_momentos_curso_vida'];
        $estilo_vida_predominante= $data['estilo_vida_predominante'];
        $antecedentes_enfermedades_familiares= $data['antecedentes_enfermedades_familiares'];
        $riesgos_psicosociales_familiares= $data['riesgos_psicosociales_familiares'];
        $subsidio_institucion_nacional= $data['subsidio_institucion_nacional'];
        $tipo_subsidio_aporte= $data['tipo_subsidio_aporte'];
        $integrante_situacion_discapacidad= $data['integrante_situacion_discapacidad'];
        $familiar_victima_conflicto_armado= $data['familiar_victima_conflicto_armado'];
        $hecho_victimizante_conflicto_armado= $data['hecho_victimizante_conflicto_armado'];
        $percepcion_funcionabilidad_familiar= $data['percepcion_funcionabilidad_familiar'];
        $cuidador_principal= $data['cuidador_principal'];
        $sobrecarga_cuidador= $data['sobrecarga_cuidador'];
        $mapa_relaciones_recursos= $data['mapa_relaciones_recursos'];
        $cuidador_principal_nombre= $data['cuidador_principal_nombre'];
        $imagen_vivienda= $data['imagen_vivienda'];
        $otro_tipo_vivienda= $data['otro_tipo_vivienda'];
        $otro_tenencia_vivienda= $data['otro_tenencia_vivienda'];
        $otro_material_paredes= $data['otro_material_paredes'];
        $otro_material_piso= $data['otro_material_piso'];
        $otro_material_techo= $data['otro_material_techo'];
        $otro_cerca_vivienda= $data['otro_cerca_vivienda'];
        $otro_acceso_vivienda= $data['otro_acceso_vivienda'];
        $otro_desplazamiento_familia= $data['otro_desplazamiento_familia'];
        $otro_fuente_agua= $data['otro_fuente_agua'];
        $otro_tratamiento_agua= $data['otro_tratamiento_agua'];
        $otro_frecuencia_lavado_tanque= $data['otro_frecuencia_lavado_tanque'];
        $otro_sistema_excretas= $data['otro_sistema_excretas'];
        $otro_sistema_aguas_residuales= $data['otro_sistema_aguas_residuales'];
        $otro_disposicion_residuos= $data['otro_disposicion_residuos'];
        $otro_implementos_disposicion= $data['otro_implementos_disposicion'];
        $otro_fuente_energia= $data['otro_fuente_energia'];
        $otro_animales_conviven= $data['otro_animales_conviven'];
        $otro_vectores_presentes= $data['otro_vectores_presentes'];
        $otro_animales_venenosos_presentes= $data['otro_animales_venenosos_presentes'];
        $otro_disposicion_residuos_aseo= $data['otro_disposicion_residuos_aseo'];
        $otro_disposicion_residuos_peligrosos= $data['otro_disposicion_residuos_peligrosos'];
        $otro_sintomas_menores_5= $data['otro_sintomas_menores_5'];
        $otro_sintomas_mayores_5= $data['otro_sintomas_mayores_5'];
        $latitud= $data['latitud'];
        $longitud= $data['longitud'];
        $nombre_nucleo= $data['nombre_nucleo'];
        

        $userid= $data['userid'];
        

        $tabla = livingplace::where('id', $id)->firstOrFail();

        $tabla->division_geografica = $division_geografica;
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
        livingplace::where('id', $id)->where('id', $id)->delete();
    
        return response()->json(['message' => 'Dato borrado correctamente']);

    }
}
