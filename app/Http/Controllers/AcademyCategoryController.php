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
                                    Title,
                                    Author,
                                    State
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
        $Category->Author= $data['Author'];
        $Category->State= $data['State'];


        // Guardamos el objeto en la base de datos
        $Category->save();
    
        $insertedId = $Category->id;
    
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'Datos insertados correctamente', 'inserted_id' => $insertedId]);
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
                            if (isset($data['Author'])) {
                                $query->Where('Author', $data['Author']);
                            }
                            if (isset($data['State'])) {
                                $query->Where('State', $data['State']);
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
        $Author = $data['Author'] ?? 0;
        $State = $data['State'] ?? 0;
        
        
       
        
        try {
            AcademyCategory::where('id', $Id)->update([
                'Title' => $Title,
                'Author' => $Author,
                'State' => $State
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
                            if (isset($data['Author'])) {
                                $query->Where('Author', $data['Author']);
                            }
                            if (isset($data['State'])) {
                                $query->Where('State', $data['State']);
                            }

                         })
                         
                         ->selectRaw('Id,Title')

                         
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
                                    'State' => $Course->State,
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
