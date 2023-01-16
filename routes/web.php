<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('ventanilla');
});
Route::get('/empleado', function () {
    return view('empleado');
});

Route::get('/cliente', function () {
    return view('cliente');
});

// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::apiResource('/unit','UnitController');
Route::apiResource('/ticket','TicketController');
Route::post('/login','EmpleadoController@login');
Route::post('/atender','EmpleadoController@atender');
Route::post('/ultificha','EmpleadoController@ultificha');
Route::post('/datosatender','EmpleadoController@datosatender');

//Route::apiResource('/unit',\App\Http\Controllers\UnitController::class);
//Route::apiResource('/ticket',\App\Http\Controllers\TicketController::class);
//Route::post('/login',[\App\Http\Controllers\EmpleadoController::class,'login']);
//Route::post('/atender',[\App\Http\Controllers\EmpleadoController::class,'atender']);
//Route::post('/ultificha',[\App\Http\Controllers\EmpleadoController::class,'ultificha']);
//Route::post('/datosatender',[\App\Http\Controllers\EmpleadoController::class,'datosatender']);
