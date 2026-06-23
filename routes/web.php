<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LagoController;
use App\Http\Controllers\MonitoreoController;
use App\Http\Controllers\EspecieController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ReproduccionController;
use App\Http\Controllers\RecomendacionController;
use App\Http\Controllers\Admin\UserController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Both roles: dashboard + ventas (solo index/show)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $totalEspecies = \App\Models\Especie::count();
        $totalLagos = \App\Models\Lago::count();
        $totalReproducciones = \App\Models\Reproduccion::count();
        $ventasHoy = \App\Models\Venta::whereDate('fecha_venta', today())->sum('total');
        $ventasMes = \App\Models\Venta::whereMonth('fecha_venta', now()->month)->whereYear('fecha_venta', now()->year)->sum('total');
        $ventasTotales = \App\Models\Venta::sum('total');
        $ventasRecientes = \App\Models\Venta::with('especie')->latest()->take(5)->get();
        $totalEspeciesStock = \App\Models\Especie::sum('cantidad');
        $totalUsuarios = \App\Models\User::count();
        $monitoreosMes = \App\Models\Monitoreo::whereMonth('fecha_monitoreo', now()->month)->count();
        $misVentasHoy = \App\Models\Venta::whereDate('fecha_venta', today())->count();
        $misVentasMes = \App\Models\Venta::whereMonth('fecha_venta', now()->month)->whereYear('fecha_venta', now()->year)->count();
        $ultimaVenta = \App\Models\Venta::latest()->first();

        return view('dashboard', compact(
            'totalEspecies', 'totalLagos', 'totalReproducciones',
            'ventasHoy', 'ventasMes', 'ventasTotales', 'ventasRecientes',
            'totalEspeciesStock', 'totalUsuarios', 'monitoreosMes',
            'misVentasHoy', 'misVentasMes', 'ultimaVenta'
        ));
    })->name('dashboard');

    Route::resource('ventas', VentaController::class)->only(['index', 'show']);
});

// Admin only: CRUD completo de ventas
Route::middleware(['auth', 'verified', 'rol:administrador'])->group(function () {
    Route::resource('ventas', VentaController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
});

// Auth routes (profile, for any authenticated user)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin only
Route::middleware(['auth', 'verified', 'rol:administrador'])->group(function () {
    Route::resource('especies', EspecieController::class)->parameters(['especies' => 'especie']);
    Route::resource('reproducciones', ReproduccionController::class)->parameters(['reproducciones' => 'reproduccion']);

    Route::get('reportes', [ReporteController::class, 'index'])->name('reportes.index');
    Route::post('reportes/preview', [ReporteController::class, 'preview'])->name('reportes.preview');
    Route::get('reportes/export-pdf/{tipo}', [ReporteController::class, 'exportPdf'])->name('reportes.export-pdf');
    Route::get('reportes/export-excel/{tipo}', [ReporteController::class, 'exportExcel'])->name('reportes.export-excel');

    Route::resource('lagos', LagoController::class)->names('lagos');
    Route::patch('lagos/{lago}/toggle-status', [LagoController::class, 'toggleStatus'])
        ->name('lagos.toggle-status');

    Route::get('monitoreos/seleccionar', [MonitoreoController::class, 'seleccionarLago'])
        ->name('monitoreos.seleccionar');
    Route::resource('lagos.monitoreos', MonitoreoController::class)->names('monitoreos');

    Route::get('recomendaciones', [RecomendacionController::class, 'index'])
        ->name('recomendaciones.index');
    Route::get('recomendaciones/{lago}', [RecomendacionController::class, 'show'])
        ->name('recomendaciones.show');
    Route::post('recomendaciones/generate', [RecomendacionController::class, 'generate'])
        ->name('recomendaciones.generate');
    Route::post('recomendaciones/{lago}/generate', [RecomendacionController::class, 'generateLake'])
        ->name('recomendaciones.generate-lake');

    Route::resource('admin/usuarios', UserController::class)
        ->parameters(['usuarios' => 'user'])
        ->only(['index', 'create', 'store', 'show', 'edit', 'update'])
        ->names('admin.users');
    Route::patch('admin/usuarios/{user}/toggle-status', [UserController::class, 'toggleStatus'])
        ->name('admin.users.toggle-status');
});

require __DIR__ . '/auth.php';
