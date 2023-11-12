<?php

namespace App\Http\Controllers\AutoSchedule;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AutoSchedule\Doctor;

class DoctorsController extends Controller
{
    public function showDoctors(Request $request)
    {
        $doctors = Doctor::all();

        // Devuelve los doctores como una respuesta JSON
        return response()->json(['message' => 'Medicos', 'doctors' => $doctors]);

    }
}
