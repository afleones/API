<?php

namespace App\Http\Controllers;

use App\Models\AcademyCategory;

use App\Models\AcademyCourse;
use App\Models\AcademyClass;

use Illuminate\Http\Request;

class AcademyCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Category = AcademyCategory::selectRaw("id,
                                    Title
        ")->get();
        return $Category;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        
        // Creamos un nuevo objeto del modelo
        $Category = new AcademyCategory();

        // Asignamos los datos a las propiedades del objeto
        $Category->Title= $data['Title'];
       


        // Guardamos el objeto en la base de datos
        $Category->save();
    
    
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'Datos insertados correctamente']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $data = $request->all();   
              

        $Category = AcademyCategory::where(function($query) use ($data) {
                            if (isset($data['id'])) {
                                $query->Where('id', $data['id']);
                            }
                         })
                         ->get();     

                                         
        
        return $Category;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->all();
        $Id = $data['Id'];
        $Title = $data['Title'] ?? '';
       
        
        try {
            AcademyCategory::where('id', $Id)->update([
                'Title' => $Title
                // Agrega otros campos que quieras actualizar aquí
            ]);
    
            // Actualización exitosa
            return response()->json(['message' => 'Datos actualizados correctamente']);
        } catch (\Exception $e) {
            // Error durante la actualización
            return response()->json(['error' => 'Error al actualizar los datos' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function showCoursexCategory(Request $request){
        //$data = $request->json()->all();
        $data = $request->all(); 

        //var_dump($data);exit();
        //$userid = $data['userid'];

        $Categories = AcademyCategory::
                         where(function($query) use ($data) {  
                            if (isset($data['Id'])) {
                                $query->Where('Id', $data['Id']);
                            }
                            /*
                            if (isset($data['userid'])) {
                                $query->Where('person.userid', $data['userid']);
                            }
                            if (isset($data['liderid'])) {
                                $query->Where('users.liderid', $data['liderid']);
                            }
                            if (isset($data['fecha1']) and isset($data['fecha2'])) {
                                $query->whereBetween(\DB::raw('DATE(person.created_at)'), [$data['fecha1'], $data['fecha2']]);
                            }
                            */
                         })
                         //->leftJoin('maite_backend.users', 'users.id', '=', 'person.userid')
                         ->selectRaw('Id,Title')

                         //->groupBy('person.userid', 'viviendaid', 'Creado')
                         ->get();

        
                         $payload = []; // Inicializa el arreglo de resultados

                        foreach ($Categories as $Category) {
                            $detalleCourses = AcademyCourse::where('CategoryId', $Category->Id)->get();
                            $coursesData = [];

                            foreach ($detalleCourses as $Course) {
                                $detalleClass = AcademyClass::where('CourseId', $Course->Id)->get();
                                $coursesData[] = [
                                    'Id' => $Course->Id,
                                    'Title' => $Course->Title,
                                    'Author' => $Course->Author,
                                    'Image' => $Course->Image,
                                    'Description' => $Course->Description,
                                    'CategoryId' => $Course->CategoryId,
                                    'classes' => $detalleClass
                                ];
                            }

                            $payload[] = [
                                'Id' => $Category->Id,
                                'Title' => $Category->Title,
                                'courses' => $coursesData
                            ];
                        }

        return $payload;
    }


}
