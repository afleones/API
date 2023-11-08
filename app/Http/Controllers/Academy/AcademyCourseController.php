<?php

namespace App\Http\Controllers\Academy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Academy\AcademyCourse;

class AcademyCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Course = AcademyCourse::selectRaw("id,
                                    Title,
                                    Author,
                                    Image,
                                    Description,
                                    State
        ")->get();
        return $Course;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        
        // Creamos un nuevo objeto del modelo
        $Course = new AcademyCourse();

        // Asignamos los datos a las propiedades del objeto
        $Course->Title= $data['Title'];
        $Course->Author= $data['Author'];
        $Course->Image= $data['Image'];
        $Course->Description= $data['Description'];
        $Course->CategoryId= $data['CategoryId'];
        $Course->State= $data['State'];

        // Guardamos el objeto en la base de datos
        $Course->save();

        $insertedId = $Course->Id;
    
    
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'Datos insertados correctamente', 'inserted_id' => $insertedId]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $data = $request->all();   
              

        $Course = AcademyCourse::where(function($query) use ($data) {
                            if (isset($data['id'])) {
                                $query->Where('id', $data['id']);
                            }
                            if (isset($data['Author'])) {
                                $query->Where('Author', $data['Author']);
                            }
                            if (isset($data['State'])) {
                                $query->Where('State', $data['State']);
                            }
                            if (isset($data['CategoryId'])) {
                                $query->Where('CategoryId', $data['CategoryId']);
                            }
                         })
                         ->get();     

                                         
        
        return $Course;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AcademyCourse $AcademyCourse)
    {
        $data = $request->all();
        $Id = $data['Id'];
        $Title = $data['Title'] ?? '';
        $Author = $data['Author'] ?? 0;
        $Image = $data['Image'] ?? 0;
        $Description = $data['Description'] ?? '';
        $CategoryId = $data['CategoryId'] ?? '';
        $State = $data['State'] ?? 0;

        try {
            AcademyCourse::where('id', $Id)->update([
                'Title' => $Title,
                'Author' => $Author,
                'Image' => $Image,
                'Description' => $Description,
                'CategoryId' => $CategoryId,
                'State' => $State,
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
