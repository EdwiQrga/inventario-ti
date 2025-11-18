<?php

use Illuminate\Support\Facades\Route;

// Controladores
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ActivoController;
use App\Http\Controllers\AlertaController;
use App\Http\Controllers\ReportesController;
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

    // Rutas generales accesibles para TODOS
    Route::get('/inventario', [ActivoController::class, 'index'])->name('inventario.index');
    Route::get('/alertas', [AlertaController::class, 'index'])->name('alertas.index');

    // Página de reportes (acceso general)
    Route::get('/reportes', [ReportesController::class, 'index'])->name('reportes.index');

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

            // Check-in / Check-out
            Route::post('/{activo}/checkin', [ActivoController::class, 'checkin'])->name('checkin');
            Route::post('/{activo}/checkout', [ActivoController::class, 'checkout'])->name('checkout');
        });

        // Gestión de Alertas (solo admin)
        Route::prefix('alertas')->name('alertas.')->group(function () {
            Route::patch('/resolve/{id}', [AlertaController::class, 'resolve'])->name('resolve');
            Route::patch('/resolve-all', [AlertaController::class, 'resolveAll'])->name('resolve.all');
            Route::post('/store', [AlertaController::class, 'store'])->name('store');
        });

        // Exportación de reportes
        Route::prefix('reportes')->name('reportes.')->group(function () {
            Route::get('/pdf', [ReportesController::class, 'exportarPDF'])->name('pdf');
            Route::get('/excel', [ReportesController::class, 'exportarExcel'])->name('excel');
            Route::get('/csv', [ReportesController::class, 'exportarCSV'])->name('csv');
        });

        // Gestión de Usuarios
        Route::resource('usuarios', UserController::class);

        // Configuración
       //Route::get('/configuracion', [ConfiguracionController::class, 'index'])->name('configuracion.index');
    });

Route::get('/dashboard', DashboardController::class)->name('dashboard');

    // --------------------------------------------------
    // USUARIO NORMAL
    // --------------------------------------------------
    Route::middleware('role:user')->group(function () {

        // Reportes: solo lectura y exportación
        Route::prefix('reportes')->name('reportes.')->group(function () {
            Route::get('/pdf', [ReportesController::class, 'exportarPDF'])->name('pdf');
            Route::get('/excel', [ReportesController::class, 'exportarExcel'])->name('excel');
            Route::get('/csv', [ReportesController::class, 'exportarCSV'])->name('csv');
        });
    });

});
Route::middleware(['auth'])->group(function () {
    Route::get('/reportes', [ReportesController::class, 'index'])->name('reportes.index');
    Route::get('/reportes/export', [ReportesController::class, 'export'])->name('reportes.export');
});
Route::post('/activos', [ActivoController::class, 'store'])
     ->name('activos.store')
     ->middleware('web'); // o 'auth' si tienes autenticación

     Route::get('/activos/{id}/editar', [ActivoController::class, 'edit'])->name('activos.editar');
Route::put('/activos/{id}', [ActivoController::class, 'updateAjax'])->name('activos.update.ajax');

Route::put('/activos/{id}', [ActivoController::class, 'update'])->name('activos.update');