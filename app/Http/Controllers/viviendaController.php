<?php

namespace App\Http\Controllers;

use App\Models\vivienda;
use Illuminate\Http\Request;

class viviendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $vivienda = vivienda::selectRaw("id,
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
        return $vivienda;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $data = $request->all();

        
        // Creamos un nuevo objeto del modelo
        $vivienda = new vivienda();

        // Asignamos los datos a las propiedades del objeto
        $vivienda->division_geografica= $data['division_geografica'];
        
        $vivienda->direccion= $data['direccion'];
        $vivienda->territorio= $data['territorio'];
        $vivienda->microterritorio= $data['microterritorio'];
        $vivienda->tipo_vivienda= $data['tipo_vivienda'];
        $vivienda->tenencia_vivienda= $data['tenencia_vivienda'];
        $vivienda->estrato= $data['estrato'];
        $vivienda->num_habitantes= $data['num_habitantes'];
        $vivienda->num_familias= $data['num_familias'];
        $vivienda->num_hogares= $data['num_hogares'];
        $vivienda->material_paredes= $data['material_paredes'];
        $vivienda->estado_paredes= $data['estado_paredes'];
        $vivienda->material_piso= $data['material_piso'];
        $vivienda->material_techo= $data['material_techo'];
        $vivienda->estado_techo= $data['estado_techo'];
        $vivienda->num_habitaciones= $data['num_habitaciones'];
        $vivienda->hacinamiento= $data['hacinamiento'];
        $vivienda->actividad_economica= $data['actividad_economica'];
        $vivienda->acceso_vivienda= $data['acceso_vivienda'];
        $vivienda->cerca_vivienda= $data['cerca_vivienda'];
        $vivienda->desplazamiento_familia= $data['desplazamiento_familia'];
        $vivienda->escenarios_riesgo= $data['escenarios_riesgo'];
        $vivienda->fuente_agua= $data['fuente_agua'];
        $vivienda->agua_potable= $data['agua_potable'];
        $vivienda->tratamiento_agua= $data['tratamiento_agua'];
        $vivienda->horas_agua= $data['horas_agua'];
        $vivienda->tanque_agua= $data['tanque_agua'];
        $vivienda->frecuencia_lavado_tanque= $data['frecuencia_lavado_tanque'];
        $vivienda->sistema_excretas= $data['sistema_excretas'];
        $vivienda->separacion_residuos= $data['separacion_residuos'];
        $vivienda->disposicion_residuos= $data['disposicion_residuos'];
        $vivienda->sistema_aguas_residuales= $data['sistema_aguas_residuales'];
        $vivienda->condiciones_higiene= $data['condiciones_higiene'];
        $vivienda->lavado_manos= $data['lavado_manos'];
        $vivienda->cepillado_dientes= $data['cepillado_dientes'];
        $vivienda->comparten_implementos= $data['comparten_implementos'];
        $vivienda->implementos_disposicion= $data['implementos_disposicion'];
        $vivienda->fuente_energia= $data['fuente_energia'];
        $vivienda->convive_con_animales= $data['convive_con_animales'];
        $vivienda->animales_conviven= $data['animales_conviven'];
        $vivienda->desparasita_animales= $data['desparasita_animales'];
        $vivienda->vacuna_animales= $data['vacuna_animales'];
        $vivienda->excretas_animales= $data['excretas_animales'];
        $vivienda->presencia_vectores= $data['presencia_vectores'];
        $vivienda->vectores_presentes= $data['vectores_presentes'];
        $vivienda->criaderos_vectores= $data['criaderos_vectores'];
        $vivienda->animales_venenosos= $data['animales_venenosos'];
        $vivienda->animales_venenosos_presentes= $data['animales_venenosos_presentes'];
        $vivienda->almacenamiento_productos= $data['almacenamiento_productos'];
        $vivienda->almacenamiento_quimicos= $data['almacenamiento_quimicos'];
        $vivienda->disposicion_residuos_aseo= $data['disposicion_residuos_aseo'];
        $vivienda->disposicion_residuos_peligrosos= $data['disposicion_residuos_peligrosos'];
        $vivienda->sintomas_menores_5= $data['sintomas_menores_5'];
        $vivienda->sintomas_mayores_5= $data['sintomas_mayores_5'];
        $vivienda->almacenamiento_alimentos= $data['almacenamiento_alimentos'];
        $vivienda->limpieza_cocina= $data['limpieza_cocina'];
        $vivienda->tipo_familia= $data['tipo_familia'];
        $vivienda->num_personas_familia= $data['num_personas_familia'];
        $vivienda->curso_vida_familia= $data['curso_vida_familia'];
        $vivienda->integrantes_comunidad_LGBTI= $data['integrantes_comunidad_LGBTI'];
        $vivienda->cuidados_momentos_curso_vida= $data['cuidados_momentos_curso_vida'];
        $vivienda->estilo_vida_predominante= $data['estilo_vida_predominante'];
        $vivienda->antecedentes_enfermedades_familiares= $data['antecedentes_enfermedades_familiares'];
        $vivienda->riesgos_psicosociales_familiares= $data['riesgos_psicosociales_familiares'];
        $vivienda->subsidio_institucion_nacional= $data['subsidio_institucion_nacional'];
        $vivienda->tipo_subsidio_aporte= $data['tipo_subsidio_aporte'];
        $vivienda->integrante_situacion_discapacidad= $data['integrante_situacion_discapacidad'];
        $vivienda->familiar_victima_conflicto_armado= $data['familiar_victima_conflicto_armado'];
        $vivienda->hecho_victimizante_conflicto_armado= $data['hecho_victimizante_conflicto_armado'];
        $vivienda->percepcion_funcionabilidad_familiar= $data['percepcion_funcionabilidad_familiar'];
        $vivienda->cuidador_principal= $data['cuidador_principal'];
        $vivienda->sobrecarga_cuidador= $data['sobrecarga_cuidador'];
        $vivienda->mapa_relaciones_recursos= $data['mapa_relaciones_recursos'];
        $vivienda->cuidador_principal_nombre= $data['cuidador_principal_nombre'];
        $vivienda->userid= $data['userid'];

        
        // Guardamos el objeto en la base de datos
        $vivienda->save();
    
    
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'Datos insertados correctamente']);

    }

    /**
     * Display the specified resource.
     */
    public function show(vivienda $vivienda)
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
        

        $tabla = vivienda::where('id', $id)
                   
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
        vivienda::where('id', $id)->where('id', $id)->delete();
    
        return response()->json(['message' => 'Dato borrado correctamente']);

    }
}
