<!DOCTYPE html>
<html class="dark" lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Inventario de Activos</title>
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
        <aside class="flex-col gap-y-6 items-stretch px-4 py-8 bg-white dark:bg-gray-900/50 border-r border-gray-200 dark:border-gray-800 hidden lg:flex w-64 shadow-sm">
            <div class="flex items-center justify-center gap-x-2 text-primary px-2">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd" d="M12.0799 24L4 19.2479L9.95537 8.75216L18.04 13.4961L18.0446 4H29.9554L29.96 13.4961L38.0446 8.75216L44 19.2479L35.92 24L44 28.7521L38.0446 39.2479L29.96 34.5039L29.9554 44H18.0446L18.04 34.5039L9.95537 39.2479L4 28.7521L12.0799 24Z" fill="currentColor" fill-rule="evenodd"></path>
                </svg>
                <span class="text-xl font-bold">Inventario TI</span>
            </div>
            <nav class="flex flex-col gap-y-2 flex-1">
                <a class="flex items-center gap-x-3 py-2 px-3 rounded text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60 transition-colors" href="{{ route('dashboard') }}">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span class="text-sm font-medium">Dashboard</span>
                </a>
                <a class="flex items-center gap-x-3 py-2 px-3 rounded text-white bg-primary shadow-sm hover:bg-primary/90 transition-colors" href="{{ route('activos.index') }}">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1, 'wght' 400;">inventory_2</span>
                    <span class="text-sm font-semibold">Inventario de Activos</span>
                </a>
                <a class="flex items-center gap-x-3 py-2 px-3 rounded text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60 transition-colors" href="{{ route('usuarios.index') }}">
                    <span class="material-symbols-outlined">group</span>
                    <span class="text-sm font-medium">Gestión de Usuarios</span>
                </a>
                <a class="flex items-center gap-x-3 py-2 px-3 rounded text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60 transition-colors" href="{{ route('reportes.index') }}">
                    <span class="material-symbols-outlined">assessment</span>
                    <span class="text-sm font-medium">Reportes</span>
                </a>
                <a class="flex items-center gap-x-3 py-2 px-3 rounded text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60 transition-colors" href="{{ route('alertas.index') }}">
                    <span class="material-symbols-outlined">notifications_active</span>
                    <span class="text-sm font-medium">Alertas</span>
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
                    <h1 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">Inventario de Activos</h1>
                </div>
                <div class="flex flex-1 justify-end gap-2 items-center">
                    <button class="flex items-center justify-center rounded-full h-10 w-10 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60 transition-colors">
                        <span class="material-symbols-outlined">notifications</span>
                    </button>
                    <div class="flex items-center gap-x-3 p-1 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800/60 transition-colors cursor-pointer">
                        <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-8"
                             style='background-image: url("{{ auth()->user()->avatar ?? "https://ui-avatars.com/api/?name=" . urlencode(auth()->user()->name) }}");'></div>
                        <div class="hidden sm:flex flex-col flex-1 min-w-0 pr-2">
                            <span class="text-sm font-semibold text-gray-800 dark:text-gray-100 truncate">{{ auth()->user()->name }}</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400 truncate">Administrador</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main -->
            <main class="flex-1 px-6 sm:px-8 lg:px-10 py-8 bg-background-light dark:bg-background-dark">
                <div class="max-w-7xl mx-auto">
                    <!-- Búsqueda + Botón -->
                    <div class="flex flex-wrap justify-between items-center gap-4 mb-8">
                        <div class="relative w-full max-w-sm">
                            <form method="GET" action="{{ route('activos.index') }}">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500">search</span>
                                <input name="search" value="{{ request('search') }}"
                                       class="w-full pl-10 pr-4 py-2 text-sm rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 focus:ring-2 focus:ring-primary/50 focus:border-primary dark:focus:border-primary"
                                       placeholder="Buscar por ID, nombre, usuario..." type="text"/>
                            </form>
                        </div>
                        <div class="flex items-center gap-3">
                            <button type="button" class="flex h-9 shrink-0 cursor-pointer items-center justify-center gap-2 overflow-hidden rounded-lg px-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/60 transition-colors shadow-sm">
                                <span class="material-symbols-outlined text-lg">filter_list</span>
                                <span class="truncate">Filtros</span>
                            </button>
                            <a href="{{ route('activos.create') }}"
                               class="flex shrink-0 cursor-pointer items-center justify-center gap-2 overflow-hidden rounded-lg h-9 px-4 bg-primary text-white text-sm font-medium hover:bg-primary/90 transition-colors shadow-sm">
                                <span class="material-symbols-outlined text-lg">add</span>
                                <span class="truncate">Añadir Activo</span>
                            </a>
                        </div>
                    </div>

                    <!-- Tabla -->
                    <div class="rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800/50 shadow-sm overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700/50 dark:text-gray-400">
                                <tr>
                                    <th class="p-4" scope="col">
                                        <input class="h-4 w-4 rounded border-gray-300 dark:border-gray-600 text-primary focus:ring-primary dark:bg-gray-700 dark:ring-offset-gray-800" type="checkbox"/>
                                    </th>
                                    <th class="px-6 py-3" scope="col">ID Activo</th>
                                    <th class="px-6 py-3" scope="col">Nombre del Activo</th>
                                    <th class="px-6 py-3" scope="col">Tipo</th>
                                    <th class="px-6 py-3" scope="col">Usuario Asignado</th>
                                    <th class="px-6 py-3" scope="col">Fecha de Compra</th>
                                    <th class="px-6 py-3" scope="col">Estado</th>
                                    <th class="px-6 py-3 text-right" scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($activos as $activo)
                                    @php
                                        $estadoColor = $activo->estado == 'Activo' ? 'bg-secondary' : 
                                                      ($activo->estado == 'En Reparación' ? 'bg-accent-2' : 'bg-gray-500');
                                        $estadoTexto = $activo->estado == 'Activo' ? 'Activo' : 
                                                      ($activo->estado == 'En Reparación' ? 'En Reparación' : 'Obsoleto');
                                    @endphp
                                    <tr class="bg-white dark:bg-gray-800/50 hover:bg-gray-50 dark:hover:bg-gray-700/50 border-b dark:border-gray-700">
                                        <td class="p-4">
                                            <input class="h-4 w-4 rounded border-gray-300 dark:border-gray-600 text-primary focus:ring-primary dark:bg-gray-700 dark:ring-offset-gray-800" type="checkbox"/>
                                        </td>
                                        <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" scope="row">
                                            {{ $activo->id }}
                                        </th>
                                        <td class="px-6 py-4">{{ $activo->nombre }}</td>
                                        <td class="px-6 py-4">{{ $activo->tipo }}</td>
                                        <td class="px-6 py-4">
                                            {{ $activo->asignado_a ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $activo->fecha_compra ? \Carbon\Carbon::parse($activo->fecha_compra)->format('d/m/Y') : 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                {{ $activo->estado == 'Activo' ? 'bg-secondary/10 text-secondary-800 dark:bg-secondary/20 dark:text-secondary-300' : 
                                                   ($activo->estado == 'En Reparación' ? 'bg-accent-2/20 text-accent-2-800 dark:bg-accent-2/30 dark:text-accent-2' : 
                                                   'bg-gray-500/10 text-gray-800 dark:bg-gray-600/20 dark:text-gray-300') }}">
                                                <span class="w-2 h-2 mr-2 rounded-full {{ $estadoColor }}"></span>
                                                {{ $estadoTexto }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex items-center justify-end gap-x-2">
                                                <a href="{{ route('activos.show', $activo) }}" class="p-1.5 rounded-md text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-800 dark:hover:text-gray-200 transition-colors">
                                                    <span class="material-symbols-outlined text-base">visibility</span>
                                                </a>
                                                <a href="{{ route('activos.edit', $activo) }}" class="p-1.5 rounded-md text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-800 dark:hover:text-gray-200 transition-colors">
                                                    <span class="material-symbols-outlined text-base">edit</span>
                                                </a>
                                                <form action="{{ route('activos.destroy', $activo) }}" method="POST" class="inline">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" onclick="return confirm('¿Eliminar este activo?')"
                                                            class="p-1.5 rounded-md text-gray-500 dark:text-gray-400 hover:bg-red-50 dark:hover:bg-red-900/40 hover:text-red-600 dark:hover:text-red-500 transition-colors">
                                                        <span class="material-symbols-outlined text-base">delete</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-8 text-gray-500 dark:text-gray-400">
                                            No se encontraron activos.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación -->
                    <div class="flex flex-wrap items-center justify-between gap-4 mt-6">
                        <span class="text-sm text-gray-600 dark:text-gray-400">
                            Mostrando {{ $activos->firstItem() }}-{{ $activos->lastItem() }} de {{ $activos->total() }} activos
                        </span>
                        <div class="flex items-center gap-2">
                            {{ $activos->appends(request()->query())->links('pagination::tailwind') }}
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
</body>
</html>