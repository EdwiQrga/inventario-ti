@php
    use Illuminate\Support\Str;
@endphp
<!DOCTYPE html>
<html class="dark" lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Inventario de Activos - Inventario TI</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    fontFamily: { display: ["Inter", "sans-serif"] },
                    borderRadius: { DEFAULT: "0.5rem", lg: "0.75rem", xl: "1rem", full: "9999px" },
                    screens: {
                        'xs': '475px',
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 20; }
        .material-symbols-filled { font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 20; }
        .table-auto { table-layout: auto; }
        .truncate { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        
        /* Mejoras para móviles */
        @media (max-width: 768px) {
            .mobile-scroll {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            .mobile-table {
                min-width: 800px;
            }
            .mobile-stack {
                flex-direction: column;
            }
            .mobile-text-sm {
                font-size: 0.75rem;
            }
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-gray-800 dark:text-gray-200 min-h-screen">
<div class="flex flex-col lg:flex-row min-h-screen">

    <!-- Sidebar -->
   <aside id="sidebar" class="lg:w-64 w-full lg:block fixed lg:static inset-0 z-40 bg-white dark:bg-gray-900/50 border-r border-gray-200 dark:border-gray-800 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out shadow-sm">
        <div class="flex items-center justify-between lg:justify-start gap-4 px-6 h-16 border-b border-gray-200 dark:border-gray-800">
            <div class="flex items-center gap-2">
                <img src="{{ asset('images/pmn.png') }}" alt="Logo" class="h-8 w-8 object-contain"/>
                <span class="text-xl font-bold text-primary hidden sm:block">Inventario TI</span>
                <span class="text-xl font-bold text-primary sm:hidden">IT</span>
            </div>
            <button id="closeSidebar" class="lg:hidden">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <nav class="p-4 space-y-2">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="text-sm font-medium">Dashboard</span>
            </a>
            <a href="{{ route('activos.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-white bg-primary shadow-sm hover:bg-primary/90">
                <span class="material-symbols-outlined">inventory_2</span>
                <span class="text-sm font-semibold">Inventario</span>
            </a>
            <a href="{{ route('impresoras.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-white bg-primary shadow-sm hover:bg-primary/90">
                <span class="material-symbols-outlined">print</span>
                <span class="text-sm font-semibold">Impresora</span>
            </a>
            <a href="{{ route('usuarios.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60">
                <span class="material-symbols-outlined">group</span>
                <span class="text-sm font-medium">Usuarios</span>
            </a>
            <a href="{{ route('reportes.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60">
                <span class="material-symbols-outlined">assessment</span>
                <span class="text-sm font-medium">Reportes</span>
            </a>
            <a href="{{ route('alertas.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60">
                <span class="material-symbols-outlined">notifications_active</span>
                <span class="text-sm font-medium">Alertas</span>
            </a>
        </nav>
    </aside>

    <!-- Overlay móvil -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden lg:hidden"></div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Header -->
        <header class="flex items-center justify-between px-4 lg:px-6 py-3 h-16 border-b border-gray-200 dark:border-gray-800 bg-white/80 dark:bg-gray-900/80 backdrop-blur-sm sticky top-0 z-10">
            <div class="flex items-center gap-3">
                <button id="openSidebar" class="lg:hidden">
                    <span class="material-symbols-outlined text-2xl">menu</span>
                </button>
                <h1 class="text-lg xs:text-xl font-bold text-gray-900 dark:text-white truncate">Inventario de Activos</h1>
            </div>
            <div class="flex items-center gap-2">
                <button class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800/60 hidden xs:block">
                    <span class="material-symbols-outlined">notifications</span>
                </button>
                <div class="flex items-center gap-2 cursor-pointer">
                    <div class="bg-cover bg-center rounded-full size-8 xs:size-9" 
                         style='background-image: url("{{ auth()->user()->avatar ?? "https://ui-avatars.com/api/?name=" . urlencode(auth()->user()->name) . "&background=005850&color=fff" }}");'>
                    </div>
                    <div class="hidden sm:block text-left">
                        <p class="text-sm font-semibold text-gray-800 dark:text-gray-100 truncate max-w-24 xs:max-w-32">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate max-w-24 xs:max-w-32">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="inline-flex items-center">
                    @csrf
                    <button type="submit" class="flex items-center gap-1.5 px-2 xs:px-3 py-1.5 text-sm font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60 rounded-lg transition-colors">
                        <span class="material-symbols-outlined text-base">logout</span>
                        <span class="hidden xs:inline">Salir</span>
                    </button>
                </form>
            </div>
        </header>

        <!-- Main -->
        <main class="flex-1 p-3 xs:p-4 lg:p-6 overflow-auto">
            <div class="max-w-full mx-auto">
                <!-- Búsqueda + Botón -->
                <div class="flex flex-col xs:flex-row justify-between items-start xs:items-center gap-3 xs:gap-4 mb-6">
                    <div class="relative w-full xs:max-w-sm">
                        <form method="GET" action="{{ route('activos.index') }}">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500 text-lg">search</span>
                            <input name="search" value="{{ request('search') }}"
                                   class="w-full pl-10 pr-4 py-2 text-sm rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 focus:ring-2 focus:ring-primary/50 focus:border-primary dark:focus:border-primary"
                                   placeholder="Buscar sucursal, código..." type="text"/>
                        </form>
                    </div>
                    <div class="flex items-center gap-2 w-full xs:w-auto justify-end">
                        <!-- BOTÓN GENERAR ALERTAS -->
                        <button type="button" id="generarAlertasBtn"
                                class="flex h-9 shrink-0 cursor-pointer items-center justify-center gap-2 overflow-hidden rounded-lg px-3 bg-yellow-500 text-white text-sm font-medium hover:bg-yellow-600 transition-colors shadow-sm">
                            <span class="material-symbols-outlined text-lg">warning</span>
                            <span class="hidden xs:block truncate">Generar Alertas</span>
                        </button>
                        <!-- BOTÓN DE FILTROS -->
                        <button type="button" id="openFiltersModal"
                                class="flex h-9 shrink-0 cursor-pointer items-center justify-center gap-2 overflow-hidden rounded-lg px-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/60 transition-colors shadow-sm">
                            <span class="material-symbols-outlined text-lg">filter_list</span>
                            <span class="hidden xs:block truncate">Filtros</span>
                            @if(request()->hasAny(['estado', 'marca', 'sucursal_area', 'asignado']))
                                <span class="flex h-2 w-2 rounded-full bg-primary"></span>
                            @endif
                        </button>
                        <!-- BOTÓN AÑADIR ACTIVO -->
                        <a href="#" id="openCreateModal"
                           class="flex shrink-0 cursor-pointer items-center justify-center gap-2 overflow-hidden rounded-lg h-9 px-3 xs:px-4 bg-primary text-white text-sm font-medium hover:bg-primary/90 transition-colors shadow-sm">
                            <span class="material-symbols-outlined text-lg">add</span>
                            <span class="hidden xs:block truncate">Añadir</span>
                            <span class="xs:hidden">Nuevo</span>
                        </a>
                    </div>
                </div>

                <!-- Indicadores de filtros activos -->
                @if(request()->hasAny(['estado', 'marca', 'sucursal_area', 'asignado']))
                <div class="mb-4 p-3 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
                    <div class="flex flex-col xs:flex-row xs:items-center gap-2">
                        <span class="text-sm font-medium text-blue-800 dark:text-blue-300">Filtros aplicados:</span>
                        <div class="flex flex-wrap gap-2">
                            @if(request('estado'))
                            <span class="inline-flex items-center gap-1 px-2 py-1 bg-blue-100 dark:bg-blue-800 text-blue-800 dark:text-blue-200 text-xs rounded-full">
                                Estado: {{ request('estado') }}
                                <a href="{{ request()->fullUrlWithQuery(['estado' => null]) }}" class="hover:text-blue-600 dark:hover:text-blue-400">
                                    <span class="material-symbols-outlined text-sm">close</span>
                                </a>
                            </span>
                            @endif

                            @if(request('marca'))
                            <span class="inline-flex items-center gap-1 px-2 py-1 bg-blue-100 dark:bg-blue-800 text-blue-800 dark:text-blue-200 text-xs rounded-full">
                                Marca: {{ request('marca') }}
                                <a href="{{ request()->fullUrlWithQuery(['marca' => null]) }}" class="hover:text-blue-600 dark:hover:text-blue-400">
                                    <span class="material-symbols-outlined text-sm">close</span>
                                </a>
                            </span>
                            @endif

                            @if(request('sucursal_area'))
                            <span class="inline-flex items-center gap-1 px-2 py-1 bg-blue-100 dark:bg-blue-800 text-blue-800 dark:text-blue-200 text-xs rounded-full">
                                Sucursal: {{ request('sucursal_area') }}
                                <a href="{{ request()->fullUrlWithQuery(['sucursal_area' => null]) }}" class="hover:text-blue-600 dark:hover:text-blue-400">
                                    <span class="material-symbols-outlined text-sm">close</span>
                                </a>
                            </span>
                            @endif

                            @if(request('asignado'))
                            <span class="inline-flex items-center gap-1 px-2 py-1 bg-blue-100 dark:bg-blue-800 text-blue-800 dark:text-blue-200 text-xs rounded-full">
                                Asignado: {{ request('asignado') }}
                                <a href="{{ request()->fullUrlWithQuery(['asignado' => null]) }}" class="hover:text-blue-600 dark:hover:text-blue-400">
                                    <span class="material-symbols-outlined text-sm">close</span>
                                </a>
                            </span>
                            @endif
                        </div>
                        <a href="{{ route('activos.index') }}" class="ml-auto text-xs text-blue-600 dark:text-blue-400 hover:underline mt-2 xs:mt-0">
                            Limpiar todos
                        </a>
                    </div>
                </div>
                @endif

                <!-- Tabla responsive -->
                <div class="rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800/50 shadow-sm overflow-hidden">
                    <div class="mobile-scroll">
                        <table class="w-full text-xs mobile-table text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700/50 dark:text-gray-400">
                                <tr>
                                    <th class="px-2 xs:px-3 py-2">ID</th>
                                    <th class="px-2 xs:px-3 py-2 hidden sm:table-cell">Sucursal/Área</th>
                                    <th class="px-2 xs:px-3 py-2 hidden lg:table-cell">Razón Social</th>
                                    <th class="px-2 xs:px-3 py-2">Código</th>
                                    <th class="px-2 xs:px-3 py-2 hidden md:table-cell">Marca</th>
                                    <th class="px-2 xs:px-3 py-2 hidden xl:table-cell">Modelo</th>
                                    <th class="px-2 xs:px-3 py-2 hidden xl:table-cell">SD</th>
                                    <th class="px-2 xs:px-3 py-2 hidden lg:table-cell">RAM</th>
                                    <th class="px-2 xs:px-3 py-2 hidden 2xl:table-cell">Procesador</th>
                                    <th class="px-2 xs:px-3 py-2">Asignado</th>
                                    <th class="px-2 xs:px-3 py-2">Estado</th>
                                    <th class="px-2 xs:px-3 py-2 hidden md:table-cell">Alertas</th>
                                    <th class="px-2 xs:px-3 py-2 text-right">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($activos as $activo)
                                    @php
                                        $estadoColor = $activo->estado == 'Activo' ? 'bg-secondary' : 
                                                      ($activo->estado == 'En Reparación' ? 'bg-orange-500' : 'bg-gray-500');
                                        $estadoTexto = $activo->estado;
                                    @endphp
                                    <tr class="bg-white dark:bg-gray-800/50 hover:bg-gray-50 dark:hover:bg-gray-700/50 border-b dark:border-gray-700">
                                        <td class="px-2 xs:px-3 py-2 font-medium text-gray-900 dark:text-white">{{ $loop->iteration }}</td>
                                        <td class="px-2 xs:px-3 py-2 max-w-24 truncate hidden sm:table-cell" title="{{ $activo->sucursal_area }}">{{ $activo->sucursal_area }}</td>
                                        <td class="px-2 xs:px-3 py-2 max-w-24 truncate hidden lg:table-cell" title="{{ $activo->razon_social }}">{{ $activo->razon_social }}</td>
                                        <td class="px-2 xs:px-3 py-2 font-mono text-xs" title="{{ $activo->codigo_barras }}">{{ Str::limit($activo->codigo_barras, 8) }}</td>
                                        <td class="px-2 xs:px-3 py-2 hidden md:table-cell">{{ $activo->marca }}</td>
                                        <td class="px-2 xs:px-3 py-2 max-w-20 truncate hidden xl:table-cell" title="{{ $activo->modelo }}">{{ $activo->modelo }}</td>
                                        <td class="px-2 xs:px-3 py-2 hidden xl:table-cell">{{ $activo->sd }}</td>
                                        <td class="px-2 xs:px-3 py-2 hidden lg:table-cell">{{ $activo->ram }}</td>
                                        <td class="px-2 xs:px-3 py-2 max-w-20 truncate hidden 2xl:table-cell" title="{{ $activo->procesador }}">{{ $activo->procesador }}</td>
                                        <td class="px-2 xs:px-3 py-2 max-w-20 truncate" title="{{ $activo->asignado }}">
                                            {{ $activo->asignado ? Str::limit($activo->asignado, 10) : 'Sin asignar' }}
                                        </td>
                                        <td class="px-2 xs:px-3 py-2">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium 
                                                {{ $activo->estado == 'Activo' ? 'bg-secondary/10 text-secondary-800 dark:bg-secondary/20 dark:text-secondary-300' : 
                                                   ($activo->estado == 'En Reparación' ? 'bg-orange-500/10 text-orange-800 dark:bg-orange-500/20 dark:text-orange-300' : 
                                                   'bg-gray-500/10 text-gray-800 dark:bg-gray-600/20 dark:text-gray-300') }}">
                                                <span class="w-1.5 h-1.5 mr-1 rounded-full {{ $estadoColor }}"></span>
                                                <span class="hidden xs:inline">{{ $estadoTexto }}</span>
                                                <span class="xs:hidden">{{ Str::limit($estadoTexto, 1) }}</span>
                                            </span>
                                        </td>
                                        <td class="px-2 xs:px-3 py-2 hidden md:table-cell">
                                            @if($activo->alertas_count > 0)
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 dark:bg-red-900/40 text-red-800 dark:text-red-300">
                                                    <span class="material-symbols-outlined text-xs mr-1">warning</span>
                                                    {{ $activo->alertas_count }}
                                                </span>
                                            @else
                                                <span class="text-gray-400 dark:text-gray-600">-</span>
                                            @endif
                                        </td>
                                        <td class="px-2 xs:px-3 py-2 text-right">
                                            <div class="flex items-center justify-end gap-x-1">
                                                <a href="{{ route('activos.show', $activo) }}" class="p-1 rounded-md text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-800 dark:hover:text-gray-200 transition-colors" title="Ver">
                                                    <span class="material-symbols-outlined text-sm">visibility</span>
                                                </a>
                                                <a href="{{ route('activos.edit', $activo) }}" class="p-1 rounded-md text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-800 dark:hover:text-gray-200 transition-colors" title="Editar">
                                                    <span class="material-symbols-outlined text-sm">edit</span>
                                                </a>
                                                <form action="{{ route('activos.destroy', $activo) }}" method="POST" class="inline">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" onclick="return confirm('¿Eliminar este activo?')"
                                                            class="p-1 rounded-md text-gray-500 dark:text-gray-400 hover:bg-red-50 dark:hover:bg-red-900/40 hover:text-red-600 dark:hover:text-red-500 transition-colors" title="Eliminar">
                                                        <span class="material-symbols-outlined text-sm">delete</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="13" class="text-center py-8 text-gray-500 dark:text-gray-400">
                                            No se encontraron activos.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Paginación -->
                <div class="flex flex-col xs:flex-row items-center justify-between gap-3 mt-4">
                    <span class="text-sm text-gray-600 dark:text-gray-400 text-center xs:text-left">
                        Mostrando {{ $activos->firstItem() }}-{{ $activos->lastItem() }} de {{ $activos->total() }} activos
                    </span>
                    <div class="flex items-center justify-center xs:justify-end">
                        <div class="text-xs">
                            {{ $activos->appends(request()->query())->links('pagination::tailwind') }}
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- ===================================== -->
<!-- MODAL PARA AÑADIR ACTIVO -->
<!-- ===================================== -->
<div id="createModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-3 xs:p-4">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto mx-2">
        <div class="flex items-center justify-between p-4 xs:p-6 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg xs:text-xl font-bold">Añadir Nuevo Activo</h2>
            <button type="button" id="closeModal" class="p-1 xs:p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <form id="createForm" action="{{ route('activos.store') }}" method="POST" class="p-4 xs:p-6 space-y-4 xs:space-y-6">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 xs:gap-6">
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium mb-2">Sucursal/Área *</label>
                    <input name="sucursal_area" required class="w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:ring-2 focus:ring-primary/50 focus:border-primary" placeholder="Ej: WTC/Contabilidad">
                    <p class="text-red-500 text-xs mt-1 hidden"></p>
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium mb-2">Razón Social *</label>
                    <input name="razon_social" required class="w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:ring-2 focus:ring-primary/50 focus:border-primary" placeholder="Ej: Metropolitano">
                    <p class="text-red-500 text-xs mt-1 hidden"></p>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Código de Barras *</label>
                    <input name="codigo_barras" required class="w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm font-mono focus:ring-2 focus:ring-primary/50 focus:border-primary" placeholder="Ej: KC285976">
                    <p class="text-red-500 text-xs mt-1 hidden"></p>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Marca *</label>
                    <input name="marca" required class="w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:ring-2 focus:ring-primary/50 focus:border-primary" placeholder="Ej: Lenovo">
                    <p class="text-red-500 text-xs mt-1 hidden"></p>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Modelo *</label>
                    <input name="modelo" required class="w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:ring-2 focus:ring-primary/50 focus:border-primary" placeholder="Ej: ThinkCentre NEO 50a">
                    <p class="text-red-500 text-xs mt-1 hidden"></p>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">SD *</label>
                    <input name="sd" required class="w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:ring-2 focus:ring-primary/50 focus:border-primary" placeholder="Ej: 512 GB">
                    <p class="text-red-500 text-xs mt-1 hidden"></p>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">RAM *</label>
                    <input name="ram" required class="w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:ring-2 focus:ring-primary/50 focus:border-primary" placeholder="Ej: 16 GB">
                    <p class="text-red-500 text-xs mt-1 hidden"></p>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Procesador *</label>
                    <input name="procesador" required class="w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:ring-2 focus:ring-primary/50 focus:border-primary" placeholder="Ej: Intel Core i5-12500H">
                    <p class="text-red-500 text-xs mt-1 hidden"></p>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Asignado</label>
                    <input name="asignado" class="w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:ring-2 focus:ring-primary/50 focus:border-primary" placeholder="Ej: Mariana Torres">
                    <p class="text-red-500 text-xs mt-1 hidden"></p>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Estado *</label>
                    <select name="estado" required class="w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:ring-2 focus:ring-primary/50 focus:border-primary">
                        <option value="Activo">Activo</option>
                        <option value="En Reparación">En Reparación</option>
                        <option value="Obsoleto">Obsoleto</option>
                    </select>
                </div>

                <!-- NUEVOS CAMPOS PARA ALERTAS -->
                <div>
                    <label class="block text-sm font-medium mb-2">Fecha Adquisición</label>
                    <input type="date" name="fecha_adquisicion" 
                           class="w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:ring-2 focus:ring-primary/50 focus:border-primary">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Vencimiento Garantía</label>
                    <input type="date" name="fecha_vencimiento_garantia" 
                           class="w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:ring-2 focus:ring-primary/50 focus:border-primary">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Proveedor Garantía</label>
                    <input type="text" name="proveedor_garantia" 
                           class="w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:ring-2 focus:ring-primary/50 focus:border-primary" 
                           placeholder="Ej: Dell, Lenovo, HP">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Último Mantenimiento</label>
                    <input type="date" name="ultimo_mantenimiento" 
                           class="w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:ring-2 focus:ring-primary/50 focus:border-primary">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Próximo Mantenimiento</label>
                    <input type="date" name="proximo_mantenimiento" 
                           class="w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:ring-2 focus:ring-primary/50 focus:border-primary">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Frecuencia Mantenimiento (meses)</label>
                    <input type="number" name="frecuencia_mantenimiento_meses" value="6" min="1" max="24"
                           class="w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:ring-2 focus:ring-primary/50 focus:border-primary">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Estado Operativo</label>
                    <select name="estado_operativo" 
                            class="w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:ring-2 focus:ring-primary/50 focus:border-primary">
                        <option value="optimo">Óptimo</option>
                        <option value="degradado">Degradado</option>
                        <option value="critico">Crítico</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Fin Vida Útil</label>
                    <input type="date" name="fecha_fin_vida_util" 
                           class="w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:ring-2 focus:ring-primary/50 focus:border-primary">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Vida Útil (años)</label>
                    <input type="number" name="vida_util_anos" value="5" min="1" max="10"
                           class="w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:ring-2 focus:ring-primary/50 focus:border-primary">
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium mb-2">Observaciones</label>
                    <textarea name="observaciones" rows="3"
                              class="w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:ring-2 focus:ring-primary/50 focus:border-primary"
                              placeholder="Observaciones adicionales..."></textarea>
                </div>
            </div>

            <div class="flex flex-col xs:flex-row justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button type="button" id="cancelModal" class="px-4 xs:px-6 py-2 rounded-lg border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 order-2 xs:order-1">
                    Cancelar
                </button>
                <button type="submit" class="px-4 xs:px-6 py-2 bg-primary text-white rounded-lg font-medium hover:bg-primary/90 transition order-1 xs:order-2">
                    Guardar Activo
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ===================================== -->
<!-- MODAL DE FILTROS -->
<!-- ===================================== -->
<div id="filtersModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-3 xs:p-4">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-md max-h-[90vh] overflow-y-auto mx-2">
        <div class="flex items-center justify-between p-4 xs:p-6 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg xs:text-xl font-bold">Filtrar Activos</h2>
            <button type="button" id="closeFiltersModal" class="p-1 xs:p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <form id="filtersForm" method="GET" action="{{ route('activos.index') }}" class="p-4 xs:p-6 space-y-4 xs:space-y-6">
            <!-- Estado -->
            <div>
                <label class="block text-sm font-medium mb-2">Estado</label>
                <select name="estado" class="w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:ring-2 focus:ring-primary/50 focus:border-primary">
                    <option value="">Todos los estados</option>
                    <option value="Activo" {{ request('estado') == 'Activo' ? 'selected' : '' }}>Activo</option>
                    <option value="En Reparación" {{ request('estado') == 'En Reparación' ? 'selected' : '' }}>En Reparación</option>
                    <option value="Obsoleto" {{ request('estado') == 'Obsoleto' ? 'selected' : '' }}>Obsoleto</option>
                </select>
            </div>

            <!-- Marca -->
            <div>
                <label class="block text-sm font-medium mb-2">Marca</label>
                <input name="marca" value="{{ request('marca') }}" 
                       class="w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:ring-2 focus:ring-primary/50 focus:border-primary" 
                       placeholder="Ej: Lenovo, Dell, HP">
            </div>

            <!-- Sucursal/Área -->
            <div>
                <label class="block text-sm font-medium mb-2">Sucursal/Área</label>
                <input name="sucursal_area" value="{{ request('sucursal_area') }}" 
                       class="w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:ring-2 focus:ring-primary/50 focus:border-primary" 
                       placeholder="Ej: WTC/Contabilidad">
            </div>

            <!-- Asignado -->
            <div>
                <label class="block text-sm font-medium mb-2">Asignado a</label>
                <input name="asignado" value="{{ request('asignado') }}" 
                       class="w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:ring-2 focus:ring-primary/50 focus:border-primary" 
                       placeholder="Ej: Mariana Torres">
            </div>

            <div class="flex flex-col xs:flex-row justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button type="button" id="clearFilters" class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 text-sm order-2 xs:order-1">
                    Limpiar
                </button>
                <button type="submit" class="px-4 xs:px-6 py-2 bg-primary text-white rounded-lg font-medium hover:bg-primary/90 transition text-sm order-1 xs:order-2">
                    Aplicar Filtros
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ===================================== -->
<!-- JAVASCRIPT -->
<!-- ===================================== -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('createModal');
    const openBtn = document.getElementById('openCreateModal');
    const form = document.getElementById('createForm');
    const tbody = document.querySelector('tbody');

    // Modal de filtros
    const filtersModal = document.getElementById('filtersModal');
    const openFiltersBtn = document.getElementById('openFiltersModal');
    const filtersForm = document.getElementById('filtersForm');
    const clearFiltersBtn = document.getElementById('clearFilters');

    // Abrir modal de crear
    if (openBtn) {
        openBtn.onclick = function(e) {
            e.preventDefault();
            modal.classList.remove('hidden');
            form.reset();
            form.querySelectorAll('.text-red-500').forEach(el => el.classList.add('hidden'));
        };
    }

    // Cerrar modal de crear
    document.querySelectorAll('#closeModal, #cancelModal').forEach(btn => {
        btn.onclick = () => modal.classList.add('hidden');
    });

    // Abrir modal de filtros
    if (openFiltersBtn) {
        openFiltersBtn.onclick = function(e) {
            e.preventDefault();
            filtersModal.classList.remove('hidden');
        };
    }

    // Cerrar modal de filtros
    document.querySelectorAll('#closeFiltersModal').forEach(btn => {
        btn.onclick = () => filtersModal.classList.add('hidden');
    });

    // Limpiar filtros
    if (clearFiltersBtn) {
        clearFiltersBtn.onclick = () => {
            window.location.href = "{{ route('activos.index') }}";
        };
    }

    // Generar alertas automáticas
    document.getElementById('generarAlertasBtn')?.addEventListener('click', function() {
        if (confirm('¿Generar alertas automáticas? Esto buscará garantías próximas a vencer, mantenimientos pendientes, etc.')) {
            const btn = this;
            const original = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = 'Generando...';

            fetch("{{ route('alertas.generar.automaticas') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Toast de éxito
                const toast = document.createElement('div');
                toast.className = 'fixed bottom-4 right-4 bg-green-600 text-white px-4 py-3 rounded-xl shadow-2xl flex items-center gap-2 z-50 text-sm';
                toast.innerHTML = '<span class="material-symbols-outlined text-base">check_circle</span> ' + (data.message || 'Alertas generadas correctamente');
                document.body.appendChild(toast);
                setTimeout(() => toast.remove(), 4000);

                // Recargar la página para ver las nuevas alertas
                setTimeout(() => window.location.reload(), 1000);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al generar alertas');
            })
            .finally(() => {
                btn.disabled = false;
                btn.innerHTML = original;
            });
        }
    });

    // Enviar formulario de crear
    if (form) {
        form.onsubmit = function(e) {
            e.preventDefault();

            const btn = this.querySelector('button[type="submit"]');
            const original = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = 'Guardando...';

            // Limpiar errores
            this.querySelectorAll('.text-red-500').forEach(el => {
                el.classList.add('hidden');
                el.textContent = '';
            });

            const formData = new FormData(this);

            fetch("{{ route('activos.store') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                console.log('Status:', response.status);
                if (!response.ok) {
                    return response.json().then(err => { throw err; });
                }
                return response.json();
            })
            .then(data => {
                console.log('Respuesta:', data);

                if (data.success) {
                    // INSERTAR FILA
                    const estadoColor = data.activo.estado === 'Activo' ? 'bg-secondary' : 
                                      (data.activo.estado === 'En Reparación' ? 'bg-orange-500' : 'bg-gray-500');

                    const newRow = `
                        <tr class="bg-white dark:bg-gray-800/50 border-b dark:border-gray-700" data-id="${data.activo.id}">
                            <td class="px-2 xs:px-3 py-2 font-medium text-gray-900 dark:text-white">Nuevo</td>
                            <td class="px-2 xs:px-3 py-2 max-w-24 truncate hidden sm:table-cell">${data.activo.sucursal_area}</td>
                            <td class="px-2 xs:px-3 py-2 max-w-24 truncate hidden lg:table-cell">${data.activo.razon_social}</td>
                            <td class="px-2 xs:px-3 py-2 font-mono text-xs">${data.activo.codigo_barras}</td>
                            <td class="px-2 xs:px-3 py-2 hidden md:table-cell">${data.activo.marca}</td>
                            <td class="px-2 xs:px-3 py-2 max-w-20 truncate hidden xl:table-cell">${data.activo.modelo}</td>
                            <td class="px-2 xs:px-3 py-2 hidden xl:table-cell">${data.activo.sd}</td>
                            <td class="px-2 xs:px-3 py-2 hidden lg:table-cell">${data.activo.ram}</td>
                            <td class="px-2 xs:px-3 py-2 max-w-20 truncate hidden 2xl:table-cell">${data.activo.procesador}</td>
                            <td class="px-2 xs:px-3 py-2 max-w-20 truncate">${data.activo.asignado || 'Sin asignar'}</td>
                            <td class="px-2 xs:px-3 py-2">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium 
                                    ${data.activo.estado === 'Activo' ? 'bg-secondary/10 text-secondary-800 dark:bg-secondary/20 dark:text-secondary-300' : 
                                      (data.activo.estado === 'En Reparación' ? 'bg-orange-500/10 text-orange-800 dark:bg-orange-500/20 dark:text-orange-300' : 
                                      'bg-gray-500/10 text-gray-800 dark:bg-gray-600/20 dark:text-gray-300')}">
                                    <span class="w-1.5 h-1.5 mr-1 rounded-full ${estadoColor}"></span>
                                    <span class="hidden xs:inline">${data.activo.estado}</span>
                                    <span class="xs:hidden">${data.activo.estado.charAt(0)}</span>
                                </span>
                            </td>
                            <td class="px-2 xs:px-3 py-2 hidden md:table-cell">
                                <span class="text-gray-400 dark:text-gray-600">-</span>
                            </td>
                            <td class="px-2 xs:px-3 py-2 text-right">
                                <div class="flex items-center justify-end gap-x-1">
                                    <a href="/activos/${data.activo.id}" class="p-1 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <span class="material-symbols-outlined text-sm">visibility</span>
                                    </a>
                                    <a href="/activos/${data.activo.id}/edit" class="p-1 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <span class="material-symbols-outlined text-sm">edit</span>
                                    </a>
                                    <form action="/activos/${data.activo.id}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Eliminar?')" class="p-1 rounded-md hover:bg-red-50 dark:hover:bg-red-900/40">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>`;

                    if (tbody) {
                        tbody.insertAdjacentHTML('afterbegin', newRow);
                    }
                    modal.classList.add('hidden');

                    // Toast
                    const toast = document.createElement('div');
                    toast.className = 'fixed bottom-4 right-4 bg-green-600 text-white px-4 py-3 rounded-xl shadow-2xl flex items-center gap-2 z-50 text-sm';
                    toast.innerHTML = '<span class="material-symbols-outlined text-base">check_circle</span> ¡Activo guardado!';
                    document.body.appendChild(toast);
                    setTimeout(() => toast.remove(), 4000);
                }
            })
            .catch(error => {
                console.error('Error completo:', error);
                if (error.errors) {
                    Object.keys(error.errors).forEach(key => {
                        const input = form.querySelector(`[name="${key}"]`);
                        if (input) {
                            const errEl = input.parentNode.querySelector('.text-red-500');
                            if (errEl) {
                                errEl.textContent = error.errors[key][0];
                                errEl.classList.remove('hidden');
                            }
                        }
                    });
                } else {
                    alert('Error del servidor. Revisa la consola (F12).');
                }
            })
            .finally(() => {
                btn.disabled = false;
                btn.innerHTML = original;
            });
        };
    }
});
</script>

<!-- Sidebar móvil -->
<script>
    const sidebar = document.getElementById('sidebar');
    const openBtn = document.getElementById('openSidebar');
    const closeBtn = document.getElementById('closeSidebar');
    const overlay = document.getElementById('overlay');

    openBtn?.addEventListener('click', () => {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
    });

    closeBtn?.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    });

    overlay?.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    });
</script>
</body>
</html>