<?php

namespace App\Http\Controllers\Api;

// use App\Http\Controllers\Api\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\customer;
use App\Utils\DatabaseUtils;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

App::setLocale('es');

class AuthController extends Controller
{

    public function register(Request $request) {
        // Data validate
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);
        //User LogOn
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        //Response
        return response($user,Response::HTTP_CREATED);

    }

    public function login(Request $request) {
        $credentials= $request->validate([
            'email' =>['required','email'],
            'password' =>['required']
        ]);

        if(Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('token')->plainTextToken;
            $cookie = cookie('maite_token', $token, 60*24);
            // Cambiar la base de datos y enviar el token como parámetro
            DatabaseUtils::switchDatabase();
            $existCompany = customer::where('id', '1')->first();
            if ($existCompany) {
                $theCompany= $existCompany;
                //$theCompany="Company exists";
            } else {
                $theCompany="No Company";
            }
            return response(["token"=>$token, auth()->user(), "Company"=>$theCompany], Response::HTTP_OK)->withoutCookie($cookie);
        } else {
            return response(["message"=>"Credenciales Inválidas"], Response::HTTP_UNAUTHORIZED);
        }
    }
    
    public function userProfile(Request $request) {
        return response()->json([
            "message"=>"Ok",
            "userData"=>auth()->user()
        ], Response::HTTP_OK);
    }
    
    public function logOut() {
        $cookie = Cookie::forget('maite_token');
        return response(["message"=>"Log Out"], Response::HTTP_OK)->withCookie($cookie);
    }

    public function changePassword(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        // Verificar si la contraseña actual coincide
        if (Hash::check($request->current_password, $user->password)) {
            // Actualizar la contraseña
            $user->password = Hash::make($request->new_password);
            $user->save();

            return response(["message" => "Contraseña actualizada"], Response::HTTP_OK);
        } else {
            return response(["message" => "La contraseña actual no coincide"], Response::HTTP_UNAUTHORIZED);
        }
    }
    
    public function allUsers() {
        $users=User::all();
        return response()->json([
            "users"=>$users
        ]);
    }

    
}
