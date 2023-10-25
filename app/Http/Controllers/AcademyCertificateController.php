<?php

namespace App\Http\Controllers;

use App\Models\AcademyCertificate;

use Illuminate\Http\Request;

class AcademyCertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Class = AcademyCertificate::selectRaw("id,
        CustomTitle,
        CursoId,
        ExamId,
        created_at,
        updated_at
        ")->get();
        return $Class;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        

        // Ejemplo de cómo podrías crear un nuevo recurso:
        $newResource = new AcademyCertificate();
        $newResource->CustomTitle = $request->input('CustomTitle');
        $newResource->CursoId = $request->input('CursoId');
        $newResource->ExamId = $request->input('ExamId');
        $newResource->save();

        //return response()->json($newResource, 201); // Devuelve una respuesta JSON con el nuevo recurso y el código de estado 201 (creado).
        $insertedId = $newResource->Id;
        return response()->json(['message' => 'Datos insertados correctamente', 'inserted_id' => $insertedId]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Aquí debes implementar la lógica para mostrar un recurso específico
        $resource = AcademyCertificate::find($id);

        if (!$resource) {
            return response()->json(['message' => 'Recurso no encontrado'], 404);
        }

        return response()->json($resource, 200); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
{
    // Obtén los datos de la solicitud
    $data = $request->all();

    try {
        // Encuentra el recurso por su ID
        $resource = AcademyCertificate::where('Id', $data['Id'])->first();

        if (!$resource) {
            return response()->json(['error' => 'Recurso no encontrado'], 404);
        }

        // Actualiza los campos con los datos de la solicitud
        $resource->CustomTitle = $data['CustomTitle'];
        $resource->CursoId = $data['CursoId'];
        $resource->ExamId = $data['ExamId'];

        // Guarda los cambios en la base de datos
        $resource->save();

        return response()->json(['message' => 'Datos actualizados correctamente']);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error al actualizar los datos: ' . $e->getMessage()], 500);
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
