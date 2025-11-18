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
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 20;
        }
        .material-symbols-filled {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 20;
        }
        .table-auto { table-layout: auto; }
        .truncate { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-gray-800 dark:text-gray-200 min-h-screen">
<div class="flex flex-col lg:flex-row min-h-screen">

    <!-- Sidebar -->
    <aside id="sidebar" class="lg:w-64 w-full lg:block fixed lg:static inset-0 z-40 bg-white dark:bg-gray-900/50 border-r border-gray-200 dark:border-gray-800 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out shadow-sm">
        <div class="flex items-center justify-between lg:justify-start gap-4 px-6 h-16 border-b border-gray-200 dark:border-gray-800">
            <div class="flex items-center gap-2">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd" d="M12.0799 24L4 19.2479L9.95537 8.75216L18.04 13.4961L18.0446 4H29.9554L29.96 13.4961L38.0446 8.75216L44 19.2479L35.92 24L44 28.7521L38.0446 39.2479L29.96 34.5039L29.9554 44H18.0446L18.04 34.5039L9.95537 39.2479L4 28.7521L12.0799 24Z" fill="currentColor" fill-rule="evenodd"></path>
                </svg>
                <span class="text-xl font-bold text-primary">Inventario TI</span>
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
            <a href="{{ route('usuarios.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60">
                <span class="material-symbols-outlined">group</span>
                <span class="text-sm font-medium">Gestión de Usuarios</span>
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
        <header class="flex items-center justify-between px-4 lg:px-10 py-3 h-16 border-b border-gray-200 dark:border-gray-800 bg-white/80 dark:bg-gray-900/80 backdrop-blur-sm sticky top-0 z-10">
            <div class="flex items-center gap-4">
                <button id="openSidebar" class="lg:hidden">
                    <span class="material-symbols-outlined text-2xl">menu</span>
                </button>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white">Inventario de Activos</h1>
            </div>
            <div class="flex items-center gap-3">
                <button class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800/60">
                    <span class="material-symbols-outlined">notifications</span>
                </button>
                <div class="flex items-center gap-2 cursor-pointer">
                    <div class="bg-cover bg-center rounded-full size-9" 
                         style='background-image: url("{{ auth()->user()->avatar ?? "https://ui-avatars.com/api/?name=" . urlencode(auth()->user()->name) . "&background=005850&color=fff" }}");'>
                    </div>
                    <div class="hidden sm:block text-left">
                        <p class="text-sm font-semibold text-gray-800 dark:text-gray-100 truncate max-w-32">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate max-w-32">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="inline-flex items-center">
                    @csrf
                    <button type="submit" class="flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60 rounded-lg transition-colors">
                        <span class="material-symbols-outlined text-base">logout</span>
                        <span class="hidden sm:inline">Cerrar Sesión</span>
                    </button>
                </form>
            </div>
        </header>

        <!-- Main -->
        <main class="flex-1 p-4 lg:p-8 overflow-auto">
            <div class="max-w-full mx-auto">
                <!-- Búsqueda + Botón -->
                <div class="flex flex-wrap justify-between items-center gap-4 mb-8">
                    <div class="relative w-full max-w-sm">
                        <form method="GET" action="{{ route('activos.index') }}">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500">search</span>
                            <input name="search" value="{{ request('search') }}"
                                   class="w-full pl-10 pr-4 py-2 text-sm rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 focus:ring-2 focus:ring-primary/50 focus:border-primary dark:focus:border-primary"
                                   placeholder="Buscar por sucursal, código, usuario..." type="text"/>
                        </form>
                    </div>
                    <div class="flex items-center gap-3">
                        <button type="button" class="flex h-9 shrink-0 cursor-pointer items-center justify-center gap-2 overflow-hidden rounded-lg px-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/60 transition-colors shadow-sm">
                            <span class="material-symbols-outlined text-lg">filter_list</span>
                            <span class="truncate">Filtros</span>
                        </button>
                        <!-- BOTÓN QUE ABRE EL MODAL -->
                        <a href="#" id="openCreateModal"
                           class="flex shrink-0 cursor-pointer items-center justify-center gap-2 overflow-hidden rounded-lg h-9 px-4 bg-primary text-white text-sm font-medium hover:bg-primary/90 transition-colors shadow-sm">
                            <span class="material-symbols-outlined text-lg">add</span>
                            <span class="truncate">Añadir Activo</span>
                        </a>
                    </div>
                </div>

                <!-- Tabla con TODAS las columnas + ESTADO RESTAURADO -->
                <div class="rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800/50 shadow-sm overflow-x-auto">
                    <table class="w-full text-xs text-left text-gray-500 dark:text-gray-400 table-auto">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700/50 dark:text-gray-400">
                            <tr>
                                <th class="px-3 py-2">ID</th>
                                <th class="px-3 py-2">Sucursal/Área</th>
                                <th class="px-3 py-2">Razón Social</th>
                                <th class="px-3 py-2">Código de Barras</th>
                                <th class="px-3 py-2">Marca</th>
                                <th class="px-3 py-2">Modelo</th>
                                <th class="px-3 py-2">SD</th>
                                <th class="px-3 py-2">RAM</th>
                                <th class="px-3 py-2">Procesador</th>
                                <th class="px-3 py-2">Asignado</th>
                                <th class="px-3 py-2">Estado</th>
                                <th class="px-3 py-2 text-right">Acciones</th>
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
                                    <td class="px-3 py-2 font-medium text-gray-900 dark:text-white">{{ $loop->iteration }}</td>
                                    <td class="px-3 py-2 max-w-32 truncate" title="{{ $activo->sucursal_area }}">{{ $activo->sucursal_area }}</td>
                                    <td class="px-3 py-2 max-w-32 truncate" title="{{ $activo->razon_social }}">{{ $activo->razon_social }}</td>
                                    <td class="px-3 py-2 font-mono">{{ $activo->codigo_barras }}</td>
                                    <td class="px-3 py-2">{{ $activo->marca }}</td>
                                    <td class="px-3 py-2 max-w-40 truncate" title="{{ $activo->modelo }}">{{ $activo->modelo }}</td>
                                    <td class="px-3 py-2">{{ $activo->sd }}</td>
                                    <td class="px-3 py-2">{{ $activo->ram }}</td>
                                    <td class="px-3 py-2 max-w-32 truncate" title="{{ $activo->procesador }}">{{ $activo->procesador }}</td>
                                    <td class="px-3 py-2 max-w-32 truncate" title="{{ $activo->asignado }}">{{ $activo->asignado ?? 'Sin asignar' }}</td>
                                    <td class="px-3 py-2">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                            {{ $activo->estado == 'Activo' ? 'bg-secondary/10 text-secondary-800 dark:bg-secondary/20 dark:text-secondary-300' : 
                                               ($activo->estado == 'En Reparación' ? 'bg-orange-500/10 text-orange-800 dark:bg-orange-500/20 dark:text-orange-300' : 
                                               'bg-gray-500/10 text-gray-800 dark:bg-gray-600/20 dark:text-gray-300') }}">
                                            <span class="w-2 h-2 mr-2 rounded-full {{ $estadoColor }}"></span>
                                            {{ $estadoTexto }}
                                        </span>
                                    </td>
                                    <td class="px-3 py-2 text-right">
                                        <div class="flex items-center justify-end gap-x-1">
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
                                    <td colspan="12" class="text-center py-8 text-gray-500 dark:text-gray-400">
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

<!-- ===================================== -->
<!-- MODAL PARA AÑADIR ACTIVO (SIN RECARGAR) -->
<!-- ===================================== -->
<div id="createModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-xl font-bold">Añadir Nuevo Activo</h2>
            <button type="button" id="closeModal" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <form id="createForm" action="{{ route('activos.store') }}" method="POST" class="p-6 space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium mb-2">Sucursal/Área *</label>
                    <input name="sucursal_area" required class="w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:ring-2 focus:ring-primary/50 focus:border-primary" placeholder="Ej: WTC/Contabilidad">
                    <p class="text-red-500 text-xs mt-1 hidden"></p>
                </div>
                <div>
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
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button type="button" id="cancelModal" class="px-6 py-2 rounded-lg border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                    Cancelar
                </button>
                <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg font-medium hover:bg-primary/90 transition">
                    Guardar Activo
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ===================================== -->
<!-- JAVASCRIPT DEL MODAL (AJAX) -->
<!-- ===================================== -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('createModal');
    const openBtn = document.getElementById('openCreateModal');
    const form = document.getElementById('createForm');
    const tbody = document.querySelector('tbody');

    openBtn.onclick = e => {
        e.preventDefault();
        modal.classList.remove('hidden');
        form.reset();
        form.querySelectorAll('.text-red-500').forEach(el => el.classList.add('hidden'));
    };

    document.querySelectorAll('#closeModal, #cancelModal').forEach(btn => {
        btn.onclick = () => modal.classList.add('hidden');
    });

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
            console.log('Status:', response.status); // ← ESTO ES CLAVE PARA VER QUÉ PASA
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            console.log('Respuesta:', data); // ← AQUÍ VERÁS SI LLEGA EL SUCCESS

            if (data.success) {
                // INSERTAR FILA
                const estadoColor = data.activo.estado === 'Activo' ? 'bg-secondary' : 
                                  (data.activo.estado === 'En Reparación' ? 'bg-orange-500' : 'bg-gray-500');

                const newRow = `
                    <tr class="bg-white dark:bg-gray-800/50 border-b dark:border-gray-700" data-id="${data.activo.id}">
                        <td class="px-3 py-2 font-medium text-gray-900 dark:text-white">Nuevo</td>
                        <td class="px-3 py-2 max-w-32 truncate">${data.activo.sucursal_area}</td>
                        <td class="px-3 py-2 max-w-32 truncate">${data.activo.razon_social}</td>
                        <td class="px-3 py-2 font-mono">${data.activo.codigo_barras}</td>
                        <td class="px-3 py-2">${data.activo.marca}</td>
                        <td class="px-3 py-2 max-w-40 truncate">${data.activo.modelo}</td>
                        <td class="px-3 py-2">${data.activo.ssd}</td>
                        <td class="px-3 py-2">${data.activo.ram}</td>
                        <td class="px-3 py-2 max-w-32 truncate">${data.activo.procesador}</td>
                        <td class="px-3 py-2 max-w-32 truncate">${data.activo.asignado_a || 'Sin asignar'}</td>
                        <td class="px-3 py-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                ${data.activo.estado === 'Activo' ? 'bg-secondary/10 text-secondary-800 dark:bg-secondary/20 dark:text-secondary-300' : 
                                  (data.activo.estado === 'En Reparación' ? 'bg-orange-500/10 text-orange-800 dark:bg-orange-500/20 dark:text-orange-300' : 
                                  'bg-gray-500/10 text-gray-800 dark:bg-gray-600/20 dark:text-gray-300')}">
                                <span class="w-2 h-2 mr-2 rounded-full ${estadoColor}"></span>
                                ${data.activo.estado}
                            </span>
                        </td>
                        <td class="px-3 py-2 text-right">
                            <div class="flex items-center justify-end gap-x-1">
                                <a href="/activos/${data.activo.id}" class="p-1.5 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <span class="material-symbols-outlined text-base">visibility</span>
                                </a>
                                <a href="/activos/${data.activo.id}/edit" class="p-1.5 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <span class="material-symbols-outlined text-base">edit</span>
                                </a>
                                <form action="/activos/${data.activo.id}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('Eliminar?')" class="p-1.5 rounded-md hover:bg-red-50 dark:hover:bg-red-900/40">
                                        <span class="material-symbols-outlined text-base">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>`;

                tbody.insertAdjacentHTML('afterbegin', newRow);
                modal.classList.add('hidden');

                // Toast
                const toast = document.createElement('div');
                toast.className = 'fixed bottom-6 right-6 bg-green-600 text-white px-6 py-4 rounded-xl shadow-2xl flex items-center gap-3 z-50';
                toast.innerHTML = '<span class="material-symbols-outlined">check_circle</span> ¡Guardado!';
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
                alert('Error del servidor. Abre la consola (F12) y dime qué dice.');
            }
        })
        .finally(() => {
            btn.disabled = false;
            btn.innerHTML = original;
        });
    };
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