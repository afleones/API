<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MeetEvent;
use Symfony\Component\HttpFoundation\Response;

class MeetEventsController extends Controller
{
    public function index(Request $request)
    {
        //
    }

    public function store(Request $request)
    {

        $data = $request->all();

        $event = new MeetEvent();
        $event->title = $data['title'];
        $event->description = $data['description'] ?? 'Sin Descripcion';
        $event->start = $data['start'];
        $event->end = $data['end'];
        $event->url = $data['url'] ?? '';
        $event->status = $data['status'] ?? 1;
        $event->userId = $data['userId'];
                       
        // Guardamos el objeto en la base de datos
        $event->save();
          
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'Datos insertados correctamente']);
    }
    
    public function update(Request $request, MeetEvent $id)
    {   
        $data = $request->all();
        $id = $data['id'];
        $userId = $data['userId'];

        // Obtener el evento a actualizar
        $tabla = MeetEvent::where('id', $id)->where('userId', $userId)->firstOrFail();

        $tabla->title = $data['title'] ?? $tabla->title;
        $tabla->description = $data['description'] ?? $tabla->description;
        $tabla->start = $data['start'] ?? $tabla->start; // Si no se proporciona, se usa el valor existente.
        $tabla->end = $data['end'] ?? $tabla->end; // Si no se proporciona, se usa el valor existente.;
        $tabla->url = $data['url'] ?? $tabla->url;
        $tabla->status = $data['status'] ?? $tabla->status;

        $tabla->save();

        return response()->json(['message' => 'Datos Actualizado correctamente']);
    }

    public function show(Request $request)
    {
        $data = $request->all();   
              
        $event = MeetEvent::where(function($query) use ($data) {
            if (isset($data['id'])) {
                $query->Where('id', $data['id']);
            }
            if (isset($data['userId'])) {
                $query->Where('userId', $data['userId']);
            }
            if (isset($data['title'])) {
                $query->Where('title', $data['title']);
            }
            if (isset($data['status'])) {
                $query->where('status', 0);
            }
            })->get();  
    
        $dataArray = ($event);                                     
        return $dataArray;
    }
}
