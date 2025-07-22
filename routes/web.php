<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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
});

// Route::get('/dashboard', function () {
//     $user = Auth::user();

//     if ($user->hasRole('admin')) {
//         return redirect()->route('admin.dashboard');
//     } elseif ($user->hasRole('operator')) {
//         return redirect()->route('operator.dashboard');
//     } elseif ($user->hasRole('user')) {
//         return redirect()->route('user.dashboard');
//     }

//     // fallback
//     abort(403, 'Role not assigned.');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/admin/dashboard', function () {
//         return view('dashboard.admin');
//     })->name('admin.dashboard');
// });

// Route::middleware(['auth', 'role:operator'])->group(function () {
//     Route::get('/operator/dashboard', function () {
//         return view('dashboard.operator');
//     })->name('operator.dashboard');
// });

// Route::middleware(['auth', 'role:user'])->group(function () {
//     Route::get('/user/dashboard', function () {
//         return view('dashboard.user');
//     })->name('user.dashboard');
// });


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
