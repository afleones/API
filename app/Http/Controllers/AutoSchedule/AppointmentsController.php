<?php

namespace App\Http\Controllers\AutoSchedule;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\AutoSchedule\Appointment;

class AppointmentsController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        // Validación de datos para la cita médica
        $validator = Validator::make($data, [
            'Codigo_CIT' => 'required|string|max:10',
            'Codigo_AGE' => 'required|string|max:10',
            'Codigo_TER' => 'required|string|max:10',
            'TerceroEPS_CIT' => 'required|string|max:10',
            'Fecha_AGE' => 'required|date',
            'Hora_AGE' => 'required|date_format:H:i:s',
            'Codigo_TAH' => 'required|string|max:1',
            'FechaDeseada_CIT' => 'required|date',
            'FechaGraba_CIT' => 'required|date',
            'TipoConsulta_CIT' => 'required|string|max:1|in:1,C',
            'Codigo_USR' => 'required|string|max:4',
            'Estado_CIT' => 'required|string|max:1|in:P,X,R',
            'Codigo_MTC' => 'required|int',
            'NotaCancela_CIT' => 'nullable|string|max:100',
            'Confirma_CIT' => 'required|string|max:1|in:0,1',
            'FechaConf_CIT' => 'nullable|datetime',
            'UsuarioConf_CIT' => 'nullable|string|max:4',
            'Nota_CIT' => 'required|string|max:60',
            'Atiende_CIT' => 'required|string|max:1|in:0,1',
            'FechaAtiende_CIT' => 'nullable|datetime',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Crear una nueva cita médica
        $appointment = new Appointment();
        $appointment->Codigo_CIT = $data['Codigo_CIT'];
        $appointment->Codigo_AGE = $data['Codigo_AGE'];
        $appointment->Codigo_TER = $data['Codigo_TER'];
        $appointment->TerceroEPS_CIT = $data['TerceroEPS_CIT'];
        $appointment->Fecha_AGE = $data['Fecha_AGE'];
        $appointment->Hora_AGE = $data['Hora_AGE'];
        $appointment->Codigo_TAH = $data['Codigo_TAH'];
        $appointment->FechaDeseada_CIT = $data['FechaDeseada_CIT'];
        $appointment->FechaGraba_CIT = $data['FechaGraba_CIT'];
        $appointment->TipoConsulta_CIT = $data['TipoConsulta_CIT'];
        $appointment->Codigo_USR = $data['Codigo_USR'];
        $appointment->Estado_CIT = $data['Estado_CIT'];
        $appointment->Codigo_MTC = $data['Codigo_MTC'];
        $appointment->NotaCancela_CIT = $data['NotaCancela_CIT'] ?? null;
        $appointment->Confirma_CIT = $data['Confirma_CIT'];
        $appointment->FechaConf_CIT = $data['FechaConf_CIT'] ?? null;
        $appointment->UsuarioConf_CIT = $data['UsuarioConf_CIT'] ?? null;
        $appointment->Nota_CIT = $data['Nota_CIT'];
        $appointment->Atiende_CIT = $data['Atiende_CIT'];
        $appointment->FechaAtiende_CIT = $data['FechaAtiende_CIT'] ?? null;

        // Guardar la cita médica en la base de datos
        $appointment->save();

        return response()->json(['message' => 'Cita médica creada con éxito', 'appointment' => $appointment]);
    }
}
