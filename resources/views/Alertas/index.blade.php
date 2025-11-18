<!DOCTYPE html>
<html class="dark" lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Alertas Preventivas - Inventario TI</title>
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
            font-variation-settings:
                'FILL' 0,
                'wght' 300,
                'GRAD' 0,
                'opsz' 20
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-gray-800 dark:text-gray-200">
<div class="relative flex h-auto min-h-screen w-full group/design-root overflow-x-hidden">
    <div class="layout-container flex h-full grow flex-row">

        <!-- Sidebar -->
        <aside class="flex-col gap-y-6 items-stretch p-4 bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-800 hidden lg:flex w-64 shadow-sm">
            <div class="flex items-center gap-x-3 px-4 py-2">
                <svg class="h-8 w-8 text-primary" fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd" d="M12.0799 24L4 19.2479L9.95537 8.75216L18.04 13.4961L18.0446 4H29.9554L29.96 13.4961L38.0446 8.75216L44 19.2479L35.92 24L44 28.7521L38.0446 39.2479L29.96 34.5039L29.9554 44H18.0446L18.04 34.5039L9.95537 39.2479L4 28.7521L12.0799 24Z" fill="currentColor" fill-rule="evenodd"></path>
                </svg>
                <span class="text-xl font-bold text-gray-900 dark:text-white">Inventario TI</span>
            </div>
            <nav class="flex flex-col gap-y-1.5 flex-1 px-2">
                <a class="flex items-center gap-x-3 py-2.5 px-3 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60 transition-colors" href="{{ route('dashboard') }}">
                    <span class="material-symbols-outlined text-xl">home</span>
                    <span class="text-sm font-medium">Inicio</span>
                </a>
                <a class="flex items-center gap-x-3 py-2.5 px-3 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60 transition-colors" href="{{ route('activos.index') }}">
                    <span class="material-symbols-outlined text-xl">inventory_2</span>
                    <span class="text-sm font-medium">Inventario</span>
                </a>
                <a class="flex items-center gap-x-3 py-2.5 px-3 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60 transition-colors" href="#">
                    <span class="material-symbols-outlined text-xl">dashboard</span>
                    <span class="text-sm font-medium">Dashboard</span>
                </a>
                <a class="flex items-center gap-x-3 py-2.5 px-3 rounded-lg text-white bg-primary shadow-sm hover:bg-primary/90 transition-colors" href="{{ route('alertas.index') }}">
                    <span class="material-symbols-outlined text-xl" style="font-variation-settings: 'FILL' 1, 'wght' 400;">notifications_active</span>
                    <span class="text-sm font-semibold">Alertas</span>
                </a>
                <a class="flex items-center gap-x-3 py-2.5 px-3 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60 transition-colors" href="{{ route('reportes.index') }}">
                    <span class="material-symbols-outlined text-xl">assessment</span>
                    <span class="text-sm font-medium">Reportes</span>
                </a>
                <a class="flex items-center gap-x-3 py-2.5 px-3 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60 transition-colors" href="{{ route('usuarios.index') }}">
                    <span class="material-symbols-outlined text-xl">group</span>
                    <span class="text-sm font-medium">Gestión de Usuarios</span>
                </a>
            </nav>
            <div class="flex flex-col gap-y-1.5 px-2">
                <a class="flex items-center gap-x-3 py-2.5 px-3 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60 transition-colors" href="#">
                    <span class="material-symbols-outlined text-xl">settings</span>
                    <span class="text-sm font-medium">Configuración</span>
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="flex w-full items-center gap-x-3 py-2.5 px-3 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60 transition-colors text-left">
                        <span class="material-symbols-outlined text-xl">logout</span>
                        <span class="text-sm font-medium">Cerrar Sesión</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex flex-col flex-1">
            <!-- Header -->
            <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-gray-200 dark:border-gray-800 px-6 sm:px-8 lg:px-10 h-16 bg-white/80 dark:bg-background-dark/80 backdrop-blur-sm sticky top-0 z-10">
                <div class="flex items-center gap-4">
                    <button class="lg:hidden text-gray-600 dark:text-gray-300">
                        <span class="material-symbols-outlined">menu</span>
                    </button>
                    <h1 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">Alertas Preventivas</h1>
                </div>
                <div class="flex flex-1 justify-end gap-2 items-center">
                    <button class="flex items-center justify-center rounded-full h-10 w-10 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800/60 transition-colors">
                        <span class="material-symbols-outlined">notifications</span>
                    </button>
                    <div class="flex items-center gap-x-3 py-1 pl-1 pr-3 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800/60 transition-colors cursor-pointer">
                        <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full h-8 w-8"
                             style='background-image: url("{{ auth()->user()->avatar ?? "https://ui-avatars.com/api/?name=" . urlencode(auth()->user()->name) }}");'></div>
                        <div class="hidden sm:flex flex-col flex-1 min-w-0">
                            <span class="text-sm font-semibold text-gray-800 dark:text-gray-100 truncate">{{ auth()->user()->name }}</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400 truncate">Administrador</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main -->
            <main class="flex-1 px-6 sm:px-8 lg:px-10 py-8">
                <div class="max-w-7xl mx-auto">

                    <!-- Estadísticas -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm">
                            <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Alertas Críticas</p>
                            <p class="text-red-500 text-3xl font-bold tracking-tight">
                                {{ $alertas->where('prioridad', 'Crítica')->count() }}
                            </p>
                        </div>
                        <div class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm">
                            <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Alertas Moderadas</p>
                            <p class="text-yellow-500 text-3xl font-bold tracking-tight">
                                {{ $alertas->where('prioridad', 'Moderada')->count() }}
                            </p>
                        </div>
                        <div class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm">
                            <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Alertas de Información</p>
                            <p class="text-blue-500 text-3xl font-bold tracking-tight">
                                {{ $alertas->where('prioridad', 'Información')->count() }}
                            </p>
                        </div>
                    </div>

                    <!-- Búsqueda + Botón -->
                    <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
                        <div class="flex items-center gap-4">
                            <div class="relative w-full max-w-sm">
                                <form method="GET" action="{{ route('alertas.index') }}">
                                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500">search</span>
                                    <input name="search" value="{{ request('search') }}"
                                           class="w-full h-10 pl-10 pr-4 rounded-lg bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors text-sm"
                                           placeholder="Buscar alertas..." type="search"/>
                                </form>
                            </div>
                            <button type="button" class="flex h-10 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 px-4 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors shadow-sm">
                                <span>Filtrar</span>
                                <span class="material-symbols-outlined text-lg">filter_list</span>
                            </button>
                        </div>
                        <a href="{{ route('alertas.create') }}"
                           class="flex shrink-0 items-center justify-center gap-2 overflow-hidden rounded-lg h-10 px-4 bg-primary text-white text-sm font-medium hover:bg-primary/90 transition-colors shadow-sm">
                            <span class="material-symbols-outlined text-lg">add</span>
                            <span class="truncate">Configurar Nueva Alerta</span>
                        </a>
                    </div>

                    <!-- Tabla de Alertas -->
                    <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-600 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 dark:text-gray-300 uppercase bg-gray-50 dark:bg-gray-800">
                                    <tr>
                                        <th class="px-6 py-3" scope="col">Prioridad</th>
                                        <th class="px-6 py-3" scope="col">Descripción</th>
                                        <th class="px-6 py-3" scope="col">Activo Involucrado</th>
                                        <th class="px-6 py-3" scope="col">Fecha</th>
                                        <th class="px-6 py-3" scope="col">Estado</th>
                                        <th class="px-6 py-3 text-right" scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($alertas as $alerta)
                                        @php
                                            $prioridadColor = $alerta->prioridad == 'Crítica' ? 'bg-red-100 dark:bg-red-900/40 text-red-600 dark:text-red-400' :
                                                             ($alerta->prioridad == 'Moderada' ? 'bg-yellow-100 dark:bg-yellow-900/40 text-yellow-600 dark:text-yellow-400' :
                                                             'bg-blue-100 dark:bg-blue-900/40 text-blue-600 dark:text-blue-400');

                                            $estadoColor = $alerta->estado == 'Nueva' ? 'bg-red-500' :
                                                          ($alerta->estado == 'En Proceso' ? 'bg-green-500' : 'bg-gray-500');
                                        @endphp
                                        <tr class="border-b dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/50">
                                            <td class="px-6 py-4">
                                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium {{ $prioridadColor }}">
                                                    {{ $alerta->prioridad }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                                {{ $alerta->descripcion }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $alerta->activo?->nombre ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ \Carbon\Carbon::parse($alerta->fecha)->format('d/m/Y') }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <span class="inline-flex items-center gap-x-2">
                                                    <div class="h-2 w-2 rounded-full {{ $estadoColor }}"></div>
                                                    {{ $alerta->estado }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                @if($alerta->estado == 'Resuelta')
                                                    <a href="{{ route('alertas.show', $alerta) }}" class="font-medium text-primary dark:text-accent-2 hover:underline">Ver detalles</a>
                                                @else
                                                    <a href="{{ route('alertas.edit', $alerta) }}" class="font-medium text-primary dark:text-accent-2 hover:underline">Gestionar</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-8 text-gray-500 dark:text-gray-400">
                                                No hay alertas activas.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Paginación -->
                        <nav aria-label="Table navigation" class="flex items-center justify-between p-4 border-t border-gray-200 dark:border-gray-800">
                            <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                Mostrando <span class="font-semibold text-gray-900 dark:text-white">{{ $alertas->firstItem() }}-{{ $alertas->lastItem() }}</span> de <span class="font-semibold text-gray-900 dark:text-white">{{ $alertas->total() }}</span>
                            </span>
                            <div>
                                {{ $alertas->appends(request()->query())->links('pagination::tailwind') }}
                            </div>
                        </nav>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
</body>
</html>