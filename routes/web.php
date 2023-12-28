<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use Illuminate\Support\Facades\Auth;


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
    return view('auth.login');
});

// Route::get('/empleado', function () {
//     return view('empleado.index');
// });

// Route::get('/empleado/create', [EmpleadoController::class, 'create']);

// Acceder de manera automatizada a las rutas que se desee
Route::resource('empleado', EmpleadoController::class)->middleware('auth');
Auth::routes();
//Auth::routes(['register'=>false,'reset'=>false]); //para quitar el registrado y el olvidar contraseña

Route::group(['middleware'=>'auth'],function(){
    Route::get('/', [EmpleadoController::class, 'index'])->name('home');
    Route::get('/obteneru', [EmpleadoController::class, 'getusers']);
    Route::get('obteneru/create', [App\Http\Controllers\EmpleadoController::class, 'create']);
    Route::post('obteneru', [App\Http\Controllers\EmpleadoController::class, 'store']);
    Route::get('obteneru/edit', [App\Http\Controllers\EmpleadoController::class, 'edit']);
    Route::put('datosactualizados', [App\Http\Controllers\EmpleadoController::class, 'update']);
    Route::delete("obteneru/{id}", [App\Http\Controllers\EmpleadoController::class, "destroy"]);
});