<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ActivoController;
use App\Http\Controllers\AlertaController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImpresoraController;

// --------------------------------------------------
// RUTAS PÚBLICAS
// --------------------------------------------------
Route::middleware('guest')->group(function () {
    Route::get('/login', fn() => view('login'))->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/', fn() => redirect()->route('login'));

// --------------------------------------------------
// RUTAS PRIVADAS - TODOS LOS USUARIOS AUTENTICADOS
// --------------------------------------------------
Route::middleware(['auth'])->group(function () {
    
    // Dashboard y páginas principales
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/inicio', [HomeController::class, 'index'])->name('home');
    
    // INVENTARIO/ACTIVOS - RUTAS DE LECTURA
    Route::get('/inventario', [ActivoController::class, 'index'])->name('inventario.index');
    Route::get('/activos', [ActivoController::class, 'index'])->name('activos.index'); // ← AGREGADA ESTA LÍNEA
    Route::get('/activos/{activo}', [ActivoController::class, 'show'])->name('activos.show');
    
    // Alertas (solo lectura para usuarios normales)
    Route::get('/alertas', [AlertaController::class, 'index'])->name('alertas.index');
    
    // Reportes (acceso para todos)
    Route::prefix('reportes')->name('reportes.')->group(function () {
        Route::get('/', [ReporteController::class, 'index'])->name('index');
        Route::get('/exportar', [ReporteController::class, 'exportar'])->name('export');
    });
});

// --------------------------------------------------
// RUTAS SOLO PARA ADMIN
// --------------------------------------------------
Route::middleware(['auth', 'role:admin'])->group(function () {

    // Gestión completa de Activos
    Route::prefix('activos')->name('activos.')->group(function () {
        Route::get('/create', [ActivoController::class, 'create'])->name('create');
        Route::post('/', [ActivoController::class, 'store'])->name('store');
        Route::get('/{activo}/edit', [ActivoController::class, 'edit'])->name('edit');
        Route::put('/{activo}', [ActivoController::class, 'update'])->name('update');
        Route::delete('/{activo}', [ActivoController::class, 'destroy'])->name('destroy');
        Route::post('/{activo}/checkin', [ActivoController::class, 'checkin'])->name('checkin');
        Route::post('/{activo}/checkout', [ActivoController::class, 'checkout'])->name('checkout');
        Route::get('/export/excel', [ActivoController::class, 'exportExcel'])->name('export.excel');
        Route::get('/export/pdf', [ActivoController::class, 'exportPdf'])->name('export.pdf');
    });

    // Gestión completa de Alertas
    Route::prefix('alertas')->name('alertas.')->group(function () {
        Route::get('/crear', [AlertaController::class, 'create'])->name('create');
        Route::post('/', [AlertaController::class, 'store'])->name('store');
        Route::get('/{alerta}/editar', [AlertaController::class, 'edit'])->name('edit');
        Route::put('/{alerta}', [AlertaController::class, 'update'])->name('update');
        Route::delete('/{alerta}', [AlertaController::class, 'destroy'])->name('destroy');
        Route::patch('/resolve/{id}', [AlertaController::class, 'resolve'])->name('resolve');
        Route::patch('/resolve-all', [AlertaController::class, 'resolveAll'])->name('resolve.all');
        Route::get('/generar/automaticas', [AlertaController::class, 'generarAlertasAutomaticas'])->name('generar.automaticas');
    });

    // Gestión de Usuarios
    Route::resource('usuarios', UserController::class);

    // Gestión de Impresoras
    Route::resource('impresoras', ImpresoraController::class);
});

// --------------------------------------------------
// RUTAS API/REST PARA FUNCIONALIDAD AJAX
// --------------------------------------------------
Route::middleware(['auth', 'web'])->group(function () {
    // Actualización AJAX de activos
    Route::put('/activos/{id}/ajax', [ActivoController::class, 'updateAjax'])->name('activos.update.ajax');
    
    // Store de activos (para formularios modales)
    Route::post('/activos/ajax', [ActivoController::class, 'store'])->name('activos.store.ajax');
});
Route::get('/dashboard', DashboardController::class)->name('dashboard');