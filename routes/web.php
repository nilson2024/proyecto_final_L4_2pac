<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\CategoriaController;

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

/*Route::get('/', function () {
    return view('welcome');
});
*/

Route::resource('publicacions', PublicacionController::class);
Route::resource('categorias', CategoriaController::class);


Route::post('publicacions/{id}/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');
Route::delete('comentarios/{id}', [ComentarioController::class, 'destroy'])->name('comentarios.destroy');


/*Route::get('/publicacions', [PublicacionController::class, 'index'])->name('publicacions.index');

Route::get('/publicacions/create', [PublicacionController::class, 'create'])- >name('publicacions.create');
Route::post('/publicacions', [PublicacionController::class, 'store'])->name('publicacions.store');

Route::get('/publicacions/{id}/edit', [PublicacionController::class, 'edit'])->name('publicacions.edit');
Route::put('/publicacions/{id}', [PublicacionController::class, 'update'])->name('publicacions.update');

Route::get('/publicacions/{id}/show', [PublicacionController::class, 'show'])->name('publicacions.show');

Route::delete('/publicacions/{publicacion}', [PublicacionController::class, 'destroy'])->name('publicacions.destroy');


Route::resource('categorias', CategoriaController::class);
Route::post('/comentarios/{publicacion}', [ComentarioController::class, 'store'])->name('comentarios.store');
Route::delete('/comentarios/{comentario}', [ComentarioController::class, 'destroy'])->name('comentarios.destroy');
*/