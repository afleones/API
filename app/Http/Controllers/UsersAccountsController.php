<?php

namespace App\Http\Controllers;

use App\Models\users_accounts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersAccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::selectRaw("
        id,
        codeuser,
        role,
        name,
        status,
        email,
        password,
        created_at,
        updated_at")->get();

        return $users;

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        
        // Creamos un nuevo objeto del modelo
        $user = new User();

        $user->codeuser = $data['codeuser'];
        $user->role = $data['role'];
        $user->name = $data['name'];
        $user->status = $data['status'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->userId = $data['userId'];

        // Guardamos el objeto en la base de datos
        $user->save();

        return response()->json(['message' => 'Datos insertados correctamente']);

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, User $user)
    {
        $data = $request->all(); 
        $codeuser = $data['codeuser'];

        $user = User::where('codeuser', $codeuser)->where(function($query) use ($data) {  
            if (isset($data['id'])) {
                $query->Where('id', $data['id']);
            }
            if (isset($data['role'])) {
                $query->Where('role', $data['role']);
            }
        })->get();

        $dataArray = $user;             
        return $dataArray;

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->all();
        //var_dump($data);exit();

        $id = isset($data['id']) ? $data['id'] : '';
        $codeuser = isset($data['codeuser']) ? $data['codeuser'] : '';
        $role = isset($data['role']) ? $data['role'] : '';
        $name = isset($data['role']) ? $data['role'] : '';
        $email = isset($data['email']) ? $data['email'] : '';
        $status = isset($data['status']) ? $data['status'] : '';
        $password = isset($data['password']) ? $data['password'] : '';

        $tabla = User::where('id', $id)->where('userId', $userId)->firstOrFail();

        $tabla->codeuser = $codeuser;
        $tabla->role = $role;
        $tabla->name = $name;
        $tabla->email = $email;
        $tabla->status = $status;
        $tabla->password = $password;

        $tabla->save();

        // Puedes retornar una respuesta o redireccionar a otra página
        return response()->json(['message' => 'Datos Actualizado correctamente']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $data = $request->json()->all();
        //var_dump($data);exit();
        $id = $data['id'];
        User::where('id', $id)->where('id', $id)->delete();
    
        return response()->json(['message' => 'Dato borrado correctamente']);

    }
}
