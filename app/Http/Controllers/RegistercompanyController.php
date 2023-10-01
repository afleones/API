<?php

namespace App\Http\Controllers;

use App\Models\registercompany;
use App\Models\customer;
use App\Models\software;
use App\Models\certificate;

use Illuminate\Http\Request;

class RegistercompanyController extends Controller
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
        $data = $request->json()->all();



        // Creamos un nuevo objeto del modelo
        $customer = new customer();

        $customer = customer::where('identification_number', $data['identification_number'])->first();
        //var_dump($customer);exit();

        if (!$customer) {

            $customer = new customer();

            // Asignamos los datos a las propiedades del objeto
            $customer->identification_number = $data['identification_number'];
            $customer->dv = $data['dv'];
            $customer->name = $data['name'];
            $customer->phone = $data['phone'];
            $customer->address = $data['address'];
            $customer->email = $data['email'];
            //$customer->password = ''; //$data['password'];
            //$customer->newpassword = ''; // $data['newpassword'];
            //$customer->created_at = $data['created_at'];
            //$customer->updated_at = $data['updated_at'];
            // ...

            // Guardamos el objeto en la base de datos
            $customer->save();


            $registercompany = new registercompany();

            $registercompany->id = $data['id'];
            $registercompany->user_id = $data['user_id'];
            $registercompany->identification_number = $data['identification_number'];
            $registercompany->dv = $data['dv'];
            $registercompany->razon = $data['name'];
            $registercompany->language_id = $data['language_id'];
            $registercompany->tax_id = $data['tax_id'];
            $registercompany->type_environment_id = $data['type_environment_id'];
            $registercompany->payroll_type_environment_id = $data['payroll_type_environment_id'];
            $registercompany->type_operation_id = $data['type_operation_id'];
            $registercompany->type_document_identification_id = $data['type_document_identification_id'];
            $registercompany->country_id = $data['country_id'];
            $registercompany->type_currency_id = $data['type_currency_id'];
            $registercompany->type_organization_id = $data['type_organization_id'];
            $registercompany->type_regime_id = $data['type_regime_id'];
            $registercompany->type_liability_id = $data['type_liability_id'];
            $registercompany->municipality_id = $data['municipality_id'];
            $registercompany->merchant_registration = $data['merchant_registration'];
            $registercompany->address = $data['address'];
            $registercompany->phone = $data['phone'];
            $registercompany->email = $data['email'];
            $registercompany->api_token = $data['token'];

            // Guardamos el objeto en la base de datos
            $registercompany->save();

            // Retornamos una respuesta de éxito
            return response()->json(['message' => 'Datos insertados correctamente']);
        }else{
            return response()->json(['message' => 'Datos ya han sido insertados']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(registercompany $registercompany)
    {
        
        $registercompany = registercompany::selectRaw("api_token
                                     ")->get();
        return $registercompany;
    }

    public function showcompany(registercompany $registercompany)
    {
        
        $showcompany = registercompany::all();
        return $showcompany;
    }

    public function showsoftware(registercompany $registercompany)
    {
        
        $showsoftware = software::all();
        return $showsoftware;
    }

    public function showcertificate(registercompany $registercompany)
    {
        
        $certificate = certificate::all();
        return $certificate;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, registercompany $registercompany)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(registercompany $registercompany)
    {
        //
    }
}
