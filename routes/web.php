<?php

use App\Http\Controllers\Admin\MenuCrudController;
use App\Http\Controllers\Admin\UserCrudController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DataTable\DataTableController;
use App\Http\Controllers\Kasir\TransaksiCrudController;
use App\Http\Controllers\Route\RouteController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

# ------ Index ------ #
Route::get('/', [AuthenticatedSessionController::class, 'create']);

# ------ Authentication ------ #
require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::middleware('isAdmin')->group(function(){
        # ------ User CRUD ------ #
        Route::resource('users', UserCrudController::class);
    });

    
    # ------ Menu CRUD ------ #
    Route::resource('menus', MenuCrudController::class);

    # ------ Transaksi CRUD ------ #
    Route::resource('transaksis', TransaksiCrudController::class);
    
    # ------ DataTable ------ #
    Route::name('data.')->group(function(){
        # ------ User List ------ #
        Route::get('/get-users', [DataTableController::class, 'dataPengguna'])->name('users');
        Route::get('/get-menus', [DataTableController::class, 'dataMenu'])->name('menus');
        Route::get('/get-transaksis', [DataTableController::class, 'dataTransaksi'])->name('transaksis');
        Route::get('/get-activities', [DataTableController::class, 'dataAktivitas'])->name('activities');
    });

    # ------ Dashboard ------ #
    Route::get('/dashboard', [RouteController::class, 'home'])->name('home');

    # ------ Activites ------ #
    Route::get('/profile/activities', [RouteController::class, 'myActivities'])->name('profile.activities');
});
