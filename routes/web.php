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
        Route::get('order/export', 'OrderController@exportExcel')->name('order.export');
        Route::get('order/{id}', 'OrderController@show')->name('order.show');
        Route::get('order/{id}/edit', 'OrderController@edit')->name('order.edit');
        Route::put('order/{id}', 'OrderController@update')->name('order.update');
        Route::delete('/order/{id}', [OrderController::class, 'destroy'])->name('order.destroy');
    });

        // Data Master
    Route::group(['middleware' => ['role:admin|operator'],'namespace' => 'App\Http\Controllers\Master','prefix' => 'master', 'as' => 'master.'], function(){
        //Master Promo
        Route::get('promo', 'MasterPromoController@index')->name('promo.index');
        Route::get('promo/create', 'MasterPromoController@create')->name('promo.create');
        Route::post('promo', 'MasterPromoController@store')->name('promo.store');
        Route::get('promo/{id}/edit', 'MasterPromoController@edit')->name('promo.edit');
        Route::put('promo/{id}', 'MasterPromoController@update')->name('promo.update');
        Route::delete('promo/{id}', 'MasterPromoController@destroy')->name('promo.destroy');

        //Master Sku
        Route::get('sku', 'MasterSkuController@index')->name('sku.index');
        Route::get('sku/create', 'MasterSkuController@create')->name('sku.create');
        Route::post('sku', 'MasterSkuController@store')->name('sku.store');
        Route::get('sku/{id}/edit', 'MasterSkuController@edit')->name('sku.edit');
        Route::put('sku/{id}', 'MasterSkuController@update')->name('sku.update');
        Route::delete('sku/{id}', 'MasterSkuController@destroy')->name('sku.destroy');
    });

   // Personil (PEGAWAI)
    Route::group(['middleware' => ['role:admin|operator'],'namespace' => 'App\Http\Controllers\Personil','prefix' => 'personil', 'as' => 'personil.'], function(){
        // Profil
        Route::get('profil','ProfileController@index')->name('profil.index');
        Route::get('profil/form','ProfileController@form')->name('profil.form');
        Route::put('profil/update','ProfileController@update')->name('profil.update');

        // User
        Route::resource('user',UserController::class);
    });
});
require __DIR__.'/auth.php';
