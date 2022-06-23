<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;

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

Route::get('/', [EventController::class,'index'])->name('accueil');

Route::get('event/encours', [EventController::class,'indexCours'])->name('encours');

Route::get('event/termine', [EventController::class,'indexTermine'])->name('termine');

Route::post('event/{event}', [EventController::class,'supprimer'])->name('supprimer');

 Route::resource('event', EventController::class);



 Route::get('/user', [UserController::class,'index'])->name('user-list');

 


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
