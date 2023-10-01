<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class DashBoardController extends Controller
{
    public function dash_monthly_sales()
    {
        $sales = DB::connection('maite')->table('view_dash_monthly_sales')->get();

        // Reemplazar los números de mes con nombres en español utilizando Carbon
        foreach ($sales as $sale) {
            $date = Carbon::createFromDate($sale->anio, $sale->mes, 1);
            $sale->mes = $date->locale('es')->monthName;
        }

        return response()->json([
            'dash_monthly_sales' => $sales
        ]);
    }
    
}
