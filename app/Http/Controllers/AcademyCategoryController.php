<?php

namespace App\Http\Controllers;

use App\Models\AcademyCategory;
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
}
