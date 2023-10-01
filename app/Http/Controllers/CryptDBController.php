<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Utils\DatabaseUtils;


class CryptDBController extends Controller
{
    public function KryptDB()
    {
        $DBName = DB::connection('maite')->getDatabaseName();
        // $encryptedDBName = Crypt::encryptString($DBName);
        $encryptedDBName = DatabaseUtils::enkryptString();
        return response()->json([
            'KryptDB' => $encryptedDBName
        ], 200);
    }
}
