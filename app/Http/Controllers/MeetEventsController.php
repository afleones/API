<?php

namespace App\Http\Controllers;

use App\Models\MeetEvent;
use App\Models\MeetGuestsEvent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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
        $event->description = $data['description'] ?? 'Sin Descripción';
        $event->start = $data['start'];
        $event->end = $data['end'];
        $event->url = $data['url'] ?? '';
        $event->status = $data['status'] ?? 1;
        $event->userId = $data['userId'];

        // Guardamos el objeto en la base de datos
        $event->save();

        // Obtener el ID del registro de la primera tabla
        $eventId = $event->getKey();

        $guestIds = $data['guestIds'];
        $userId = $data['userId'];

        // Crear registros en la tabla MeetGuestsEvent para cada guestId
        foreach ($guestIds as $guestId) {
            $guestsEvent = new MeetGuestsEvent();
            $guestsEvent->eventId = $eventId;
            $guestsEvent->guestId = $guestId;
            $guestsEvent->userId = $userId;
            $guestsEvent->status = 1;
            // Otros campos según tus necesidades
            // Guardamos el objeto en la base de datos
            $guestsEvent->save();
        }

        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'evento creado exitosamente']);
    }

        
        public function update(Request $request, MeetEvent $id)
    {
        $data = $request->all();
        $id = $data['id'];
        $userId = $data['userId'];

        // Obtener el evento a actualizar
        $event = MeetEvent::where('id', $id)->where('userId', $userId)->firstOrFail();

        $event->title = $data['title'] ?? $event->title;
        $event->description = $data['description'] ?? $event->description;
        $event->start = $data['start'] ?? $event->start;
        $event->end = $data['end'] ?? $event->end;
        $event->url = $data['url'] ?? $event->url;
        $event->status = $data['status'] ?? $event->status;

        $event->save();

        // Si necesitas actualizar otros registros relacionados, como MeetGuestsEvent, aquí es el lugar para hacerlo.
        // Elimina los registros existentes en MeetGuestsEvent para este evento
        MeetGuestsEvent::where('eventId', $id)->delete();

        // Crea registros en la tabla MeetGuestsEvent para cada guestId
        $guestIds = $data['guestIds'];
        $userId = $data['userId'];

        foreach ($guestIds as $guestId) {
            $guestsEvent = new MeetGuestsEvent();
            $guestsEvent->eventId = $id; // Usamos $id en lugar de $eventId
            $guestsEvent->guestId = $guestId;
            $guestsEvent->userId = $userId;
            $guestsEvent->status = 1;
            // Otros campos según tus necesidades
            // Guardamos el objeto en la base de datos
            $guestsEvent->save();
        }

        // Actualizar el campo 'status' en el modelo MeetGuestsEvent relacionado
        MeetGuestsEvent::where('eventId', $event->id)->update(['status' => $event->status]);

        return response()->json(['message' => 'Datos Actualizados correctamente']);
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

    public function showEvents(Request $request)
    {
        $data = $request->all();
    
        // Define las reglas de validación
        $rules = [
            'userId' => 'required|integer',
        ];
    
        // Define mensajes de error personalizados si es necesario
        $messages = [
            'userId.required' => 'No se proporciono un id de usuario valido.',
            'userId.integer' => 'El campo userId debe ser un número entero.',
        ];
    
        // Crea un validador con las reglas y los mensajes personalizados
        $validator = Validator::make($data, $rules, $messages);
    
        // Verifica si la validación falla
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
    
        // Si la validación pasa, continúa con la consulta
        $event = MeetEvent::where(function ($query) use ($data) {
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

        $guests = MeetGuestsEvent::where(function ($query) use ($data) {
            if (isset($data['userId'])) {
                $query->where('userId', $data['userId']);
            }
        })->where('status', '!=', 0)->get();

        return response()->json(['events' => $event, 'guests' => $guests]);

    }
            
    public function validarReunion(Request $request)
    {
        $data = $request->all();
    
        // Obtén el valor de guestId del request.
        $guestId = $data['guestId'];
    
        // Asegúrate de que guestId sea requerido y sea un número entero.
        $rules = [
            'guestId' => 'required|integer',
        ];
    
        $validator = Validator::make($data, $rules);
    
        if ($validator->fails()) {
            return response()->json(['error' => 'Los datos proporcionados no son válidos.'], 400);
        }
    
        // Realiza la consulta para obtener los datos de la tabla eventos (MeetEvent) que coincidan con guestId.
        $events = MeetEvent::join('meetGuestsEvents', 'events.id', '=', 'meetGuestsEvents.eventId')
            ->where('meetGuestsEvents.guestId', $guestId)
            ->where('events.status', '!=', 0)
            ->get();
    
        $eventUserCreator = $events->pluck('userId')->unique();
    
        // Consulta en la tabla 'users' usando los userId obtenidos de la consulta en $events.
        $user = User::where('id', $eventUserCreator)->get();
    
        // Devuelve los resultados en formato JSON en un array.
        return response()->json(['events' => $events, 'users' => $user]);
    }
            
}
