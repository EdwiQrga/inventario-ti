<?php

use Illuminate\Support\Facades\Route;

// Controladores
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ActivoController;
use App\Http\Controllers\AlertaController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\HomeController;

// --------------------------------------------------
// RUTAS PÚBLICAS
// --------------------------------------------------
Route::middleware('guest')->group(function () {
    Route::get('/login', fn() => view('login'))->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post');
});

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/', fn() => redirect()->route('login'));

// --------------------------------------------------
// RUTAS PROTEGIDAS (Auth + Prevent Back)
// --------------------------------------------------
Route::middleware(['auth', 'prevent.back'])->group(function () {

    // Dashboard e inicio
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/inicio', [HomeController::class, 'index'])->name('home');

    // RUTAS GENERALES (para TODOS los usuarios autenticados)
    Route::get('/inventario', [ActivoController::class, 'index'])->name('inventario.index');
    Route::get('/alertas', [AlertaController::class, 'index'])->name('alertas.index');
    Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index'); // PARA TODOS

    // --------------------------------------------------
    // ADMIN
    // --------------------------------------------------
    Route::middleware('role:admin')->group(function () {

        // Gestión de Activos
        Route::prefix('activos')->name('activos.')->group(function () {
            Route::get('/', [ActivoController::class, 'index'])->name('index');
            Route::get('/create', [ActivoController::class, 'create'])->name('create');
            Route::post('/', [ActivoController::class, 'store'])->name('store');
            Route::get('/{activo}/edit', [ActivoController::class, 'edit'])->name('edit');
            Route::put('/{activo}', [ActivoController::class, 'update'])->name('update');
            Route::delete('/{activo}', [ActivoController::class, 'destroy'])->name('destroy');
            Route::get('/{activo}', [ActivoController::class, 'show'])->name('show');
            Route::get('/export/excel', [ActivoController::class, 'exportExcel'])->name('export.excel');
            Route::get('/export/pdf', [ActivoController::class, 'exportPdf'])->name('export.pdf');
            Route::post('/{activo}/checkin', [ActivoController::class, 'checkin'])->name('checkin');
            Route::post('/{activo}/checkout', [ActivoController::class, 'checkout'])->name('checkout');
        });

        // Gestión de Alertas (solo admin puede resolver/crear)
        Route::prefix('alertas')->name('alertas.')->group(function () {
            Route::patch('/resolve/{id}', [AlertaController::class, 'resolve'])->name('resolve');
            Route::patch('/resolve-all', [AlertaController::class, 'resolveAll'])->name('resolve.all');
            Route::post('/store', [AlertaController::class, 'store'])->name('store');
        });

        // Exportaciones de reportes (solo admin)
        Route::prefix('reportes')->name('reportes.')->group(function () {
            Route::get('/pdf', [ReporteController::class, 'exportarPDF'])->name('pdf');
            Route::get('/excel', [ReporteController::class, 'exportarExcel'])->name('excel');
            Route::get('/csv', [ReporteController::class, 'exportarCSV'])->name('csv');
        });

        // Gestión de Usuarios
        Route::resource('usuarios', UserController::class);

        // Configuración (solo admin)
        // Route::get('/configuracion', [ConfiguracionController::class, 'index'])->name('configuracion.index');
    });
Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');
Route::get('/reportes/export', [ReporteController::class, 'export'])->name('reportes.export');
    // --------------------------------------------------
    // USUARIO NORMAL
    // --------------------------------------------------
Route::get('/alertas', [AlertaController::class, 'index'])->name('alertas.index');


    Route::middleware('role:user')->group(function () {
        // Exportaciones de reportes (solo lectura, pero puede exportar)
        Route::prefix('reportes')->name('reportes.')->group(function () {
            Route::get('/pdf', [ReporteController::class, 'exportarPDF'])->name('pdf');
            Route::get('/excel', [ReporteController::class, 'exportarExcel'])->name('excel');
            Route::get('/csv', [ReporteController::class, 'exportarCSV'])->name('csv');
        });
    });
Route::resource('usuarios', UserController::class);
    // Configuración general (temporal - opcional)
    Route::view('/configuracion', 'configuracion')->name('configuracion');
});
