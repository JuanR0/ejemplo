<?php

use App\Http\Controllers\TareaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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
    return view('welcome');
});

Route::resource('/tarea', TareaController::class);
// Route::get('/tareas', [TareasController::class, 'index']);
// Route::get('/tareas/create', [TareasController::class, 'create']);
// Route::post('/tareas/store', [TareasController::class, 'store']); 

Route::get('/hola_mundo/{nombre}/{aa?}', function ($nombre, $aa = null) {
    return view('paginas.hola_mundo',compact('nombre', 'aa'))
    ->with([
        'nombre' => $nombre,
        'apellido' => 'perez'

    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('bienvenida', function(){
    return view('bienvenida');
});

Route::get('contacto', function(){
    return view('contacto');
});