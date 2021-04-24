<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;

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

/*
Route::get('/empleado', function () {
    return view('empleado.index');
});

//para acceder directamente a la vista create desde el controlador, que ya lo instancie arriba con el use app

Route::get('/empleado/create', [EmpleadoController::class,'create'] );
*/

//ahora hay un metodo para hacer todas los accesos automaticos a todas esas vistas
//desde el controlador webphp y es así

Route::resource('empleado', EmpleadoController::class)->middleware('auth');
//con esto ya no son necesarias las rutas d arriba comentadas
Auth::routes(['reset'=>false]);

Route::get('/home', [EmpleadoController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [EmpleadoController::class, 'index'])->name('home');

    
});
