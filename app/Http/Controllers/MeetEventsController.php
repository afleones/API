<?php

namespace App\Http\Controllers;

use App\Models\MeetEvent;
use App\Models\MeetGuestsEvent;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
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

        // Obtener el ID del registro de la primera tabla
        $eventId = $event->getKey();

        $guestsEvent = new MeetGuestsEvent();
        $guestsEvent->eventId = $eventId;
        $guestsEvent->guestId = $data['guestId'];
        $guestsEvent->userId = $data['userId'];
        $guestsEvent->status = $data['status'] ?? 1;

        // Guardamos el objeto en la base de datos
        $guestsEvent->save();

        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'evento creado exitosamente',
        'event'=> $event,
        'guestsEvent'=> $guestsEvent]);
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'usuarios asignados correctamente']);
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
                $query->where('id', $data['id']);
            }
            if (isset($data['userId'])) {
                $query->where('userId', $data['userId']);
            }
            if (isset($data['title'])) {
                $query->where('title', $data['title']);
            }
        })->where('status', '!=', 0)->get();
        
        $dataArray = $event;
        return $dataArray;
    }         
    //     $event = MeetEvent::where(function($query) use ($data) {
    //         if (isset($data['id'])) {
    //             $query->Where('id', $data['id']);
    //         }
    //         if (isset($data['userId'])) {
    //             $query->Where('userId', $data['userId']);
    //         }
    //         if (isset($data['title'])) {
    //             $query->Where('title', $data['title']);
    //         }
    //         if (isset($data['status'])) {
    //             $query->where('status', 0);
    //         }
    //         })->get();  
    
    //     $dataArray = ($event);                                     
    //     return $dataArray;
    // }
}
