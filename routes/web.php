<?php

use App\Exports\UsersExport;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DatatableController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\UserController;
use App\Models\Estado;
use App\Models\Tarea;
use Illuminate\Support\Facades\Route;

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









Auth::routes();



Route::get('/export',[HomeController::class, 'export'])->name('export');


Route::post('/generar',[HomeController::class, 'generar'])->name('generar');


Route::get('/about', 'App\Http\Controllers\homeController@about');

Route::resource('exportacion',App\Http\Controllers\ExportController::class );




//Route::get('home', [HomeController::class, 'index'])->name('home');
Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth');



Route::get('/', function () {
    return redirect('login');
});
Route::get('historialAdm/{id}', [App\Http\Controllers\HistorialFecha::class, 'show'])->name('historialAdm');


Route::resource('admiIndex',App\Http\Controllers\AdministradorController::class )->middleware('auth');

route::get('/homeAdministrador', [App\Http\Controllers\AdministradorController::class, 'index'])->name('homeAdministrador');

Route::resource('historialFecha',App\Http\Controllers\HistorialFecha::class )->middleware('auth');


Route::POST('ActualizarFecha',[App\Http\Controllers\HistorialFecha::class , 'update'] )->name('ActualizarFecha')->middleware('auth');

Route::POST('ActualizarTarea',[App\Http\Controllers\HistorialFecha::class , 'ActualizarTarea'] )->name('ActualizarTarea')->middleware('auth');



//Route::GET('ActualizarFecha',[App\Http\Controllers\HistorialFecha::class , 'update'] )->name('ActualizarFecha')->middleware('auth');


route::put('/historialActualizar/{id}', [App\Http\Controllers\HistorialFecha::class, 'update'])->name('historialActualizar');

route::get('/administrador', [App\Http\Controllers\HomeController::class, 'administrador'])->name('administrador');
Route::resource('CreateAdmi',App\Http\Controllers\CreateAdmi::class )->middleware('auth');

route::get('/homeAdmi', [App\Http\Controllers\CreateAdmi::class, 'index'])->name('homeAdmi');

route::get('/admin', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin');


Route::put('/home/{$id}', [App\Http\Controllers\HomeController::class, 'update'])->middleware('auth');

Route::resource('home',App\Http\Controllers\HomeController::class )->middleware('auth');

Route::resource('post',App\Http\Controllers\ValidarController::class );
route::get('post', [App\Http\Controllers\ValidarController::class, 'store'])->name('post');

route::post('actualizar/{$id}', [App\Http\Controllers\HomeController::class, 'actualizar'])->name('actualizarr');
route::patch('actualizar/{$id}', [App\Http\Controllers\HomeController::class, 'actualizar'])->name('actualizarr');

Route::resource('actualizarTecnico',App\Http\Controllers\ActualizarTecnico::class );

Route::resource('areas',App\Http\Controllers\AreaController::class )->middleware('auth');
Route::resource('estados',App\Http\Controllers\EstadoController::class )->middleware('auth');
Route::resource('users',App\Http\Controllers\UserController::class );
Route::resource('historials',App\Http\Controllers\HistorialController::class )->middleware('auth');
Route::resource('tareas',App\Http\Controllers\TareaController::class )->middleware('auth');
route::get('tabla', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

Route::get('/ListarTareaUsuario', [App\Http\Controllers\DatatableController::class, 'ListarTareaUsuario'])->name('ListarTareaUsuario');


Route::get('/TareasFiltradas', [App\Http\Controllers\DatatableController::class, 'TareasFiltradas'])->name('TareasFiltradas');


Route::get('/index', [App\Http\Controllers\UserController::class, 'datatable'])->name('tabla');

Route::get('/tabla2', [App\Http\Controllers\DatatableController::class, 'tabla2'])->name('tabla2');
Route::get('/tabla3', [App\Http\Controllers\DatatableController::class, 'tabla3'])->name('tabla3');
Route::get('/listarTareas',[App\Http\Controllers\TareaController::class, 'listarTareas'])->name('listarTareas');
Route::get('/listaEstados',[App\Http\Controllers\EstadoController::class, 'listaEstados'])->name('listaEstados');
Route::get('/listAreas',[App\Http\Controllers\AreaController::class, 'listAreas'])->name('listAreas');
Route::resource('superAdm',App\Http\Controllers\SuperAdministrador::class );
Route::get('/superAdm', [App\Http\Controllers\SuperAdministrador::class, 'superAdm'])->name('superAdm');
Route::get('/datatabless',[App\Http\Controllers\SuperAdministrador::class, 'datatabless'])->name('datatabless');





/*
listAreas
Route::resource('tareas',App\Http\Controllers\TareaController::class );

Route::get('tareas', [TareaController::class, 'index'])->name('tareas')->middleware('auth');



Route::get('users', [UserController::class, 'index'])->name('users.index');



//



Route::resource('home',App\Http\Controllers\EstadoController::class );

/*Route::get('/area', function () {
    return view('area.index');
});*/
/*

Route::get('/register',[RegisterController::class, 'create'])->middleware('auth');



// Ruta para actualizar una tarea (POST)

// Ruta para mostrar la página principal (GET)
Route::get('/tareas', [App\Http\Controllers\TareaController::class, 'index'])->middleware('auth');

Route::get('/estados', [App\Http\Controllers\EstadoController::class, 'index'])->middleware('auth');




/*
route::get('tarea/{$id}/edit', [HomeController::class,'edit'])->name('tarea.edit');
Route::resource('/home',App\Http\Controllers\HomeController::class );
*/