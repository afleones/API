<?php

namespace App\Http\Controllers\Api;

// use App\Http\Controllers\Api\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Users_accounts;
use App\Models\customer;
use App\Utils\DatabaseUtils;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

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
        //var_dump(Hash::make($credentials['password']));exit();
        if(Auth::attempt($credentials)) {
            $user = Auth::user();
            //var_dump($user);exit();
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

    public function store(Request $request,  User $user)
    {
        
        $data = $request->all();
        //var_dump($data);exit();

        // Creamos un nuevo objeto del modelo
        $user = new User();

        // Asignamos los datos a las propiedades del objeto
        $user->codeuser = isset($data['codeuser']) ? $data['codeuser'] : ''; 
        $user->role = $data['role'];
        $user->name = $data['name'];
        $user->status = $data['status'];
        $user->email = $data['email'];
        $user->password =  Hash::make($data['password']);
        $user->userId = $data['userId'];
        $user->liderid = $data['liderid'] ?? NULL;
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

    public function update(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];        
        //var_dump($data);exit();
        // Encuentra el registro que deseas actualizar basado en los criterios de consulta
        $user = User::where('id', $id)->first();
    
        // Verifica si se encontró el registro
        if (!$user) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
    
        // Actualiza los campos con los valores proporcionados en los datos
        $user->codeuser = isset($data['codeuser']) ? $data['codeuser'] : ''; 
        $user->role = $data['role'];
        $user->name = $data['name'];
        $user->status = $data['status'];
        $user->email = $data['email'];
        $user->password =  Hash::make($data['password']);
        $user->userId = $data['userId'];
        $user->liderid = $data['liderid']?? NULL;;

        // Guarda los cambios en la base de datos
        $user->save();
    
        return response()->json(['message' => 'Registro actualizado con éxito']);
    }  
}
