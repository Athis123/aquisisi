<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Data\OrderController;

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

// Login Form
Route::get('/', [LoginController::class, 'index'])->name('login');

// Auth route
Route::prefix('auth')->as('auth.')->group(function () {
    Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// Administrator
Route::group(['middleware' => ['auth'],'prefix' => 'administrator', 'as' => 'admin.'], function(){

    // Dashboard
    Route::group(['namespace' => 'App\Http\Controllers\Dashboard','prefix' => 'dashboard', 'as' => 'dashboard.'], function(){
        Route::get('/','DashboardController@index')->name('index');
        Route::get('/tasks/priority-data','DashboardController@getTasksByPriority')->name('priority');
    });

        // Data
    Route::group(['namespace' => 'App\Http\Controllers\Data','prefix' => 'data', 'as' => 'data.'], function(){
        // Order
        Route::get('order', 'OrderController@index')->name('order.index');
        Route::get('order/create', 'OrderController@create')->name('order.create');
        Route::post('order', 'OrderController@store')->name('order.store');
        Route::get('order/{id}/edit', 'OrderController@edit')->name('order.edit');
        Route::put('/{id}', [OrderController::class, 'update'])->name('order.update');
    });

   // Personil
    Route::group(['middleware' => ['role:admin|operator'],'namespace' => 'App\Http\Controllers\Personil','prefix' => 'personil', 'as' => 'personil.'], function(){
        // Profil
        Route::get('profil','ProfilController@index')->name('profil.index');
        Route::get('profil/form','ProfilController@form')->name('profil.form');
        Route::put('profil/update','ProfilController@update')->name('profil.update');

        // User
        Route::resource('user',UserController::class);
    });
});
require __DIR__.'/auth.php';
