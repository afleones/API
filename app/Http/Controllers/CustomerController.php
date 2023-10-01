<?php

namespace App\Http\Controllers;

use App\Models\customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        
        // Creamos un nuevo objeto del modelo
        $customer = new customer();

        // Asignamos los datos a las propiedades del objeto
        $customer->identification_number = $data['numeroIdentificacion'];
        $customer->dv = $data['dv'];
        $customer->name = $data['razonSocial'];
        $customer->phone = $data['phone'];
        $customer->address = $data['address'];
        $customer->email = $data['emailTercero'];
        $customer->comercialname = $data['comercialname'];
        //$customer->password = ''; //$data['password'];
        //$customer->newpassword = ''; // $data['newpassword'];
        //$customer->created_at = $data['created_at'];
        //$customer->updated_at = $data['updated_at'];
        // ...

        // Guardamos el objeto en la base de datos
        $customer->save();
        

        /*
        customer::create([
        'identification_number' => "'" . $data['identification_number'] . "'",
        'dv' => "'" . $data['dv'] . "'"
        ]);
        */
    
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'Datos insertados correctamente']);
    }

    /**
     * Display the specified resource.
     */
    public function show(customer $customer)
    {
        //$customer=customer::all();
        $customer = customer::selectRaw("email,
                                        '' AS typeId,
                                        identification_number AS NumberId,
                                        dv AS DV,
                                        name AS RazonSocial,
                                        '' AS PrimerNombre,
                                        '' AS segundoNombre,
                                        '' AS PrimerApellido,
                                        '' AS SegundoApellido,
                                        address AS address,
                                        phone AS Telefono,
                                        '' AS TypePerson,
                                        '' AS RespoTribut
                                     ")->get();
        return $customer;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(customer $customer)
    {
        //
    }
}
