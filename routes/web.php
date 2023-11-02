<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\livingplaceController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');

   
});

//Route::get('/exportar', 'livingplaceController@export');
Route::get('exportar', [livingplaceController::class, 'export']);
Route::get('showLivingplacePerson', [livingplaceController::class, 'showLivingplacePerson']);
