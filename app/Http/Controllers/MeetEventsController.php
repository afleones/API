<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MeetEvent;

class MeetEventsController extends Controller
{
    public function store(Request $request)
    {

        $data = $request->all();

        $event = new MeetEvent();
        $event->title = $data['title'];
        $event->description = $data['description'] ?? '';
        $event->start = $data['start'];
        $event->end = $data['end'];
        $event->url = $data['url'];
                       
        // Guardamos el objeto en la base de datos
        $event->save();
          
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'Datos insertados correctamente', 'event' => $event], 201);
    }

}
