<!DOCTYPE html>
<html class="dark" lang="es">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Dashboard de Inventario de TI</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#005850",
                        secondary: "#62c443",
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
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 20; }
        .material-symbols-filled { font-variation-settings: 'FILL' 1; }
        .chart-bar { transition: all 0.3s ease; }
        .chart-bar:hover { transform: scaleY(1.1); }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-gray-800 dark:text-gray-200 min-h-screen">

<div class="flex flex-col lg:flex-row min-h-screen">

    <!-- Sidebar (colapsable en móvil) -->
    <aside id="sidebar" class="lg:w-64 w-full lg:block fixed lg:static inset-0 z-40 bg-white dark:bg-gray-900/50 border-r border-gray-200 dark:border-gray-800 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out shadow-sm">
        <div class="flex items-center justify-between lg:justify-start gap-4 px-6 h-16 border-b border-gray-200 dark:border-gray-800">
            <div class="flex items-center gap-2">
                <img src="{{ asset('images/pmn.png') }}" alt="Logo" class="h-8 w-8 object-contain"/>
                <span class="text-xl font-bold text-primary">Inventario TI</span>
            </div>
            <button id="closeSidebar" class="lg:hidden">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <nav class="p-4 space-y-2">
            <a href="{{ route('activos.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60">
                <span class="material-symbols-outlined">home</span>
                <span class="text-sm font-medium">Inicio</span>
            </a>
            <a href="{{ route('activos.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60">
                <span class="material-symbols-outlined">inventory_2</span>
                <span class="text-sm font-medium">Inventario</span>
            </a>
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-white bg-primary shadow-sm hover:bg-primary/90">
                <span class="material-symbols-filled">dashboard</span>
                <span class="text-sm font-semibold">Dashboard</span>
            </a>
            <a href="{{ route('alertas.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60">
                <span class="material-symbols-outlined">notifications_active</span>
                <span class="text-sm font-medium">Alertas</span>
            </a>
            <a href="{{ route('reportes.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60">
                <span class="material-symbols-outlined">assessment</span>
                <span class="text-sm font-medium">Reportes</span>
            </a>
            <a href="{{ route('usuarios.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60">
                <span class="material-symbols-outlined">group</span>
                <span class="text-sm font-medium">Usuarios</span>
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
                <h1 class="text-xl font-bold text-gray-900 dark:text-white">Dashboard</h1>
            </div>
            <div class="flex items-center gap-3">

                <!-- Notificaciones -->
                <button class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800/60">
                    <span class="material-symbols-outlined">notifications</span>
                </button>

                <!-- Usuario + Correo + Rol -->
                <div class="flex items-center gap-2 cursor-pointer">
                    <div class="bg-cover bg-center rounded-full size-9" 
                         style='background-image: url("{{ auth()->user()->avatar ?? "https://ui-avatars.com/api/?name=" . urlencode(auth()->user()->name) . "&background=005850&color=fff" }}");'>
                    </div>
                    <div class="hidden sm:block text-left">
                        <p class="text-sm font-semibold text-gray-800 dark:text-gray-100 truncate max-w-32">
                            {{ auth()->user()->name }}
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate max-w-32">
                            {{ auth()->user()->email }}
                        </p>
                        <p class="text-xs text-gray-400 dark:text-gray-500">Administrador</p>
                    </div>
                </div>

                <!-- Cerrar Sesión con texto -->
                <form method="POST" action="{{ route('logout') }}" class="inline-flex items-center">
                    @csrf
                    <button type="submit" class="flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60 rounded-lg transition-colors">
                        <span class="material-symbols-outlined text-base">logout</span>
                        <span class="hidden sm:inline">Cerrar Sesión</span>
                    </button>
                </form>
            </div>
        </header>

        <!-- Dashboard Content -->
        <main class="flex-1 p-4 lg:p-8 overflow-auto">
            <div class="max-w-full mx-auto space-y-6">

                <!-- Filtros (RESPONSIVE) -->
                <form method="GET" action="{{ route('dashboard') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                    <select name="sucursal" class="h-10 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-sm text-gray-700 dark:text-gray-300">
                        <option value="">Sucursal: Todas</option>
                        @foreach($sucursalesList as $suc)
                            <option value="{{ $suc }}" {{ request('sucursal') == $suc ? 'selected' : '' }}>{{ $suc }}</option>
                        @endforeach
                    </select>
                    <select name="tipo" class="h-10 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-sm text-gray-700 dark:text-gray-300">
                        <option value="">Tipo: Todos</option>
                        @foreach($tiposList as $tipo)
                            <option value="{{ $tipo }}" {{ request('tipo') == $tipo ? 'selected' : '' }}>{{ $tipo }}</option>
                        @endforeach
                    </select>
                    <select name="rango" class="h-10 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-sm text-gray-700 dark:text-gray-300">
                        <option value="30" {{ $rango == 30 ? 'selected' : '' }}>Últimos 30 días</option>
                        <option value="90" {{ $rango == 90 ? 'selected' : '' }}>Últimos 90 días</option>
                        <option value="365" {{ $rango == 365 ? 'selected' : '' }}>Último año</option>
                    </select>
                    <button type="submit" class="h-10 px-4 bg-primary text-white rounded-lg text-sm font-medium hover:bg-primary/90">
                        Aplicar
                    </button>
                </form>

                <!-- Tarjetas de resumen -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="p-5 bg-white dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700/50 rounded-xl shadow-md">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Total de Activos</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ $totalActivos }}</p>
                    </div>
                    <div class="p-5 bg-white dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700/50 rounded-xl shadow-md">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Sin Asignar</p>
                        <p class="text-3xl font-bold text-orange-600 dark:text-orange-400 mt-1">{{ $sinAsignar }}</p>
                    </div>
                    <div class="p-5 bg-white dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700/50 rounded-xl shadow-md">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Vencimientos ({{ $rango }} días)</p>
                        <p class="text-3xl font-bold text-red-600 dark:text-red-400 mt-1">{{ $vencimientosProximos }}</p>
                    </div>
                </div>

                <!-- Gráficos -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                    <!-- Izquierda: Barras -->
                    <div class="lg:col-span-8">
                        <div class="p-5 bg-white dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700/50 rounded-xl shadow-md">
                            <h3 class="text-lg font-semibold mb-4">Vencimientos de Garantía (próximos 6 meses)</h3>
                            <div class="h-56 flex items-end justify-between gap-2 px-2">
                                @foreach($vencimientosPorMes as $mes => $count)
                                    <div class="flex-1 flex flex-col items-center group">
                                        <div class="w-full bg-primary/20 dark:bg-primary/30 rounded-t-lg chart-bar transition-all group-hover:bg-primary/50" 
                                             style="height: {{ min($count * 10, 200) }}px;"></div>
                                        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">{{ $mes }}</p>
                                        <p class="text-xs font-medium text-primary">{{ $count }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Derecha: Donut + Barras -->
                    <div class="lg:col-span-4 space-y-6">

                        <!-- Donut: Sucursales -->
                        <div class="p-5 bg-white dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700/50 rounded-xl shadow-md">
                            <h3 class="text-lg font-semibold mb-4">Activos por Sucursal</h3>
                            <div class="relative w-36 h-36 mx-auto">
                                <svg class="w-full h-full" viewBox="0 0 36 36">
                                    @php
                                        $total = $activosPorSucursal->sum('count');
                                        $offset = 0;
                                        $colores = ['#00868a', '#01a48b', '#007a63', '#62c443', '#05553c'];
                                    @endphp
                                    @foreach($activosPorSucursal as $i => $item)
                                        @php
                                            $porcentaje = $total > 0 ? ($item->count / $total) * 100 : 0;
                                            $dasharray = $porcentaje . ', 100';
                                            $dashoffset = -($offset);
                                            $offset += $porcentaje;
                                        @endphp
                                        <circle cx="18" cy="18" r="15.9155" fill="none" stroke="{{ $colores[$i % 5] }}" stroke-width="3" stroke-dasharray="{{ $dasharray }}" stroke-dashoffset="{{ $dashoffset }}" stroke-linecap="round" class="transition-all"></circle>
                                    @endforeach
                                    <circle cx="18" cy="18" r="15.9155" fill="none" stroke="#e5e7eb" stroke-width="3" class="dark:stroke-gray-700"></circle>
                                </svg>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalActivos }}</span>
                                </div>
                            </div>
                            <div class="mt-4 space-y-1 text-xs">
                                @foreach($activosPorSucursal as $i => $item)
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <span class="w-2 h-2 rounded-full" style="background-color: {{ $colores[$i % 5] }};"></span>
                                            <span class="text-gray-600 dark:text-gray-400">{{ Str::limit($item->sucursal, 12) }}</span>
                                        </div>
                                        <span class="font-medium">{{ $item->count }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Barras: Estado -->
                        <div class="p-5 bg-white dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700/50 rounded-xl shadow-md">
                            <h3 class="text-lg font-semibold mb-4">Estado de Activos</h3>
                            <div class="space-y-3 text-xs">
                                @foreach($estadosCount as $estado => $count)
                                    @php
                                        $porcentaje = $totalActivos > 0 ? ($count / $totalActivos) * 100 : 0;
                                        $color = $estado == 'Activo' ? 'bg-secondary' : ($estado == 'En Reparación' ? 'bg-orange-500' : 'bg-red-500');
                                    @endphp
                                    <div class="flex items-center gap-2">
                                        <span class="w-16 text-gray-500 dark:text-gray-400">{{ $estado }}</span>
                                        <div class="flex-1 bg-gray-200 dark:bg-gray-700 rounded-full h-1.5">
                                            <div class="{{ $color }} rounded-full h-1.5 transition-all" style="width: {{ $porcentaje }}%"></div>
                                        </div>
                                        <span class="w-8 text-right font-medium">{{ $count }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    // Sidebar móvil
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