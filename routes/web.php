<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\SaranaPrasaranaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
 */

// Route::get('/', function () {
//     return view('welcome');
// });
Route::post('/login ', 'AdminController@login')->name('Postlogin');
Route::get('/', 'AdminController@showFormLogin')->name('login');

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [App\Http\Controllers\AdminController::class, 'index'])->name('home');
    // Route::get('/home', function () {return view('home');});
    Route::get('logout', 'AdminController@logout')->name('logout');

    Route::get('/api', [PageController::class, 'index']);
    Route::post('/getRuangan', [RuanganController::class, 'getRuangAjax']);
    Route::post('/getSarpras', [SaranaPrasaranaController::class, 'getSarprasAjax']);
    Route::get('/room/{id}/show', [PageController::class, 'show']);

    Route::get('/register', [AdminController::class, 'register']);
    Route::post('users/register/setOpenCloseRegist', 'api\RegisterController@statement');

// CRUD Jadwal
    Route::get('/jadwal', 'JadwalController@index')->name('jadwal');
    Route::get('/jadwal/create', 'JadwalController@create')->name('jadwal.create');
    Route::post('/jadwal/create', 'JadwalController@store')->name('jadwal.store');
    Route::get('/jadwal/edit/{id}', 'JadwalController@edit')->name('jadwal.edit');
    Route::patch('/jadwal/edit/{id}', 'JadwalController@update')->name('jadwal.update');
    Route::delete('/jadwal/delete/{id}', 'JadwalController@destroy')->name('jadwal.destroy');

    Route::get('/users', 'UsersController@index')->name('users');
    Route::get('/users/create', 'UsersController@create')->name('users.create');
    Route::post('/users/create', 'UsersController@store')->name('users.store');
    Route::get('/users/edit/{id}', 'UsersController@edit')->name('users.edit');
    Route::patch('/users/edit/{id}', 'UsersController@update')->name('users.update');
    Route::delete('users/delete/{id}', 'UsersController@destroy')->name('users.destroy');

/*
|--------------------------------------------------------------------------
| Ruangan Routes
|--------------------------------------------------------------------------
 */
    Route::get('/ruangan', [RuanganController::class, 'index'])->name('ruangan.index');
    Route::get('/ruangan/create', [RuanganController::class, 'create'])->name('ruangan.create');
    Route::post('/ruangan', [RuanganController::class, 'store'])->name('ruangan.store');
    Route::get('/ruangan/{id}/edit', [RuanganController::class, 'edit'])->name('ruangan.edit');
    Route::patch('/ruangan/{id}', [RuanganController::class, 'update'])->name('ruangan.update');
    Route::delete('/ruangan/{id}', [RuanganController::class, 'destroy'])->name('ruangan.destroy');

/*
|--------------------------------------------------------------------------
| Sarana Prasarana Routes
|--------------------------------------------------------------------------
 */
    Route::get('/sarpras', [SaranaPrasaranaController::class, 'index'])->name('sarpras.index');
    Route::get('/sarpras/create', [SaranaPrasaranaController::class, 'create'])->name('sarpras.create');
    Route::post('/sarpras', [SaranaPrasaranaController::class, 'store'])->name('sarpras.store');
    Route::get('/sarpras/{id}/edit', [SaranaPrasaranaController::class, 'edit'])->name('sarpras.edit');
    Route::patch('/sarpras/{id}', [SaranaPrasaranaController::class, 'update'])->name('sarpras.update');
    Route::delete('/sarpras/{id}', [SaranaPrasaranaController::class, 'destroy'])->name('sarpras.destroy');

});
