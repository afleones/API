<?php

namespace App\Http\Controllers;

use App\Models\AcademyClass;
use Illuminate\Http\Request;

class AcademyClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Class = AcademyClass::selectRaw("id,
                                    Title,
                                    Author,
                                    Image,
                                    CourseId,
                                    Video,
                                    Description
        ")->get();
        return $Class;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        
        // Creamos un nuevo objeto del modelo
        $Class = new AcademyClass();

        // Asignamos los datos a las propiedades del objeto
        $Class->Title= $data['Title'];
        $Class->Author= $data['Author'];
        $Class->Image= $data['Image'];
        $Class->CourseId= $data['CourseId'];
        $Class->Video= $data['Video'];
        $Class->Description= $data['Description'];


        // Guardamos el objeto en la base de datos
        $Class->save();
    
    
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'Datos insertados correctamente']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $data = $request->all();   
              

        $Class = AcademyClass::where(function($query) use ($data) {
                            if (isset($data['id'])) {
                                $query->Where('id', $data['id']);
                            }
                         })
                         ->get();     

                                         
        
        return $Class;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AcademyClass $AcademyClass)
    {
        $data = $request->all();
        $Id = $data['Id'];
        $Title = $data['Title'] ?? '';
        $Author = $data['Author'] ?? 0;
        $Image = $data['Image'] ?? 0;
        $CourseId = $data['CourseId'] ?? 0;
        $Video = $data['Video'] ?? '';
        $Description = $data['Description'] ?? '';
        
        try {
            AcademyClass::where('id', $Id)->update([
                'Title' => $Title,
                'Author' => $Author,
                'Image' => $Image,
                'CourseId' => $CourseId,
                'Video' => $Video,
                'Description' => $Description
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
}
