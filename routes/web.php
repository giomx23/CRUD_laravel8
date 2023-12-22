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
//Auth::routes(['register'=>false,'reset'=>false]); //para quitar el resgistrado y el olvidar contraseña

Route::get('/home', [EmpleadoController::class, 'index'])->name('home');

Route::group(['middleware'=>'auth'],function(){
    Route::get('/', [EmpleadoController::class, 'index'])->name('home');
});