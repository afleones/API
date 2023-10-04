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
        
        // $livingplace->direccion= $data['direccion'];
        // $livingplace->territorio= $data['territorio'];
        // $livingplace->microterritorio= $data['microterritorio'];
        // $livingplace->tipo_vivienda= $data['tipo_vivienda'];
        // $livingplace->tenencia_vivienda= $data['tenencia_vivienda'];
        // $livingplace->estrato= $data['estrato'];
        // $livingplace->num_habitantes= $data['num_habitantes'];
        // $livingplace->num_familias= $data['num_familias'];
        // $livingplace->num_hogares= $data['num_hogares'];
        // $livingplace->material_paredes= $data['material_paredes'];
        // $livingplace->estado_paredes= $data['estado_paredes'];
        // $livingplace->material_piso= $data['material_piso'];
        // $livingplace->material_techo= $data['material_techo'];
        // $livingplace->estado_techo= $data['estado_techo'];
        // $livingplace->num_habitaciones= $data['num_habitaciones'];
        // $livingplace->hacinamiento= $data['hacinamiento'];
        // $livingplace->actividad_economica= $data['actividad_economica'];
        // $livingplace->acceso_vivienda= $data['acceso_vivienda'];
        // $livingplace->cerca_vivienda= $data['cerca_vivienda'];
        // $livingplace->desplazamiento_familia= $data['desplazamiento_familia'];
        // $livingplace->escenarios_riesgo= $data['escenarios_riesgo'];
        // $livingplace->fuente_agua= $data['fuente_agua'];
        // $livingplace->agua_potable= $data['agua_potable'];
        // $livingplace->tratamiento_agua= $data['tratamiento_agua'];
        // $livingplace->horas_agua= $data['horas_agua'];
        // $livingplace->tanque_agua= $data['tanque_agua'];
        // $livingplace->frecuencia_lavado_tanque= $data['frecuencia_lavado_tanque'];
        // $livingplace->sistema_excretas= $data['sistema_excretas'];
        // $livingplace->separacion_residuos= $data['separacion_residuos'];
        // $livingplace->disposicion_residuos= $data['disposicion_residuos'];
        // $livingplace->sistema_aguas_residuales= $data['sistema_aguas_residuales'];
        // $livingplace->condiciones_higiene= $data['condiciones_higiene'];
        // $livingplace->lavado_manos= $data['lavado_manos'];
        // $livingplace->cepillado_dientes= $data['cepillado_dientes'];
        // $livingplace->comparten_implementos= $data['comparten_implementos'];
        // $livingplace->implementos_disposicion= $data['implementos_disposicion'];
        // $livingplace->fuente_energia= $data['fuente_energia'];
        // $livingplace->convive_con_animales= $data['convive_con_animales'];
        // $livingplace->animales_conviven= $data['animales_conviven'];
        // $livingplace->desparasita_animales= $data['desparasita_animales'];
        // $livingplace->vacuna_animales= $data['vacuna_animales'];
        // $livingplace->excretas_animales= $data['excretas_animales'];
        // $livingplace->presencia_vectores= $data['presencia_vectores'];
        // $livingplace->vectores_presentes= $data['vectores_presentes'];
        // $livingplace->criaderos_vectores= $data['criaderos_vectores'];
        // $livingplace->animales_venenosos= $data['animales_venenosos'];
        // $livingplace->animales_venenosos_presentes= $data['animales_venenosos_presentes'];
        // $livingplace->almacenamiento_productos= $data['almacenamiento_productos'];
        // $livingplace->almacenamiento_quimicos= $data['almacenamiento_quimicos'];
        // $livingplace->disposicion_residuos_aseo= $data['disposicion_residuos_aseo'];
        // $livingplace->disposicion_residuos_peligrosos= $data['disposicion_residuos_peligrosos'];
        // $livingplace->sintomas_menores_5= $data['sintomas_menores_5'];
        // $livingplace->sintomas_mayores_5= $data['sintomas_mayores_5'];
        // $livingplace->almacenamiento_alimentos= $data['almacenamiento_alimentos'];
        // $livingplace->limpieza_cocina= $data['limpieza_cocina'];
        // $livingplace->tipo_familia= $data['tipo_familia'];
        // $livingplace->num_personas_familia= $data['num_personas_familia'];
        // $livingplace->curso_vida_familia= $data['curso_vida_familia'];
        // $livingplace->integrantes_comunidad_LGBTI= $data['integrantes_comunidad_LGBTI'];
        // $livingplace->cuidados_momentos_curso_vida= $data['cuidados_momentos_curso_vida'];
        // $livingplace->estilo_vida_predominante= $data['estilo_vida_predominante'];
        // $livingplace->antecedentes_enfermedades_familiares= $data['antecedentes_enfermedades_familiares'];
        // $livingplace->riesgos_psicosociales_familiares= $data['riesgos_psicosociales_familiares'];
        // $livingplace->subsidio_institucion_nacional= $data['subsidio_institucion_nacional'];
        // $livingplace->tipo_subsidio_aporte= $data['tipo_subsidio_aporte'];
        // $livingplace->integrante_situacion_discapacidad= $data['integrante_situacion_discapacidad'];
        // $livingplace->familiar_victima_conflicto_armado= $data['familiar_victima_conflicto_armado'];
        // $livingplace->hecho_victimizante_conflicto_armado= $data['hecho_victimizante_conflicto_armado'];
        // $livingplace->percepcion_funcionabilidad_familiar= $data['percepcion_funcionabilidad_familiar'];
        // $livingplace->cuidador_principal= $data['cuidador_principal'];
        // $livingplace->sobrecarga_cuidador= $data['sobrecarga_cuidador'];
        // $livingplace->mapa_relaciones_recursos= $data['mapa_relaciones_recursos'];
        // $livingplace->cuidador_principal_nombre= $data['cuidador_principal_nombre'];
        // $livingplace->userid= $data['userid'];

        
        // Guardamos el objeto en la base de datos
        $livingplace->save();
    
    
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'Datos insertados correctamente']);

    }

    /**
     * Display the specified resource.
     */
    public function show(livingplace $livingplace)
    {
        
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
        $userid= $data['userid'];
        

        $tabla = livingplace::where('id', $id)
                   
                   ->firstOrFail();

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
