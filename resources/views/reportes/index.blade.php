<!DOCTYPE html>
<html class="dark" lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Generación de Informes</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#4ade80",
                        "background-light": "#f3f4f6",
                        "background-dark": "#111827",
                        "sidebar": "#1f2937",
                        "card": "#374151",
                        "accent": "#4b5563",
                        "subtle-accent": "#9ca3af",
                        "table-header": "#374151"
                    },
                    fontFamily: { "display": ["Inter", "sans-serif"] },
                    borderRadius: { "DEFAULT": "0.5rem", "lg": "0.75rem", "xl": "1rem", "full": "9999px" },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>
<body class="bg-background-dark font-display text-white">
<div class="relative flex h-auto min-h-screen w-full flex-col overflow-x-hidden">
    <div class="flex flex-grow">

        <!-- Sidebar -->
        <aside class="w-64 bg-sidebar p-4 flex flex-col justify-between hidden lg:flex">
            <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-2 mt-4">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-accent">
                        <span class="material-symbols-outlined text-subtle-accent">home</span>
                        <p class="text-subtle-accent text-sm font-medium">Inicio</p>
                    </a>
                    <a href="{{ route('inventario.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-accent">
                        <span class="material-symbols-outlined text-subtle-accent">inventory_2</span>
                        <p class="text-subtle-accent text-sm font-medium">Inventario</p>
                    </a>
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-accent">
                        <span class="material-symbols-outlined text-subtle-accent">dashboard</span>
                        <p class="text-subtle-accent text-sm font-medium">Dashboard</p>
                    </a>
                    <a href="{{ route('alertas.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-accent">
                        <span class="material-symbols-outlined text-subtle-accent">notifications</span>
                        <p class="text-subtle-accent text-sm font-medium">Alertas</p>
                    </a>
                    <a href="{{ route('reportes.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg bg-accent">
                        <span class="material-symbols-outlined text-white" style="font-variation-settings: 'FILL' 1">description</span>
                        <p class="text-white text-sm font-medium">Reportes</p>
                    </a>
                    <a href="{{ route('usuarios.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-accent">
                        <span class="material-symbols-outlined text-subtle-accent">group</span>
                        <p class="text-subtle-accent text-sm font-medium">Gestión de Usuarios</p>
                    </a>
                </div>
            </div>
            <div class="flex flex-col gap-4">
                <div class="w-full h-px bg-accent"></div>
                <div class="flex gap-3 items-center px-3">
                    <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
                         style='background-image: url("{{ auth()->user()->avatar ?? "https://ui-avatars.com/api/?name=" . urlencode(auth()->user()->name) }}");'></div>
                    <div class="flex flex-col">
                        <h2 class="text-white text-sm font-medium">{{ auth()->user()->name }}</h2>
                        <p class="text-subtle-accent text-xs">{{ auth()->user()->email }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="ml-auto p-2 rounded-lg hover:bg-accent">
                            <span class="material-symbols-outlined text-subtle-accent">logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 lg:p-10">
            <div class="max-w-7xl mx-auto">
                <div class="flex flex-col lg:flex-row gap-8">

                    <!-- Filtros -->
                    <div class="w-full lg:w-1/3 xl:w-1/4">
                        <div class="bg-sidebar p-6 rounded-xl">
                            <h2 class="text-white text-xl font-bold mb-6">Filtros</h2>
                            <form method="GET" action="{{ route('reportes.index') }}" class="flex flex-col gap-6">
                                <label class="flex flex-col">
                                    <p class="text-white text-base font-medium pb-2">Desde</p>
                                    <input type="date" name="fecha_desde" value="{{ request('fecha_desde') }}" class="form-input rounded-lg border border-accent bg-card text-white h-14 px-4">
                                </label>
                                <label class="flex flex-col">
                                    <p class="text-white text-base font-medium pb-2">Hasta</p>
                                    <input type="date" name="fecha_hasta" value="{{ request('fecha_hasta') }}" class="form-input rounded-lg border border-accent bg-card text-white h-14 px-4">
                                </label>
                                <label class="flex flex-col">
                                    <p class="text-white text-base font-medium pb-2">Tipo de Activo</p>
                                    <select name="tipo" class="form-select rounded-lg border border-accent bg-card text-white h-14 px-4">
                                        <option value="">Todos</option>
                                        <option value="Portátil" {{ request('tipo') == 'Portátil' ? 'selected' : '' }}>Portátil</option>
                                        <option value="Monitor" {{ request('tipo') == 'Monitor' ? 'selected' : '' }}>Monitor</option>
                                        <option value="Impresora" {{ request('tipo') == 'Impresora' ? 'selected' : '' }}>Impresora</option>
                                    </select>
                                </label>
                                <label class="flex flex-col">
                                    <p class="text-white text-base font-medium pb-2">Ubicación</p>
                                    <select name="ubicacion" class="form-select rounded-lg border border-accent bg-card text-white h-14 px-4">
                                        <option value="">Todas</option>
                                        <option value="Oficina" {{ request('ubicacion') == 'Oficina' ? 'selected' : '' }}>Oficina</option>
                                        <option value="Almacén" {{ request('ubicacion') == 'Almacén' ? 'selected' : '' }}>Almacén</option>
                                    </select>
                                </label>
                                <label class="flex flex-col">
                                    <p class="text-white text-base font-medium pb-2">Estado</p>
                                    <select name="estado" class="form-select rounded-lg border border-accent bg-card text-white h-14 px-4">
                                        <option value="">Todos</option>
                                        <option value="Activo" {{ request('estado') == 'Activo' ? 'selected' : '' }}>Activo</option>
                                        <option value="En Reparación" {{ request('estado') == 'En Reparación' ? 'selected' : '' }}>En Reparación</option>
                                        <option value="Retirado" {{ request('estado') == 'Retirado' ? 'selected' : '' }}>Retirado</option>
                                    </select>
                                </label>
                                <button type="submit" class="w-full h-12 rounded-lg bg-primary text-background-dark font-bold hover:bg-primary/90 transition">
                                    Generar Informe
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Tabla + Exportar -->
                    <div class="flex-1">
                        <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
                            <div>
                                <p class="text-4xl font-black tracking-tight">Informes de Inventario de TI</p>
                                <p class="text-subtle-accent">Total: {{ $activos->total() }} activos</p>
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ route('reportes.export', ['format' => 'pdf'] + request()->query()) }}"
                                   class="flex items-center gap-2 h-10 px-4 rounded-lg bg-card hover:bg-accent transition">
                                    <span class="material-symbols-outlined">picture_as_pdf</span>
                                    <span>PDF</span>
                                </a>
                                <a href="{{ route('reportes.export', ['format' => 'excel'] + request()->query()) }}"
                                   class="flex items-center gap-2 h-10 px-4 rounded-lg bg-card hover:bg-accent transition">
                                    <span class="material-symbols-outlined">receipt_long</span>
                                    <span>Excel</span>
                                </a>
                                <a href="{{ route('reportes.export', ['format' => 'csv'] + request()->query()) }}"
                                   class="flex items-center gap-2 h-10 px-4 rounded-lg bg-card hover:bg-accent transition">
                                    <span class="material-symbols-outlined">toc</span>
                                    <span>CSV</span>
                                </a>
                            </div>
                        </div>

                        <!-- Búsqueda -->
                        <div class="mb-4">
                            <form method="GET" action="{{ route('reportes.index') }}">
                                <div class="relative max-w-sm">
                                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-subtle-accent">search</span>
                                    <input name="search" value="{{ request('search') }}"
                                           class="w-full pl-10 pr-4 h-12 rounded-lg bg-card border border-accent focus:border-primary outline-none"
                                           placeholder="Buscar..." />
                                </div>
                            </form>
                        </div>

                        <!-- Tabla -->
                        <div class="bg-sidebar rounded-xl overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="w-full text-left text-sm">
                                    <thead class="bg-table-header uppercase text-xs">
                                        <tr>
                                            <th class="px-6 py-3">ID</th>
                                            <th class="px-6 py-3">Nombre</th>
                                            <th class="px-6 py-3">Tipo</th>
                                            <th class="px-6 py-3">Ubicación</th>
                                            <th class="px-6 py-3">Estado</th>
                                            <th class="px-6 py-3">Fecha Compra</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($activos as $activo)
                                        <tr class="border-b border-accent">
                                            <td class="px-6 py-4">{{ $activo->codigo }}</td>
                                            <td class="px-6 py-4 font-medium">{{ $activo->nombre }}</td>
                                            <td class="px-6 py-4">{{ $activo->tipo }}</td>
                                            <td class="px-6 py-4">{{ $activo->ubicacion }}</td>
                                            <td class="px-6 py-4">
                                                <span class="px-3 py-1 rounded-full text-xs font-medium
                                                    {{ $activo->estado == 'Activo' ? 'bg-green-500/20 text-green-400' : '' }}
                                                    {{ $activo->estado == 'En Reparación' ? 'bg-yellow-500/20 text-yellow-400' : '' }}
                                                    {{ $activo->estado == 'Retirado' ? 'bg-red-500/20 text-red-400' : '' }}">
                                                    {{ $activo->estado }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $activo->fecha_compra?->format('d/m/Y') ?? 'Sin fecha' }}
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-12 text-subtle-accent">No hay activos.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Paginación -->
                            <div class="flex justify-between items-center p-4 text-subtle-accent">
                                <span>Mostrando {{ $activos->firstItem() }} - {{ $activos->lastItem() }} de {{ $activos->total() }}</span>
                                {{ $activos->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
</body>
</html>