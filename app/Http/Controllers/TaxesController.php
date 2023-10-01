<?php

namespace App\Http\Controllers;

use App\Models\taxes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaxesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $taxes=taxes::all();
        return $taxes;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'taxname' => 'required',
            'type' => 'required',
            'percent' => 'required',
            'active' => 'required'
        ]);
        $taxes = new taxes;
        $taxes->taxname = $request->taxname;
        $taxes->type = $request->type;
        $taxes->percent = $request->percent;
        $taxes->id_accountsv = $request->id_accountsv;
        $taxes->id_accountsc = $request->id_accountsc;
        $taxes->active = $request->active;
        
        // buscar usuario existente por nick y eliminarlo
        $existingTax = taxes::where('taxname', $taxes->taxname)->first();
        if ($existingTax) {
            $existingTax->delete();
        }
        $taxes->save();

        return $taxes;
    }

    /**
     * Display the specified resource.
     */
    public function list(taxes $taxes)
    {
        $taxes = taxes::selectRaw("taxname as nameTax, type as typeTax, percent as percentage, description")->get();
        return $taxes;
    }

    public function show($idtax)
    {
        $sql = "SELECT * FROM taxes Where id= '".$idtax."'";
        $taxesid = DB::select($sql);
        return $taxesid;
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, taxes $taxes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(taxes $taxes)
    {
        //
    }
}
