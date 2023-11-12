<?php

namespace App\Http\Controllers\AutoSchedule;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AutoSchedule\specialty;

class SpecialtiesController extends Controller
{
    public function showSpecialties(Request $request)
    {
        $Specialties = specialty::all();

        // Devuelve los doctores como una respuesta JSON
        return response()->json(['message' => 'Listado de Especialidades', 'Especialidades' => $Specialties]);

    }

}
