<!DOCTYPE html>
<html class="dark" lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Gestión de inventario de TI</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#62c443",
                        "primary-dark": "#005850",
                        "secondary": "#00868a",
                        "accent": "#7ac5c7",
                        "neutral": "#05553c",
                        "success": "#01a48b",
                        "info": "#007a63",
                        "background-light": "#f6f7f8",
                        "background-dark": "#101922",
                    },
                    fontFamily: { "display": ["Inter", "sans-serif"] },
                    borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display">
<div class="relative flex h-auto min-h-screen w-full">
    <!-- Sidebar -->
    <aside class="flex flex-col w-64 bg-background-light dark:bg-background-dark border-r border-gray-200 dark:border-primary-dark/50">
        <div class="flex items-center gap-4 px-6 h-16 border-b border-gray-200 dark:border-primary-dark/50">
            <img src="{{ asset('images/pmn.png') }}" alt="Logo Inventario TI" class="h-8 w-8 object-contain"/>
            <h2 class="text-lg font-bold leading-tight tracking-[-0.015em] text-black dark:text-white">Gestión de TI</h2>
        </div>
        <nav class="flex-1 px-4 py-4">
            <ul class="flex flex-col gap-2">
                <li><a class="flex items-center gap-3 rounded-lg px-4 py-2 text-gray-500 dark:text-accent hover:bg-gray-100 dark:hover:bg-primary-dark/50" href="{{ route('activos.index') }}">
                    <span class="material-symbols-outlined">home</span>
                    <span class="text-sm font-medium">Inicio</span>
                </a></li>
                <li><a class="flex items-center gap-3 rounded-lg px-4 py-2 text-primary bg-primary/10 dark:bg-primary-dark dark:text-white" href="{{ route('activos.index') }}">
                    <span class="material-symbols-outlined">inventory</span>
                    <span class="text-sm font-medium">Inventario</span>
                </a></li>
                <li><a class="flex items-center gap-3 rounded-lg px-4 py-2 text-gray-500 dark:text-accent hover:bg-gray-100 dark:hover:bg-primary-dark/50" href="{{ route('dashboard') }}">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span class="text-sm font-medium">Dashboard</span>
                </a></li>
                <li><a class="flex items-center gap-3 rounded-lg px-4 py-2 text-gray-500 dark:text-accent hover:bg-gray-100 dark:hover:bg-primary-dark/50" href="{{ route('usuarios.index') }}">
                    <span class="material-symbols-outlined">group</span>
                    <span class="text-sm font-medium">Gestión de Usuarios</span>
                </a></li>
                <li><a class="flex items-center gap-3 rounded-lg px-4 py-2 text-gray-500 dark:text-accent hover:bg-gray-100 dark:hover:bg-primary-dark/50" href="{{ route('alertas.index') }}">
                    <span class="material-symbols-outlined">notifications</span>
                    <span class="text-sm font-medium">Alertas</span>
                </a></li>
                <li><a class="flex items-center gap-3 rounded-lg px-4 py-2 text-gray-500 dark:text-accent hover:bg-gray-100 dark:hover:bg-primary-dark/50" href="{{ route('reportes.index') }}">
                    <span class="material-symbols-outlined">analytics</span>
                    <span class="text-sm font-medium">Reportes</span>
                </a></li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Header -->
        <header class="flex items-center justify-end whitespace-nowrap border-b border-solid dark:border-b-primary-dark/50 border-b-gray-200 px-10 py-3 h-16">
            <div class="flex items-center gap-4">
                <button id="openModalBtn" class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold leading-normal tracking-[0.015em]">
                    <span class="truncate">Agregar Nuevo Activo</span>
                </button>
                <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" style='background-image: url("{{ auth()->user()->avatar ?? "https://ui-avatars.com/api/?name=" . urlencode(auth()->user()->name) }}");'></div>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" aria-label="Cerrar sesión" class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-200 dark:bg-primary-dark text-black dark:text-white hover:bg-gray-300 dark:hover:bg-primary-dark/80" title="Cerrar sesión">
                        <span class="material-symbols-outlined">logout</span>
                    </button>
                </form>
            </div>
        </header>

        <main class="px-10 py-5 flex-1 bg-background-light dark:bg-background-dark">
            <div class="flex flex-col gap-6">
                <!-- Título + Flecha -->
                <div class="flex flex-wrap justify-between items-center gap-3">
                    <div class="flex items-center gap-4">
                        <a href="{{ url()->previous() }}" class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-200 dark:bg-primary-dark text-black dark:text-white hover:bg-gray-300 dark:hover:bg-primary-dark/80">
 <span class="material-symbols-outlined">arrow_back</span>
                        </a>
                        <div class="flex flex-col gap-1">
                            <p class="text-black dark:text-white text-3xl font-bold leading-tight tracking-[-0.033em]">Inventario de Activos de TI</p>
                            <p class="text-gray-500 dark:text-accent text-base font-normal leading-normal">Una lista detallada de todos los activos de TI.</p>
                        </div>
                    </div>
                </div>

                <!-- Búsqueda + Filtros FUNCIONALES -->
                <form method="GET" action="{{ route('activos.index') }}" class="flex flex-col gap-4">
                    <div class="flex items-center gap-4">
                        <div class="flex-1">
                            <label class="flex flex-col min-w-40 h-12 w-full">
                                <div class="flex w-full flex-1 items-stretch rounded-lg h-full">
                                    <div class="text-gray-500 dark:text-accent flex border-none bg-gray-100 dark:bg-primary-dark items-center justify-center pl-4 rounded-l-lg border-r-0">
                                        <span class="material-symbols-outlined">search</span>
                                    </div>
                                    <input name="search" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-r-lg text-black dark:text-white focus:outline-0 focus:ring-0 border-none bg-gray-100 dark:bg-primary-dark focus:border-none h-full placeholder:text-gray-500 placeholder:dark:text-accent px-4 text-base font-normal leading-normal"
                                        placeholder="Buscar por nombre, serial, código de barras, marca, modelo, procesador, asignado..." value="{{ request('search') }}"/>
                                </div>
                            </label>
                        </div>

                        <div class="flex gap-3 overflow-x-auto">
                            <select name="tipo" class="h-12 px-4 rounded-lg bg-gray-100 dark:bg-primary-dark text-black dark:text-white text-sm">
                                <option value="">Tipo de Activo</option>
                                @foreach($tiposList as $tipo)
                                    <option value="{{ $tipo }}" {{ request('tipo') == $tipo ? 'selected' : '' }}>{{ $tipo }}</option>
                                @endforeach
                            </select>

                            <select name="estado" class="h-12 px-4 rounded-lg bg-gray-100 dark:bg-primary-dark text-black dark:text-white text-sm">
                                <option value="">Estado</option>
                                <option value="Activo" {{ request('estado') == 'Activo' ? 'selected' : '' }}>Activo</option>
                                <option value="En Reparación" {{ request('estado') == 'En Reparación' ? 'selected' : '' }}>En Reparación</option>
                                <option value="Retirado" {{ request('estado') == 'Retirado' ? 'selected' : '' }}>Retirado</option>
                            </select>

                            <select name="marca" class="h-12 px-4 rounded-lg bg-gray-100 dark:bg-primary-dark text-black dark:text-white text-sm">
                                <option value="">Marca</option>
                                @foreach($marcasList as $marca)
                                    <option value="{{ $marca }}" {{ request('marca') == $marca ? 'selected' : '' }}>{{ $marca }}</option>
                                @endforeach
                            </select>

                            <select name="modelo" class="h-12 px-4 rounded-lg bg-gray-100 dark:bg-primary-dark text-black dark:text-white text-sm">
                                <option value="">Modelo</option>
                                @foreach($modelosList as $modelo)
                                    <option value="{{ $modelo }}" {{ request('modelo') == $modelo ? 'selected' : '' }}>{{ $modelo }}</option>
                                @endforeach
                            </select>

                            <select name="sucursal" class="h-12 px-4 rounded-lg bg-gray-100 dark:bg-primary-dark text-black dark:text-white text-sm">
                                <option value="">Sucursal</option>
                                @foreach($sucursalesList as $suc)
                                    <option value="{{ $suc }}" {{ request('sucursal') == $suc ? 'selected' : '' }}>{{ $suc }}</option>
                                @endforeach
                            </select>

                            <button type="submit" class="flex h-12 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-primary/20 dark:bg-primary px-4 text-primary dark:text-white">
                                <p class="text-sm font-medium leading-normal">Aplicar Filtros</p>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Tabla con TODAS las columnas nuevas -->
                <div class="overflow-hidden rounded-lg border dark:border-primary-dark/50 border-gray-200 bg-background-light dark:bg-background-dark">
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[2500px]">
                            <thead>
                                <tr class="bg-gray-50 dark:bg-primary-dark">
                                    <th class="px-4 py-3 text-left text-black dark:text-white text-sm font-medium leading-normal">ID</th>
                                    <th class="px-4 py-3 text-left text-black dark:text-white text-sm font-medium leading-normal">Sucursal/Área</th>
                                    <th class="px-4 py-3 text-left text-black dark:text-white text-sm font-medium leading-normal">Razón Social</th>
                                    <th class="px-4 py-3 text-left text-black dark:text-white text-sm font-medium leading-normal">Código de Barras</th>
                                    <th class="px-4 py-3 text-left text-black dark:text-white text-sm font-medium leading-normal">Nombre</th>
                                    <th class="px-4 py-3 text-left text-black dark:text-white text-sm font-medium leading-normal">Marca</th>
                                    <th class="px-4 py-3 text-left text-black dark:text-white text-sm font-medium leading-normal">Modelo</th>
                                    <th class="px-4 py-3 text-left text-black dark:text-white text-sm font-medium leading-normal">SSD</th>
                                    <th class="px-4 py-3 text-left text-black dark:text-white text-sm font-medium leading-normal">RAM</th>
                                    <th class="px-4 py-3 text-left text-black dark:text-white text-sm font-medium leading-normal">Procesador</th>
                                    <th class="px-4 py-3 text-left text-black dark:text-white text-sm font-medium leading-normal">Serial</th>
                                    <th class="px-4 py-3 text-left text-black dark:text-white text-sm font-medium leading-normal">Estado</th>
                                    <th class="px-4 py-3 text-left text-black dark:text-white text-sm font-medium leading-normal">Asignado a</th>
                                    <th class="px-4 py-3 text-left text-black dark:text-white text-sm font-medium leading-normal">Compra</th>
                                    <th class="px-4 py-3 text-left text-black dark:text-white text-sm font-medium leading-normal">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y dark:divide-primary-dark/50 divide-gray-200">
                                @forelse ($activos as $activo)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-primary-dark/20">
                                        <td class="px-4 py-3 text-gray-500 dark:text-accent text-sm">{{ $activo->id }}</td>
                                        <td class="px-4 py-3 text-sm">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-300">
                                                {{ $activo->sucursal_area }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-gray-500 dark:text-accent text-sm">{{ $activo->razon_social }}</td>
                                        <td class="px-4 py-3 font-mono text-xs text-gray-600 dark:text-accent">{{ $activo->codigo_barras }}</td>
                                        <td class="px-4 py-3 text-black dark:text-white text-sm font-medium">{{ $activo->nombre }}</td>
                                        <td class="px-4 py-3 text-sm">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 dark:bg-indigo-900/50 text-indigo-800 dark:text-indigo-300">
                                                {{ $activo->marca }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-black dark:text-white text-sm font-medium">{{ $activo->modelo }}</td>
                                        <td class="px-4 py-3 text-center text-green-700 dark:text-green-400 text-sm font-medium">{{ $activo->ssd }}</td>
                                        <td class="px-4 py-3 text-center text-purple-700 dark:text-purple-400 text-sm font-medium">{{ $activo->ram }}</td>
                                        <td class="px-4 py-3 text-gray-600 dark:text-accent text-xs">{{ $activo->procesador }}</td>
                                        <td class="px-4 py-3 text-gray-500 dark:text-accent text-sm">{{ $activo->serial }}</td>
                                        <td class="px-4 py-3 text-sm">
                                            @php
                                                $estadoClasses = [
                                                    'Activo' => 'bg-green-100 dark:bg-success/20 text-green-800 dark:text-green-200',
                                                    'En Reparación' => 'bg-orange-100 dark:bg-orange-900/50 text-orange-800 dark:text-orange-300',
                                                    'Retirado' => 'bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-300',
                                                ];
                                            @endphp
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $estadoClasses[$activo->estado] ?? 'bg-gray-100 dark:bg-primary-dark text-black dark:text-white' }}">
                                                {{ $activo->estado }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-black dark:text-white text-sm font-medium">
                                            {{ $activo->asignado_a ?? ($activo->user?->name ?? 'N/A') }}
                                        </td>
                                        <td class="px-4 py-3 text-gray-500 dark:text-accent text-sm">
                                            {{ $activo->fecha_compra?->format('d/m/Y') ?? 'N/A' }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            <div class="flex items-center gap-2">
                                                <a href="{{ route('activos.edit', $activo->id) }}" class="p-1 text-gray-500 dark:text-accent hover:text-primary" title="Editar">
                                                    <span class="material-symbols-outlined">edit</span>
                                                </a>
                                                <a href="{{ route('activos.show', $activo->id) }}" class="p-1 text-gray-500 dark:text-accent hover:text-primary" title="Ver">
                                                    <span class="material-symbols-outlined">visibility</span>
                                                </a>
                                                <form action="{{ route('activos.destroy', $activo->id) }}" method="POST" class="inline">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" onclick="return confirm('¿Eliminar este activo?')" class="p-1 text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300" title="Eliminar">
                                                        <span class="material-symbols-outlined">delete</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="15" class="px-4 py-3 text-center text-gray-500 dark:text-accent text-sm">
                                            No hay activos registrados.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="p-4">{{ $activos->appends(request()->query())->links() }}</div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Modal con TODOS los campos nuevos -->
<div class="fixed inset-0 bg-black bg-opacity-50 hidden z-50" id="modal">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white dark:bg-background-dark p-6 rounded-lg shadow-lg w-full max-w-4xl max-h-screen overflow-y-auto">
            <h2 class="text-xl font-bold text-black dark:text-white mb-4">Agregar Nuevo Activo</h2>
            <form action="{{ route('activos.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><label class="block text-sm font-medium text-gray-700 dark:text-accent">Nombre del Activo</label><input type="text" name="nombre" required class="mt-1 block w-full border-gray-300 dark:border-primary-dark rounded-md shadow-sm"></div>
                    <div><label class="block text-sm font-medium text-gray-700 dark:text-accent">Tipo</label><input type="text" name="tipo" value="Computadora" required class="mt-1 block w-full border-gray-300 dark:border-primary-dark rounded-md shadow-sm"></div>
                    <div><label class="block text-sm font-medium text-gray-700 dark:text-accent">Sucursal</label><input type="text" name="sucursal" required class="mt-1 block w-full border-gray-300 dark:border-primary-dark rounded-md shadow-sm"></div>
                    <div><label class="block text-sm font-medium text-gray-700 dark:text-accent">Sucursal/Área</label><input type="text" name="sucursal_area" required class="mt-1 block w-full border-gray-300 dark:border-primary-dark rounded-md shadow-sm"></div>
                    <div><label class="block text-sm font-medium text-gray-700 dark:text-accent">Razón Social</label><input type="text" name="razon_social" required class="mt-1 block w-full border-gray-300 dark:border-primary-dark rounded-md shadow-sm"></div>
                    <div><label class="block text-sm font-medium text-gray-700 dark:text-accent">Código de Barras</label><input type="text" name="codigo_barras" required class="mt-1 block w-full border-gray-300 dark:border-primary-dark rounded-md shadow-sm font-mono"></div>
                    <div><label class="block text-sm font-medium text-gray-700 dark:text-accent">Marca</label><input type="text" name="marca" required class="mt-1 block w-full border-gray-300 dark:border-primary-dark rounded-md shadow-sm"></div>
                    <div><label class="block text-sm font-medium text-gray-700 dark:text-accent">Modelo</label><input type="text" name="modelo" required class="mt-1 block w-full border-gray-300 dark:border-primary-dark rounded-md shadow-sm"></div>
                    <div><label class="block text-sm font-medium text-gray-700 dark:text-accent">SSD</label><input type="text" name="ssd" placeholder="512 GB" class="mt-1 block w-full border-gray-300 dark:border-primary-dark rounded-md shadow-sm"></div>
                    <div><label class="block text-sm font-medium text-gray-700 dark:text-accent">RAM</label><input type="text" name="ram" placeholder="16 GB" class="mt-1 block w-full border-gray-300 dark:border-primary-dark rounded-md shadow-sm"></div>
                    <div><label class="block text-sm font-medium text-gray-700 dark:text-accent">Procesador</label><input type="text" name="procesador" class="mt-1 block w-full border-gray-300 dark:border-primary-dark rounded-md shadow-sm"></div>
                    <div><label class="block text-sm font-medium text-gray-700 dark:text-accent">Serial</label><input type="text" name="serial" required class="mt-1 block w-full border-gray-300 dark:border-primary-dark rounded-md shadow-sm font-mono"></div>
                    <div><label class="block text-sm font-medium text-gray-700 dark:text-accent">Asignado a</label><input type="text" name="asignado_a" class="mt-1 block w-full border-gray-300 dark:border-primary-dark rounded-md shadow-sm"></div>
                    <div><label class="block text-sm font-medium text-gray-700 dark:text-accent">Fecha de Compra</label><input type="date" name="fecha_compra" required class="mt-1 block w-full border-gray-300 dark:border-primary-dark rounded-md shadow-sm"></div>
                    <div><label class="block text-sm font-medium text-gray-700 dark:text-accent">Estado</label>
                        <select name="estado" required class="mt-1 block w-full border-gray-300 dark:border-primary-dark rounded-md shadow-sm">
                            <option value="Activo">Activo</option>
                            <option value="En Reparación">En Reparación</option>
                            <option value="Retirado">Retirado</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-end gap-2 mt-4">
                    <button type="button" id="closeModal" class="px-4 py-2 bg-gray-300 dark:bg-primary-dark text-black dark:text-white rounded-md">Cancelar</button>
                    <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const modal = document.getElementById('modal');
    const openBtn = document.getElementById('openModalBtn');
    const closeBtn = document.getElementById('closeModal');

    openBtn?.addEventListener('click', (e) => { e.preventDefault(); modal.classList.remove('hidden'); });
    closeBtn?.addEventListener('click', () => modal.classList.add('hidden'));
    modal?.addEventListener('click', (e) => { if (e.target === modal) modal.classList.add('hidden'); });
</script>
</body>
</html>