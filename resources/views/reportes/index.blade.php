<!DOCTYPE html>
<html class="dark" lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Reportes Exportables - Inventario TI</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    boxShadow: {
                        'DEFAULT': '0 1px 2px 0 rgb(0 0 0 / 0.05)',
                        'md': '0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1)',
                        'lg': '0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1)',
                    },
                    colors: {
                        "primary": "#005850",
                        "secondary": "#62c443",
                        "accent-1": "#00868a",
                        "accent-2": "#7ac5c7",
                        "accent-3": "#05553c",
                        "accent-4": "#01a48b",
                        "accent-5": "#007a63",
                        "background-light": "#f6f7f8",
                        "background-dark": "#101922",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.5rem",
                        "lg": "0.75rem",
                        "xl": "1rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 20;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-gray-800 dark:text-gray-200">
<div class="relative flex h-auto min-h-screen w-full group/design-root overflow-x-hidden">
    <div class="layout-container flex h-full grow flex-row">

        <!-- Sidebar -->
        <aside class="flex-col gap-y-6 items-stretch px-4 py-8 bg-white dark:bg-gray-900/50 border-r border-gray-200 dark:border-gray-800 hidden lg:flex w-64 shadow-sm">
            <div class="flex items-center justify-center gap-x-2 text-primary px-2">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd" d="M12.0799 24L4 19.2479L9.95537 8.75216L18.04 13.4961L18.0446 4H29.9554L29.96 13.4961L38.0446 8.75216L44 19.2479L35.92 24L44 28.7521L38.0446 39.2479L29.96 34.5039L29.9554 44H18.0446L18.04 34.5039L9.95537 39.2479L4 28.7521L12.0799 24Z" fill="currentColor" fill-rule="evenodd"></path>
                </svg>
                <span class="text-xl font-bold">Inventario TI</span>
            </div>
            <nav class="flex flex-col gap-y-2 flex-1">
                <a class="flex items-center gap-x-3 py-2 px-3 rounded text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60 transition-colors" href="{{ route('dashboard') }}">
                    <span class="material-symbols-outlined">home</span>
                    <span class="text-sm font-medium">Inicio</span>
                </a>
                <a class="flex items-center gap-x-3 py-2 px-3 rounded text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60 transition-colors" href="{{ route('activos.index') }}">
                    <span class="material-symbols-outlined">inventory_2</span>
                    <span class="text-sm font-medium">Inventario</span>
                </a>
                <a class="flex items-center gap-x-3 py-2 px-3 rounded text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60 transition-colors" href="#">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span class="text-sm font-medium">Dashboard</span>
                </a>
                <a class="flex items-center gap-x-3 py-2 px-3 rounded text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60 transition-colors" href="{{ route('alertas.index') }}">
                    <span class="material-symbols-outlined">notifications_active</span>
                    <span class="text-sm font-medium">Alertas</span>
                </a>
                <a class="flex items-center gap-x-3 py-2 px-3 rounded text-white bg-primary shadow-sm hover:bg-primary/90 transition-colors" href="{{ route('reportes.index') }}">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1, 'wght' 400;">assessment</span>
                    <span class="text-sm font-semibold">Reportes</span>
                </a>
                <a class="flex items-center gap-x-3 py-2 px-3 rounded text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60 transition-colors" href="{{ route('usuarios.index') }}">
                    <span class="material-symbols-outlined">group</span>
                    <span class="text-sm font-medium">Gestión de Usuarios</span>
                </a>
            </nav>
            <div class="flex flex-col gap-y-2">
                <a class="flex items-center gap-x-3 py-2 px-3 rounded text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60 transition-colors" href="#">
                    <span class="material-symbols-outlined">settings</span>
                    <span class="text-sm font-medium">Configuración</span>
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="flex w-full items-center gap-x-3 py-2 px-3 rounded text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60 transition-colors text-left">
                        <span class="material-symbols-outlined">logout</span>
                        <span class="text-sm font-medium">Cerrar Sesión</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex flex-col flex-1">
            <!-- Header -->
            <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-gray-200 dark:border-gray-800 px-6 sm:px-8 lg:px-10 py-3 bg-white/80 dark:bg-gray-900/80 backdrop-blur-sm sticky top-0 z-10">
                <div class="flex items-center gap-4">
                    <button class="lg:hidden text-gray-600 dark:text-gray-300">
                        <span class="material-symbols-outlined">menu</span>
                    </button>
                    <h1 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">Reportes Exportables</h1>
                </div>
                <div class="flex flex-1 justify-end gap-2 items-center">
                    <button class="flex items-center justify-center rounded-full h-10 w-10 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60 transition-colors">
                        <span class="material-symbols-outlined">notifications</span>
                    </button>
                    <div class="flex items-center gap-x-3 py-2 pl-2 pr-3 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800/60 transition-colors cursor-pointer">
                        <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-9"
                             style='background-image: url("{{ auth()->user()->avatar ?? "https://ui-avatars.com/api/?name=" . urlencode(auth()->user()->name) }}");'></div>
                        <div class="hidden sm:flex flex-col flex-1 min-w-0">
                            <span class="text-sm font-semibold text-gray-800 dark:text-gray-100 truncate">{{ auth()->user()->name }}</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400 truncate">Administrador</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main -->
            <main class="flex-1 px-6 sm:px-8 lg:px-10 py-8 bg-background-light dark:bg-background-dark">
                <div class="max-w-7xl mx-auto">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                        <!-- Selección de Reportes -->
                        <div class="lg:col-span-8 flex flex-col gap-6">
                            <div class="flex flex-col gap-6 rounded-lg border border-gray-200 dark:border-gray-700/50 p-6 bg-white dark:bg-gray-800/50 shadow">
                                <h3 class="text-gray-900 dark:text-white text-lg font-semibold">Seleccione Reporte</h3>
                                <form method="GET" action="{{ route('reportes.export') }}" id="report-form">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <!-- Inventario General -->
                                        <label class="text-left p-4 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-primary dark:hover:border-primary hover:bg-primary/5 dark:hover:bg-primary/10 transition-colors focus-within:ring-2 focus-within:ring-primary focus-within:ring-offset-2 dark:focus-within:ring-offset-background-dark cursor-pointer">
                                            <input type="radio" name="reporte" value="inventario_general" class="hidden" {{ request('reporte') == 'inventario_general' ? 'checked' : '' }}>
                                            <div class="flex items-center gap-3">
                                                <span class="material-symbols-outlined text-primary text-2xl">inventory</span>
                                                <span class="font-semibold text-gray-800 dark:text-gray-100">Inventario General</span>
                                            </div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Lista completa de todos los activos.</p>
                                        </label>

                                        <!-- Activos por Usuario -->
                                        <label class="text-left p-4 rounded-lg border border-primary dark:border-primary bg-primary/5 dark:bg-primary/10 ring-2 ring-primary ring-offset-2 dark:ring-offset-background-dark cursor-pointer">
                                            <input type="radio" name="reporte" value="activos_usuario" class="hidden" checked>
                                            <div class="flex items-center gap-3">
                                                <span class="material-symbols-outlined text-primary text-2xl">person_pin</span>
                                                <span class="font-semibold text-gray-800 dark:text-gray-100">Activos por Usuario</span>
                                            </div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Activos asignados a cada usuario.</p>
                                        </label>

                                        <!-- Vencimiento de Garantías -->
                                        <label class="text-left p-4 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-primary dark:hover:border-primary hover:bg-primary/5 dark:hover:bg-primary/10 transition-colors focus-within:ring-2 focus-within:ring-primary focus-within:ring-offset-2 dark:focus-within:ring-offset-background-dark cursor-pointer">
                                            <input type="radio" name="reporte" value="garantias_vencidas" class="hidden" {{ request('reporte') == 'garantias_vencidas' ? 'checked' : '' }}>
                                            <div class="flex items-center gap-3">
                                                <span class="material-symbols-outlined text-primary text-2xl">new_releases</span>
                                                <span class="font-semibold text-gray-800 dark:text-gray-100">Vencimiento de Garantías</span>
                                            </div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Activos con garantías próximas a vencer.</p>
                                        </label>

                                        <!-- Historial de Mantenimiento -->
                                        <label class="text-left p-4 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-primary dark:hover:border-primary hover:bg-primary/5 dark:hover:bg-primary/10 transition-colors focus-within:ring-2 focus-within:ring-primary focus-within:ring-offset-2 dark:focus-within:ring-offset-background-dark cursor-pointer">
                                            <input type="radio" name="reporte" value="mantenimiento" class="hidden" {{ request('reporte') == 'mantenimiento' ? 'checked' : '' }}>
                                            <div class="flex items-center gap-3">
                                                <span class="material-symbols-outlined text-primary text-2xl">update</span>
                                                <span class="font-semibold text-gray-800 dark:text-gray-100">Historial de Mantenimiento</span>
                                            </div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Registro de mantenimientos por activo.</p>
                                        </label>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Filtros y Exportación -->
                        <div class="lg:col-span-4 flex flex-col gap-6">
                            <div class="flex flex-col gap-6 rounded-lg border border-gray-200 dark:border-gray-700/50 p-6 bg-white dark:bg-gray-800/50 shadow">
                                <h3 class="text-gray-900 dark:text-white text-lg font-semibold">Filtros y Exportación</h3>
                                <form method="GET" action="{{ route('reportes.export') }}" id="export-form">
                                    <div class="flex flex-col gap-4">
                                        <!-- Usuario -->
                                        <div>
                                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300" for="user">Usuario</label>
                                            <select name="usuario" id="user" class="mt-1 block w-full rounded border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 shadow-sm focus:border-primary focus:ring-primary dark:focus:border-primary dark:focus:ring-primary sm:text-sm">
                                                <option value="">Todos los usuarios</option>
                                                @foreach(\App\Models\User::all() as $user)
                                                    <option value="{{ $user->id }}" {{ request('usuario') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Rango de Fechas -->
                                        <div>
                                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300" for="date-range">Rango de Fechas</label>
                                            <input type="text" name="fecha_rango" id="date-range" placeholder="Seleccionar rango"
                                                   class="mt-1 block w-full rounded border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 shadow-sm focus:border-primary focus:ring-primary dark:focus:border-primary dark:focus:ring-primary sm:text-sm"
                                                   value="{{ request('fecha_rango') }}">
                                        </div>

                                        <!-- Formato -->
                                        <div>
                                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300" for="format">Formato de Archivo</label>
                                            <select name="formato" id="format" class="mt-1 block w-full rounded border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 shadow-sm focus:border-primary focus:ring-primary dark:focus:border-primary dark:focus:ring-primary sm:text-sm">
                                                <option value="xlsx" {{ request('formato') == 'xlsx' ? 'selected' : '' }}>Excel (.xlsx)</option>
                                                <option value="csv" {{ request('formato') == 'csv' ? 'selected' : '' }}>CSV (.csv)</option>
                                                <option value="pdf" {{ request('formato') == 'pdf' ? 'selected' : '' }}>PDF (.pdf)</option>
                                            </select>
                                        </div>
                                    </div>

                                    <button type="submit"
                                            class="flex w-full min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center gap-2 overflow-hidden rounded h-10 px-4 bg-primary text-white text-sm font-medium hover:bg-primary/90 transition-all shadow-sm mt-4">
                                        <span class="material-symbols-outlined text-lg">download</span>
                                        <span class="truncate">Exportar Reporte</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>

<!-- Flatpickr para rango de fechas -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("#date-range", {
        mode: "range",
        dateFormat: "Y-m-d",
        locale: "es"
    });

    // Sincronizar selección de reporte
    document.querySelectorAll('input[name="reporte"]').forEach(radio => {
        radio.addEventListener('change', () => {
            document.querySelectorAll('label').forEach(label => {
                label.classList.remove('border-primary', 'bg-primary/5', 'dark:bg-primary/10', 'ring-2', 'ring-primary', 'ring-offset-2', 'dark:ring-offset-background-dark');
                label.classList.add('border-gray-200', 'dark:border-gray-700');
            });
            radio.closest('label').classList.add('border-primary', 'dark:border-primary', 'bg-primary/5', 'dark:bg-primary/10', 'ring-2', 'ring-primary', 'ring-offset-2', 'dark:ring-offset-background-dark');
        });
    });
</script>
</body>
</html>