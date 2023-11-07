<?php

namespace App\Http\Controllers\Meet;

use App\Http\Controllers\Controller;
use App\Models\MeetEvent;
use App\Models\MeetGuestEvent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class MeetEventsController extends Controller
{

    /* Listar Eventos con sus respectivos invitados creados por userId*/
    public function index(Request $request)
    {
        $data = $request->all();
        $userId = $data['userId'];
        
        // Si la validación pasa, continúa con la consulta
        $events = MeetEvent::where(function ($query) use ($data) {
            // ... (tu lógica de búsqueda)
        })->where('status', '!=', 0)->with('meetGuestEvent')->get();
        
        // Inicializa un array para almacenar los datos de los eventos
        $eventData = [];
        
        $invitados = [];
    
        $events->each(function ($event) use (&$eventData, &$invitados) {
            // Agrega los datos del evento a un nuevo arreglo
            $meetData = $event->toArray();
            
            // Elimina el campo "meet_guest_event" del arreglo
            unset($meetData['meet_guest_event']);
            
            // Inicializa un array para los invitados del evento actual
            $invitadosEvento = [];
        
            foreach ($event->meetGuestEvent as $invitado) {
                $user = User::find($invitado->guestId);
                if ($user) {
                    // Agrega los invitados al array "invitadosEvento" con "guestId", "nombre" y "eventId"
                    $invitadosEvento[] = [
                        'guestId' => $invitado->guestId,
                        'nombre' => $user->name,
                        'eventId' => $event->id, // Agrega el eventId
                    ];
                }
            }
            
            // Agrega el array "invitadosEvento" al array "invitados"
            $invitados = array_merge($invitados, $invitadosEvento);
            
            // Agrega el array "meetData" al array de eventos
            $eventData[] = $meetData;
        });
        
        // Crea un arreglo final con "meet" y "invitados" en arrays separados
        $responseData = [
            'event' => $eventData,
            'guests' => $invitados,
        ];
        
        return response()->json($responseData);
    }
    
    /* Crear nuevo evento */
    public function store(Request $request)
    {
        $data = $request->all();
    
        // Validación de datos para el evento
        $validator = Validator::make($data, [
            'title' => 'required|string',
            'start' => 'required|date',
            'end' => 'required|date',
            'userId' => 'required|integer',
            'guestIds' => 'array', // Asegura que guestIds sea un arreglo
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
    
        // Crear un nuevo evento
        $event = new MeetEvent();
        $event->title = $data['title'];
        $event->description = $data['description'] ?? 'Sin Descripción';
        $event->start = $data['start'];
        $event->end = $data['end'];
        $event->url = $data['url'] ?? '';
        $event->status = $data['status'] ?? 1;
        $event->userId = $data['userId'];
    
        // Guardar el evento en la base de datos
        $event->save();
    
        // Obtener el ID del evento creado
        $eventId = $event->id;
    
        // Validación y creación de invitados
        if (isset($data['guestIds']) && is_array($data['guestIds'])) {
            foreach ($data['guestIds'] as $guestId) {
                // Crear un nuevo invitado
                $guest = new MeetGuestEvent();
                $guest->eventId = $eventId;
                $guest->guestId = $guestId;
                $guest->userId = $data['userId'];
                $guest->status = 1;
                $guest->notifyStatus = 1;
    
                // Guardar el invitado en la base de datos
                $guest->save();
    
                // Almacenar la relación en la tabla intermedia
                DB::table('testmeet000003.eventsMeetsGuests')->insert([
                    'eventId' => $eventId,
                    'meetGuestEventId' => $guest->id
                ]);
            }
        }
    
        return response()->json(['message' => 'Evento y invitados creados exitosamente']);
    }
    
    /* Actualizar nuevo evento */
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
	
    /* Mostrar solo los campos de los eventos */
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

    public function showguests(Request $request)
    {
        $data = $request->all();
    
        // Define las reglas de validación
        $rules = [
            'eventId' => 'required|integer', // Agrega regla de validación para eventId
        ];
    
        // Define mensajes de error personalizados si es necesario
        $messages = [
            'eventId.required' => 'No se proporcionó un eventId válido.', // Mensaje para eventId
            'eventId.integer' => 'El campo eventId debe ser un número entero.', // Mensaje para eventId
        ];
    
        // Crea un validador con las reglas y los mensajes personalizados
        $validator = Validator::make($data, $rules, $messages);
    
        // Verifica si la validación falla
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
    
        // Consulta los registros en meetGuestsEvents que coincidan con el eventId
        $guests = MeetGuestsEvent::where(function ($query) use ($data) {
            if (isset($data['eventId'])) { // Agrega condición para eventId
                $query->where('eventId', $data['eventId']); // Filtra por eventId
            }
        })->where('status', '!=', 0)->get();
    
        // Obtiene los nombres de los usuarios correspondientes a los guestId
        $userNames = [];
        foreach ($guests as $guest) {
            $user = User::where('id', $guest->guestId)->first(); // Suponiendo que 'userId' sea la columna que almacena el ID del usuario en la tabla 'users'
            if ($user) {
                $userNames[] = $user->name; // Suponiendo que 'name' sea el campo que almacena el nombre del usuario en la tabla 'users'
            }
        }
    
        return response()->json(['guests'=> $guests, 'userNames' => $userNames]);
    }
        
            
    public function notifyStatus(Request $request)
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
    
        // Obtén la fecha de inicio del mes actual.
        $fechaInicioMes = now()->startOfMonth()->format('Y-m-d');
    
        // Obtén la fecha de fin del mes actual.
        $fechaFinMes = now()->endOfMonth()->format('Y-m-d');
    
        // Realiza la consulta para obtener los datos de la tabla eventos (MeetEvent) que coincidan con guestId
        // y que tengan una fecha entre la fecha de inicio y la fecha de fin del mes actual.
        $events = MeetEvent::join('meetGuestsEvents', 'events.id', '=', 'meetGuestsEvents.eventId')
            ->where('meetGuestsEvents.guestId', $guestId)
            ->where('events.status', '!=', 0)
            ->whereBetween(\DB::raw('DATE(events.created_at)'), [$fechaInicioMes, $fechaFinMes])
            ->whereBetween(\DB::raw('DATE(meetGuestsEvents.created_at)'), [$fechaInicioMes, $fechaFinMes])
            ->where('meetGuestsEvents.notifyStatus', 1) // Agregar esta línea para filtrar por notifyStatus
            ->get();
        // Verifica si no se encontraron registros.
        if ($events->isEmpty()) {
            return response()->json(['message' => 'No se encontraron registros'], 404);
        }
    
        // Continúa con el procesamiento de los registros y la respuesta.
        // ...
        
        // Obtén los userId de los eventos.
        $eventUserCreator = $events->pluck('userId')->unique();
    
        // Consulta en la tabla 'users' para obtener el campo 'name' relacionado con los userId de los eventos.
        $userName = User::whereIn('id', $eventUserCreator)->pluck('name', 'id');
    
        // Agrega los nombres de usuarios a los eventos.
        $events = $events->map(function ($event) use ($userName) {
            $userId = $event->userId;
            $event->eventCreator = $userName->get($userId);
            return $event;
        });
        // Devuelve los resultados en formato JSON en un arreglo.
        return response()->json(['events' => $events]);
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
    
        // Obtén la fecha de inicio del mes actual.
        $fechaInicioMes = now()->startOfMonth()->format('Y-m-d');
    
        // Obtén la fecha de fin del mes actual.
        $fechaFinMes = now()->endOfMonth()->format('Y-m-d');
    
        // Realiza la consulta para obtener los datos de la tabla eventos (MeetEvent) que coincidan con guestId
        // y que tengan una fecha entre la fecha de inicio y la fecha de fin del mes actual.
        $events = MeetEvent::join('meetGuestsEvents', 'events.id', '=', 'meetGuestsEvents.eventId')
            ->where('meetGuestsEvents.guestId', $guestId)
            ->where('events.status', '!=', 0)
            ->whereBetween(\DB::raw('DATE(events.created_at)'), [$fechaInicioMes, $fechaFinMes])
            ->whereBetween(\DB::raw('DATE(meetGuestsEvents.created_at)'), [$fechaInicioMes, $fechaFinMes])
            ->get();
        // Verifica si no se encontraron registros.
        if ($events->isEmpty()) {
            return response()->json(['message' => 'No se encontraron registros para el mes actual.'], 404);
        }
    
        // Continúa con el procesamiento de los registros y la respuesta.
        // ...
        
        // Obtén los userId de los eventos.
        $eventUserCreator = $events->pluck('userId')->unique();
    
        // Consulta en la tabla 'users' para obtener el campo 'name' relacionado con los userId de los eventos.
        $userName = User::whereIn('id', $eventUserCreator)->pluck('name', 'id');
    
        // Agrega los nombres de usuarios a los eventos.
        $events = $events->map(function ($event) use ($userName) {
            $userId = $event->userId;
            $event->eventCreator = $userName->get($userId);
            return $event;
        });
        // Devuelve los resultados en formato JSON en un arreglo.
        return response()->json(['events' => $events]);
    }
    
    public function deleteNotification(Request $request, MeetEvent $id)
    {
        $data = $request->all();
        $id = $data['id'];
        $notifyStatus = $data['notifyStatus'];

                // Asegúrate de que notifyStatus sea requerido y sea un número entero igual a 0.
        $rules = [
            'notifyStatus' => 'required|integer|in:0',
        ];

        $validator = Validator::make(['notifyStatus' => $notifyStatus], $rules);

        if ($validator->fails()) {
            return response()->json(['error' => 'El campo notifyStatus no es válido.'], 400);
        }

        // Actualiza el campo 'notifyStatus' en la tabla 'MeetGuestsEvent' para los registros relacionados con el evento
        MeetGuestsEvent::where('id', $id)->update(['notifyStatus' => $data['notifyStatus']]);

        return response()->json(['message' => 'se ha eliminado la notificacion']);
    }

    // public function showEvents(Request $request)
    // {
    //     $data = $request->all();
    //     $userId = $data['userId'];
    
    //     // Si la validación pasa, continúa con la consulta
    //     $events = MeetEvent::where(function ($query) use ($data) {
    //         // ... (tu lógica de búsqueda)
    //     })->where('status', '!=', 0)->with('meetGuestEvent')->get();
    
    //     // Renombrar la relación a 'invitados' y obtener el guestId y el nombre de los usuarios
    //     $events = $events->map(function ($event) {
    //         $invitados = [];
    
    //         foreach ($event->meetGuestEvent as $invitado) {
    //             $user = User::find($invitado->guestId);
    //             if ($user) {
    //                 $invitados[] = [
    //                     'guestId' => $invitado->guestId,
    //                     'nombre' => $user->name,
    //                 ];
    //             }
    //         }
    
    //         // Eliminar la propiedad 'meet_guest_event' si no es necesaria
    //         unset($event->meetGuestEvent);
    
    //         // Agregar los invitados al objeto
    //         $event->invitados = $invitados;
    
    //         return $event;
    //     });
    
    //     return response()->json(['events' => $events]);
    // }                           
}
