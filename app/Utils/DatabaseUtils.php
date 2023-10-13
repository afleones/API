<?php

namespace App\Utils;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use App\Models\accounts;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;


class DatabaseUtils
{
    public static function enkryptString()
    {
        if (auth()->check()) {
            $userid = auth()->user()->id;
            $account = accounts::where('id', $userid)->first();
            $kryptDB = $account->codename;
            if ($kryptDB=="") {
                $DBName = $account->dbprefix.str_pad($account->dbsufix, 6, '0', STR_PAD_LEFT);
                $encryptedDBName = Crypt::encryptString($DBName);
                $account->update(['codename' => $encryptedDBName]);
                $kryptDB = $encryptedDBName;
            }
            return $kryptDB;
        }
    }
    public static function switchDatabase()
    {
        // Guardar el valor de DB_DATABASE actual
        $originalDatabaseName = env('IVX_DATABASE');
        //var_dump($originalDatabaseName);


        // Buscamos la BD a la cual se conectará el usuario
        if (auth()->check()) {
            $userid = auth()->user()->id;
            

            $account = accounts::where('id', $userid)->first();

            /*
            $codename = $account->codename;
            var_dump(Crypt::encryptString('maite000003'));
            var_dump( Crypt::decryptString($codename));
            */

            //$databaseName = $account->dbprefix.str_pad($account->dbsufix, 6, '0', STR_PAD_LEFT);
            //var_dump($databaseName);
            $databaseName = $originalDatabaseName; //$account->dbprefix.str_pad($account->dbsufix, 6, '0', STR_PAD_LEFT);
            // dd($databaseName);
            // Cambiar el valor de IVX_DATABASE a la nueva base de datos
            putenv("IVX_DATABASE={$databaseName}");
            DB::purge('maite');
            $connectionConfig = Config::get("database.connections.maite");

            // Actualiza el valor de la base de datos en la configuración
            $connectionConfig['database'] = $databaseName;

            // Establece la nueva configuración en la conexión actual
            Config::set("database.connections.maite", $connectionConfig);
            // config(['database.connections.maite.database' => $databaseName]);
            DB::reconnect('maite');

            $databaseName2 = DB::connection('maite')->getDatabaseName();
            //dd($databaseName2);
               
        } else {
            // Usuario no autenticado
        }     
    }

    public static function sendmeCode($email)
    {
        // Generar código aleatorio de 6 dígitos
        $codigo = mt_rand(100000, 999999);
    
        // Actualizar el código en la tabla users
        User::where('email', $email)->update(['code_sent' => $codigo]);
    
        // Enviar el código al correo electrónico
        Mail::send('emails.verification_code', ['code' => $codigo], function ($message) use ($email) {
            $message->to($email)->subject('Codigo de seguridad maite');
        });
    }
}
