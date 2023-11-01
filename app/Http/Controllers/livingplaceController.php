<?php

namespace App\Http\Controllers;

use App\Models\livingplace;
use App\Models\person;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
        barrio,
        tipo_direccion,
        numero_direccion,
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
        $livingplace->barrio= $data['barrio'];
        $livingplace->tipo_direccion= $data['tipo_direccion'];
        $livingplace->numero_direccion= $data['numero_direccion'];
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

        $insertedId = $livingplace->id;
        return response()->json(['message' => 'Datos insertados correctamente', 'inserted_id' => $insertedId]);
    
    
        // Retornamos una respuesta de éxito
       // return response()->json(['message' => 'Datos insertados correctamente']);

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
        //$fecha1 = $data['fecha1'];
        //$fecha2 = $data['fecha2'];
        
        $livingplace = livingplace::where('userid', $userid)->where(function($query) use ($data) {
            if (isset($data['id'])) {
                $query->Where('id', $data['id']);
            }
            if (isset($data['userid'])) {
                $query->Where('userid', $data['userid']);
            }
            if (isset($data['fecha1']) and isset($data['fecha2'])) {
                $query->whereBetween(\DB::raw('DATE(created_at)'), [$data['fecha1'], $data['fecha2']]);
            }
        })->get();     

        //$dataArray = array($livingplace);
        $dataArray = ($livingplace);   //CORRECCION DE MOSTREO DE VIVIENDA 2023-10-06      OTRA VEZ                                   
        
        return $dataArray;
    }

    


    public function showLivingplace(Request $request, livingplace $livingplace)
    {
        //$data = $request->json()->all();
        $data = $request->all(); 

        //var_dump($data);exit();
        //$userid = $data['userid'];

        $livingplace = livingplace::
                         where(function($query) use ($data) {  
                            if (isset($data['userid'])) {
                                $query->Where('livingplace.userid', $data['userid']);
                            }
                            if (isset($data['liderid'])) {
                                $query->Where('users.liderid', $data['liderid']);
                            }
                            if (isset($data['fecha1']) and isset($data['fecha2'])) {
                                $query->whereBetween(\DB::raw('DATE(livingplace.created_at)'), [$data['fecha1'], $data['fecha2']]);
                            }
                         })
                         ->leftJoin('maite_backend.users', 'users.id', '=', 'livingplace.userid')
                         ->selectRaw('users.liderid,livingplace.userid, name, DATE(livingplace.created_at) as Creado, count(*) as Total')
                         ->groupBy('livingplace.userid', 'Creado', 'liderid')
                         ->orderBY('livingplace.userid')
                         ->get();

        $dataArray = $livingplace;             
        return $dataArray;
    }


    public function showLivingplacePerson(Request $request, livingplace $livingplace)
    {
        $data = $request->all();

        $query = livingplace::
                where(function($query) use ($data) {  
                    // Condiciones de búsqueda
                })
                ->leftJoin('maite_backend.users', 'users.id', '=', 'livingplace.userid')
                ->select('livingplace.*')
                ->orderBy('livingplace.userid');

        // Aplicar paginación
        $perPage = $data['per_page'] ?? 20; // Número de registros por página
        $page = $data['page'] ?? 1; // Página actual

        // Recuperar todas las páginas
        $allPages = [];
        do {
            $livingplaces = $query->paginate($perPage, ['*'], 'page', $page);
            $allPages[] = $livingplaces;
            $page++; // Obtener la siguiente página
        } while ($livingplaces->hasMorePages());

        $payload = [];

        foreach ($allPages as $page) {
            foreach ($page as $livingplace) {
                $persons = person::where('viviendaid', $livingplace->id)->get();
                $payload[] = ['livingplace' => $livingplace, 'persons' => $persons];
            }
        }

        return $payload;
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, livingplace $livingplace)
    {
        //$id = $request->input('id');
        //d($request->all);
        //var_dump($id);exit();
        $data = $request->all();
        //var_dump($data);exit();

        $id = isset($data['id']) ? $data['id'] : '';
        $division_geografica = isset($data['division_geografica']) ? $data['division_geografica'] : '';
        $direccion = isset($data['direccion']) ? $data['direccion'] : '';
        $barrio = isset($data['barrio']) ? $data['barrio'] : '';
        
        $tipo_direccion = isset($data['tipo_direccion']) ? $data['tipo_direccion'] : '';
        $numero_direccion = isset($data['numero_direccion']) ? $data['numero_direccion'] : '';

        $territorio = isset($data['territorio']) ? $data['territorio'] : '';
        $microterritorio = isset($data['microterritorio']) ? $data['microterritorio'] : '';
        $tipo_vivienda = isset($data['tipo_vivienda']) ? $data['tipo_vivienda'] : '';
        $tenencia_vivienda = isset($data['tenencia_vivienda']) ? $data['tenencia_vivienda'] : '';
        $estrato = isset($data['estrato']) ? $data['estrato'] : '';
        $num_habitantes = isset($data['num_habitantes']) ? $data['num_habitantes'] : '';
        $num_familias = isset($data['num_familias']) ? $data['num_familias'] : '';
        $num_hogares = isset($data['num_hogares']) ? $data['num_hogares'] : '';
        $material_paredes = isset($data['material_paredes']) ? $data['material_paredes'] : '';
        $estado_paredes = isset($data['estado_paredes']) ? $data['estado_paredes'] : '';
        $material_piso = isset($data['material_piso']) ? $data['material_piso'] : '';
        $material_techo = isset($data['material_techo']) ? $data['material_techo'] : '';
        $estado_techo = isset($data['estado_techo']) ? $data['estado_techo'] : '';
        $num_habitaciones = isset($data['num_habitaciones']) ? $data['num_habitaciones'] : '';
        $hacinamiento = isset($data['hacinamiento']) ? $data['hacinamiento'] : '';
        $actividad_economica = isset($data['actividad_economica']) ? $data['actividad_economica'] : '';
        $acceso_vivienda = isset($data['acceso_vivienda']) ? $data['acceso_vivienda'] : '';
        $cerca_vivienda = isset($data['cerca_vivienda']) ? $data['cerca_vivienda'] : '';
        $desplazamiento_familia = isset($data['desplazamiento_familia']) ? $data['desplazamiento_familia'] : '';
        $escenarios_riesgo = isset($data['escenarios_riesgo']) ? $data['escenarios_riesgo'] : '';
        $fuente_agua = isset($data['fuente_agua']) ? $data['fuente_agua'] : '';
        $agua_potable = isset($data['agua_potable']) ? $data['agua_potable'] : '';
        $tratamiento_agua = isset($data['tratamiento_agua']) ? $data['tratamiento_agua'] : '';
        $horas_agua = isset($data['horas_agua']) ? $data['horas_agua'] : '';
        $tanque_agua = isset($data['tanque_agua']) ? $data['tanque_agua'] : '';
        $frecuencia_lavado_tanque = isset($data['frecuencia_lavado_tanque']) ? $data['frecuencia_lavado_tanque'] : '';
        $sistema_excretas = isset($data['sistema_excretas']) ? $data['sistema_excretas'] : '';
        $separacion_residuos = isset($data['separacion_residuos']) ? $data['separacion_residuos'] : '';
        $disposicion_residuos = isset($data['disposicion_residuos']) ? $data['disposicion_residuos'] : '';
        $sistema_aguas_residuales = isset($data['sistema_aguas_residuales']) ? $data['sistema_aguas_residuales'] : '';
        $condiciones_higiene = isset($data['condiciones_higiene']) ? $data['condiciones_higiene'] : '';
        $lavado_manos = isset($data['lavado_manos']) ? $data['lavado_manos'] : '';
        $cepillado_dientes = isset($data['cepillado_dientes']) ? $data['cepillado_dientes'] : '';
        $comparten_implementos = isset($data['comparten_implementos']) ? $data['comparten_implementos'] : '';
        $implementos_disposicion = isset($data['implementos_disposicion']) ? $data['implementos_disposicion'] : '';
        $fuente_energia = isset($data['fuente_energia']) ? $data['fuente_energia'] : '';
        $convive_con_animales = isset($data['convive_con_animales']) ? $data['convive_con_animales'] : '';
        $animales_conviven = isset($data['animales_conviven']) ? $data['animales_conviven'] : '';
        $desparasita_animales = isset($data['desparasita_animales']) ? $data['desparasita_animales'] : '';
        $vacuna_animales = isset($data['vacuna_animales']) ? $data['vacuna_animales'] : '';
        $excretas_animales = isset($data['excretas_animales']) ? $data['excretas_animales'] : '';
        $presencia_vectores = isset($data['presencia_vectores']) ? $data['presencia_vectores'] : '';
        $vectores_presentes = isset($data['vectores_presentes']) ? $data['vectores_presentes'] : '';
        $criaderos_vectores = isset($data['criaderos_vectores']) ? $data['criaderos_vectores'] : '';
        $animales_venenosos = isset($data['animales_venenosos']) ? $data['animales_venenosos'] : '';
        $animales_venenosos_presentes = isset($data['animales_venenosos_presentes']) ? $data['animales_venenosos_presentes'] : '';
        $almacenamiento_productos = isset($data['almacenamiento_productos']) ? $data['almacenamiento_productos'] : '';
        $almacenamiento_quimicos = isset($data['almacenamiento_quimicos']) ? $data['almacenamiento_quimicos'] : '';
        $disposicion_residuos_aseo = isset($data['disposicion_residuos_aseo']) ? $data['disposicion_residuos_aseo'] : '';
        $disposicion_residuos_peligrosos = isset($data['disposicion_residuos_peligrosos']) ? $data['disposicion_residuos_peligrosos'] : '';
        $sintomas_menores_5 = isset($data['sintomas_menores_5']) ? $data['sintomas_menores_5'] : '';
        $sintomas_mayores_5 = isset($data['sintomas_mayores_5']) ? $data['sintomas_mayores_5'] : '';
        $almacenamiento_alimentos = isset($data['almacenamiento_alimentos']) ? $data['almacenamiento_alimentos'] : '';
        $limpieza_cocina = isset($data['limpieza_cocina']) ? $data['limpieza_cocina'] : '';
        $tipo_familia = isset($data['tipo_familia']) ? $data['tipo_familia'] : '';
        $num_personas_familia = isset($data['num_personas_familia']) ? $data['num_personas_familia'] : '';
        $curso_vida_familia = isset($data['curso_vida_familia']) ? $data['curso_vida_familia'] : '';
        $integrantes_comunidad_LGBTI = isset($data['integrantes_comunidad_LGBTI']) ? $data['integrantes_comunidad_LGBTI'] : '';
        $cuidados_momentos_curso_vida = isset($data['cuidados_momentos_curso_vida']) ? $data['cuidados_momentos_curso_vida'] : '';
        $estilo_vida_predominante = isset($data['estilo_vida_predominante']) ? $data['estilo_vida_predominante'] : '';
        $antecedentes_enfermedades_familiares = isset($data['antecedentes_enfermedades_familiares']) ? $data['antecedentes_enfermedades_familiares'] : '';
        $riesgos_psicosociales_familiares = isset($data['riesgos_psicosociales_familiares']) ? $data['riesgos_psicosociales_familiares'] : '';
        $subsidio_institucion_nacional = isset($data['subsidio_institucion_nacional']) ? $data['subsidio_institucion_nacional'] : '';
        $tipo_subsidio_aporte = isset($data['tipo_subsidio_aporte']) ? $data['tipo_subsidio_aporte'] : '';
        $integrante_situacion_discapacidad = isset($data['integrante_situacion_discapacidad']) ? $data['integrante_situacion_discapacidad'] : '';
        $familiar_victima_conflicto_armado = isset($data['familiar_victima_conflicto_armado']) ? $data['familiar_victima_conflicto_armado'] : '';
        $hecho_victimizante_conflicto_armado = isset($data['hecho_victimizante_conflicto_armado']) ? $data['hecho_victimizante_conflicto_armado'] : '';
        $percepcion_funcionabilidad_familiar = isset($data['percepcion_funcionabilidad_familiar']) ? $data['percepcion_funcionabilidad_familiar'] : '';
        $cuidador_principal = isset($data['cuidador_principal']) ? $data['cuidador_principal'] : '';
        $sobrecarga_cuidador = isset($data['sobrecarga_cuidador']) ? $data['sobrecarga_cuidador'] : '';
        $mapa_relaciones_recursos = isset($data['mapa_relaciones_recursos']) ? $data['mapa_relaciones_recursos'] : '';
        $cuidador_principal_nombre = isset($data['cuidador_principal_nombre']) ? $data['cuidador_principal_nombre'] : '';
        $imagen_vivienda = isset($data['imagen_vivienda']) ? $data['imagen_vivienda'] : '';
        $otro_tipo_vivienda = isset($data['otro_tipo_vivienda']) ? $data['otro_tipo_vivienda'] : '';
        $otro_tenencia_vivienda = isset($data['otro_tenencia_vivienda']) ? $data['otro_tenencia_vivienda'] : '';
        $otro_material_paredes = isset($data['otro_material_paredes']) ? $data['otro_material_paredes'] : '';
        $otro_material_piso = isset($data['otro_material_piso']) ? $data['otro_material_piso'] : '';
        $otro_material_techo = isset($data['otro_material_techo']) ? $data['otro_material_techo'] : '';
        $otro_cerca_vivienda = isset($data['otro_cerca_vivienda']) ? $data['otro_cerca_vivienda'] : '';
        $otro_acceso_vivienda = isset($data['otro_acceso_vivienda']) ? $data['otro_acceso_vivienda'] : '';
        $otro_desplazamiento_familia = isset($data['otro_desplazamiento_familia']) ? $data['otro_desplazamiento_familia'] : '';
        $otro_fuente_agua = isset($data['otro_fuente_agua']) ? $data['otro_fuente_agua'] : '';
        $otro_tratamiento_agua = isset($data['otro_tratamiento_agua']) ? $data['otro_tratamiento_agua'] : '';
        $otro_frecuencia_lavado_tanque = isset($data['otro_frecuencia_lavado_tanque']) ? $data['otro_frecuencia_lavado_tanque'] : '';
        $otro_sistema_excretas = isset($data['otro_sistema_excretas']) ? $data['otro_sistema_excretas'] : '';
        $otro_sistema_aguas_residuales = isset($data['otro_sistema_aguas_residuales']) ? $data['otro_sistema_aguas_residuales'] : '';
        $otro_disposicion_residuos = isset($data['otro_disposicion_residuos']) ? $data['otro_disposicion_residuos'] : '';
        $otro_implementos_disposicion = isset($data['otro_implementos_disposicion']) ? $data['otro_implementos_disposicion'] : '';
        $otro_fuente_energia = isset($data['otro_fuente_energia']) ? $data['otro_fuente_energia'] : '';
        $otro_animales_conviven = isset($data['otro_animales_conviven']) ? $data['otro_animales_conviven'] : '';
        $otro_vectores_presentes = isset($data['otro_vectores_presentes']) ? $data['otro_vectores_presentes'] : '';
        $otro_animales_venenosos_presentes = isset($data['otro_animales_venenosos_presentes']) ? $data['otro_animales_venenosos_presentes'] : '';

        $otro_disposicion_residuos_aseo = isset($data['otro_disposicion_residuos_aseo']) ? $data['otro_disposicion_residuos_aseo'] : '';
        $otro_disposicion_residuos_peligrosos = isset($data['otro_disposicion_residuos_peligrosos']) ? $data['otro_disposicion_residuos_peligrosos'] : '';
        $otro_sintomas_menores_5 = isset($data['otro_sintomas_menores_5']) ? $data['otro_sintomas_menores_5'] : '';
        $otro_sintomas_mayores_5 = isset($data['otro_sintomas_mayores_5']) ? $data['otro_sintomas_mayores_5'] : '';
        $latitud = isset($data['latitud']) ? $data['latitud'] : '';
        $longitud = isset($data['longitud']) ? $data['longitud'] : '';
        $nombre_nucleo = isset($data['nombre_nucleo']) ? $data['nombre_nucleo'] : '';

        

        $userid=  isset($data['userid']) ? $data['userid'] : ''; 
        

        $tabla = livingplace::where('id', $id)
                            ->where('userid', $userid)
                            ->firstOrFail();

        $tabla->division_geografica = $division_geografica;
        $tabla->direccion = $direccion;
        $tabla->barrio = $barrio;
        

        $tabla->tipo_direccion = $tipo_direccion;
        $tabla->numero_direccion = $numero_direccion;

        $tabla->territorio = $territorio;
        $tabla->microterritorio = $microterritorio;
        $tabla->tipo_vivienda = $tipo_vivienda;
        $tabla->tenencia_vivienda = $tenencia_vivienda;
        $tabla->estrato = $estrato;
        $tabla->num_habitantes = $num_habitantes;
        $tabla->num_familias = $num_familias;
        $tabla->num_hogares = $num_hogares;
        $tabla->material_paredes = $material_paredes;
        $tabla->estado_paredes = $estado_paredes;
        $tabla->material_piso = $material_piso;
        $tabla->material_techo = $material_techo;
        $tabla->estado_techo = $estado_techo;
        $tabla->num_habitaciones = $num_habitaciones;
        $tabla->hacinamiento = $hacinamiento;
        $tabla->actividad_economica = $actividad_economica;
        $tabla->acceso_vivienda = $acceso_vivienda;
        $tabla->cerca_vivienda = $cerca_vivienda;
        $tabla->desplazamiento_familia = $desplazamiento_familia;
        $tabla->escenarios_riesgo = $escenarios_riesgo;
        $tabla->fuente_agua = $fuente_agua;
        $tabla->agua_potable = $agua_potable;
        $tabla->tratamiento_agua = $tratamiento_agua;
        $tabla->horas_agua = $horas_agua;
        $tabla->tanque_agua = $tanque_agua;
        $tabla->frecuencia_lavado_tanque = $frecuencia_lavado_tanque;
        $tabla->sistema_excretas = $sistema_excretas;
        $tabla->separacion_residuos = $separacion_residuos;
        $tabla->disposicion_residuos = $disposicion_residuos;
        $tabla->sistema_aguas_residuales = $sistema_aguas_residuales;
        $tabla->condiciones_higiene = $condiciones_higiene;
        $tabla->lavado_manos = $lavado_manos;
        $tabla->cepillado_dientes = $cepillado_dientes;
        $tabla->comparten_implementos = $comparten_implementos;
        $tabla->implementos_disposicion = $implementos_disposicion;
        $tabla->fuente_energia = $fuente_energia;
        $tabla->convive_con_animales = $convive_con_animales;
        $tabla->animales_conviven = $animales_conviven;
        $tabla->desparasita_animales = $desparasita_animales;
        $tabla->vacuna_animales = $vacuna_animales;
        $tabla->excretas_animales = $excretas_animales;
        $tabla->presencia_vectores = $presencia_vectores;
        $tabla->vectores_presentes = $vectores_presentes;
        $tabla->criaderos_vectores = $criaderos_vectores;
        $tabla->animales_venenosos = $animales_venenosos;
        $tabla->animales_venenosos_presentes = $animales_venenosos_presentes;
        $tabla->almacenamiento_productos = $almacenamiento_productos;
        $tabla->almacenamiento_quimicos = $almacenamiento_quimicos;
        $tabla->disposicion_residuos_aseo = $disposicion_residuos_aseo;
        $tabla->disposicion_residuos_peligrosos = $disposicion_residuos_peligrosos;
        $tabla->sintomas_menores_5 = $sintomas_menores_5;
        $tabla->sintomas_mayores_5 = $sintomas_mayores_5;
        $tabla->almacenamiento_alimentos = $almacenamiento_alimentos;
        $tabla->limpieza_cocina = $limpieza_cocina;
        $tabla->tipo_familia = $tipo_familia;
        $tabla->num_personas_familia = $num_personas_familia;
        $tabla->curso_vida_familia = $curso_vida_familia;
        $tabla->integrantes_comunidad_LGBTI = $integrantes_comunidad_LGBTI;
        $tabla->cuidados_momentos_curso_vida = $cuidados_momentos_curso_vida;
        $tabla->estilo_vida_predominante = $estilo_vida_predominante;
        $tabla->antecedentes_enfermedades_familiares = $antecedentes_enfermedades_familiares;
        $tabla->riesgos_psicosociales_familiares = $riesgos_psicosociales_familiares;
        $tabla->subsidio_institucion_nacional = $subsidio_institucion_nacional;
        $tabla->tipo_subsidio_aporte = $tipo_subsidio_aporte;
        $tabla->integrante_situacion_discapacidad = $integrante_situacion_discapacidad;
        $tabla->familiar_victima_conflicto_armado = $familiar_victima_conflicto_armado;
        $tabla->hecho_victimizante_conflicto_armado = $hecho_victimizante_conflicto_armado;
        $tabla->percepcion_funcionabilidad_familiar = $percepcion_funcionabilidad_familiar;
        $tabla->cuidador_principal = $cuidador_principal;
        $tabla->sobrecarga_cuidador = $sobrecarga_cuidador;
        $tabla->mapa_relaciones_recursos = $mapa_relaciones_recursos;
        $tabla->cuidador_principal_nombre = $cuidador_principal_nombre;
        $tabla->imagen_vivienda = $imagen_vivienda;
        $tabla->otro_tipo_vivienda = $otro_tipo_vivienda;
        $tabla->otro_tenencia_vivienda = $otro_tenencia_vivienda;
        $tabla->otro_material_paredes = $otro_material_paredes;
        $tabla->otro_material_piso = $otro_material_piso;
        $tabla->otro_material_techo = $otro_material_techo;
        $tabla->otro_cerca_vivienda = $otro_cerca_vivienda;
        $tabla->otro_acceso_vivienda = $otro_acceso_vivienda;
        $tabla->otro_desplazamiento_familia = $otro_desplazamiento_familia;
        $tabla->otro_fuente_agua = $otro_fuente_agua;
        $tabla->otro_tratamiento_agua = $otro_tratamiento_agua;
        $tabla->otro_frecuencia_lavado_tanque = $otro_frecuencia_lavado_tanque;
        $tabla->otro_sistema_excretas = $otro_sistema_excretas;
        $tabla->otro_sistema_aguas_residuales = $otro_sistema_aguas_residuales;
        $tabla->otro_disposicion_residuos = $otro_disposicion_residuos;
        $tabla->otro_implementos_disposicion = $otro_implementos_disposicion;
        $tabla->otro_fuente_energia = $otro_fuente_energia;
        $tabla->otro_animales_conviven = $otro_animales_conviven;
        $tabla->otro_vectores_presentes = $otro_vectores_presentes;
        $tabla->otro_animales_venenosos_presentes = $otro_animales_venenosos_presentes;
        $tabla->otro_disposicion_residuos_aseo = $otro_disposicion_residuos_aseo;
        $tabla->otro_disposicion_residuos_peligrosos = $otro_disposicion_residuos_peligrosos;
        $tabla->otro_sintomas_menores_5 = $otro_sintomas_menores_5;
        $tabla->otro_sintomas_mayores_5 = $otro_sintomas_mayores_5;
        $tabla->latitud = $latitud;
        $tabla->longitud = $longitud;
        $tabla->nombre_nucleo = $nombre_nucleo;


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
