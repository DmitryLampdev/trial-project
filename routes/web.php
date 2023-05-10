<?php

use App\Http\Controllers\TenantController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::any('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user', [UserController::class, 'edit'])->name('user.edit');

    Route::get('/users/dashboard', [UserController::class, 'index'])->name('users/dashboard');

    Route::patch('/user/{id}', [UserController::class, 'update'])->name('user.update');

    Route::get('/tenants/change/{tenantId}', [TenantController::class, 'changeTenant'])->name('tenants.change');

    Route::resource('users', UserController::class);
});

require __DIR__.'/auth.php';
