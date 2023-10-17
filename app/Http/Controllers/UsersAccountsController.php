<?php

namespace App\Http\Controllers;

use App\Models\users_accounts;
use App\Models\User;
use Illuminate\Http\Request;

class UsersAccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $data = $request->all();

        // Creamos un nuevo objeto del modelo
        $user = new User();

        // Asignamos los datos a las propiedades del objeto
        $user->codeuser = $data['codeuser'];
        $user->role = $data['role'];
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->status = $data['status'];
        $user->password = encrypt($data['password']);
        $user->userId = $data['userId'];
        //$account->created_at = now(); // Fecha y hora actual
        //$account->updated_at = now(); // Fecha y hora actual
        
        // Guardamos el objeto en la base de datos
        $user->save();

        return response()->json(['message' => 'User created']);

        /*
        $idreg = $user->id;

        $account = new accounts;
        $dbprefix ="maite";
        $dbsufix = 3;
        $id_plans = 1;
        $id_states = 1;
        $concatenado = $dbprefix . $dbsufix;

        // Asignar valores a los campos
        $account->codename = encrypt($concatenado); // Encriptar el campo codename
        $account->id_users = $idreg;
        $account->dbprefix = 'maite';
        $account->dbsuffix = 3;
        $account->id_plans = $id_plans;
        $account->id_states = $request->id_states;
        $account->created_at = now(); // Fecha y hora actual
        $account->updated_at = now(); // Fecha y hora actual

        // Guardar la entidad en la base de datos
        $account->save();

        return response()->json(['message' => 'account created']);
        */
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, User $user)
    {
       

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
   

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, User $user)
    {
    }
}
   
