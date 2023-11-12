<?php

namespace App\Http\Controllers\AutoSchedule;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AutoSchedule\Diary;

class DiariesController extends Controller
{
    public function showHours()
    {
        $diary = Diary::all();

        return response()->json(['message' => 'Horas', 'Agenda' => $diary]);
    }
}
