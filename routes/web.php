<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LagoController;
use App\Http\Controllers\EspecieController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ReproduccionController;
use App\Http\Controllers\Admin\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'rol:administrador'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::resource('usuarios', UserController::class)
        ->parameters(['usuarios' => 'user'])
        ->only(['index', 'create', 'store', 'show', 'edit', 'update'])
        ->names('admin.users');
    Route::patch('usuarios/{user}/toggle-status', [UserController::class, 'toggleStatus'])
        ->name('admin.users.toggle-status');
});

Route::middleware(['auth', 'rol:trabajador'])->prefix('trabajador')->group(function () {
    Route::get('/dashboard', function () {
        return view('trabajador.dashboard');
    })->name('trabajador.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('lagos', LagoController::class);
    Route::resource('especies', EspecieController::class);
    Route::resource('ventas', VentaController::class);
    Route::resource('reportes', ReporteController::class);
    Route::resource('reproducciones', ReproduccionController::class);
});

require __DIR__ . '/auth.php';
