<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Panel de Alertas de Inventario de TI</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
    <style type="text/tailwindcss">
        @layer base {
            :root {
                --background: 0 0% 100%;
                --foreground: 224 71.4% 4.1%;
                --card: 0 0% 100%;
                --card-foreground: 224 71.4% 4.1%;
                --primary: 220 9.1% 94.9%;
                --primary-foreground: 220 13.1% 33.1%;
                --secondary: 220 14.3% 95.9%;
                --secondary-foreground: 220 9% 39.8%;
                --muted: 220 14.3% 95.9%;
                --muted-foreground: 225.9 10% 46.5%;
                --accent: 220 14.3% 95.9%;
                --accent-foreground: 220 9% 39.8%;
                --destructive: 0 84.2% 60.2%;
                --destructive-foreground: 0 0% 98%;
                --border: 220 13% 91%;
                --input: 220 13% 91%;
                --ring: 224 71.4% 4.1%;
                --radius: 0.5rem;
            }
            .dark {
                --background: 224 71.4% 4.1%;
                --foreground: 0 0% 98%;
                --card: 224 71.4% 4.1%;
                --card-foreground: 0 0% 98%;
                --primary: 215 27.9% 16.9%;
                --primary-foreground: 0 0% 98%;
                --secondary: 215 27.9% 16.9%;
                --secondary-foreground: 0 0% 98%;
                --muted: 215 27.9% 16.9%;
                --muted-foreground: 217.9 10.6% 64.9%;
                --accent: 215 27.9% 16.9%;
                --accent-foreground: 0 0% 98%;
                --destructive: 0 62.8% 30.6%;
                --destructive-foreground: 0 0% 98%;
                --border: 215 27.9% 16.9%;
                --input: 215 27.9% 16.9%;
                --ring: 216 12.2% 83.9%;
            }
        }
    </style>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        border: "hsl(var(--border))",
                        input: "hsl(var(--input))",
                        ring: "hsl(var(--ring))",
                        background: "hsl(var(--background))",
                        foreground: "hsl(var(--foreground))",
                        primary: { DEFAULT: "hsl(var(--primary))", foreground: "hsl(var(--primary-foreground))" },
                        secondary: { DEFAULT: "hsl(var(--secondary))", foreground: "hsl(var(--secondary-foreground))" },
                        destructive: { DEFAULT: "hsl(var(--destructive))", foreground: "hsl(var(--destructive-foreground))" },
                        muted: { DEFAULT: "hsl(var(--muted))", foreground: "hsl(var(--muted-foreground))" },
                        accent: { DEFAULT: "hsl(var(--accent))", foreground: "hsl(var(--accent-foreground))" },
                        popover: { DEFAULT: "hsl(var(--popover))", foreground: "hsl(var(--popover-foreground))" },
                        card: { DEFAULT: "hsl(var(--card))", foreground: "hsl(var(--card-foreground))" },
                    },
                    fontFamily: {
                        "display": ["Lato", "sans-serif"],
                        "body": ["Roboto", "sans-serif"]
                    },
                    borderRadius: {
                        lg: "var(--radius)",
                        md: "calc(var(--radius) - 2px)",
                        sm: "calc(var(--radius) - 4px)",
                    },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>
<body class="bg-background font-body text-foreground dark">
<div class="relative flex h-auto min-h-screen w-full flex-col">
    <div class="flex h-full grow flex-row">

        <!-- Sidebar -->
        <aside class="flex flex-col w-64 bg-card p-4 border-r border-border">
            <div class="flex flex-col gap-4 mb-8">
                <div class="flex gap-3 items-center">
                    <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
                         style='background-image: url("{{ auth()->user()->avatar ?? "https://ui-avatars.com/api/?name=" . urlencode(auth()->user()->name) }}");'></div>
                    <div class="flex flex-col">
                        <h1 class="text-foreground text-base font-bold font-display">{{ auth()->user()->name }}</h1>
                        <p class="text-muted-foreground text-sm">Departamento de TI</p>
                    </div>
                </div>
            </div>

            <nav class="flex-1 px-4 py-4">
                <ul class="flex flex-col gap-2">
                    <li><a href="{{ route('dashboard') }}" class="flex items-center gap-3 rounded-lg px-4 py-2 text-muted-foreground hover:bg-muted">
                        <span class="material-symbols-outlined">home</span>
                        <span class="text-sm font-medium">Inicio</span>
                    </a></li>
                    <li><a href="{{ route('activos.index') }}" class="flex items-center gap-3 rounded-lg px-4 py-2 text-primary bg-primary/10 dark:bg-primary dark:text-white">
                        <span class="material-symbols-outlined">inventory</span>
                        <span class="text-sm font-medium">Inventario</span>
                    </a></li>
                    <li><a href="{{ route('dashboard') }}" class="flex items-center gap-3 rounded-lg px-4 py-2 text-muted-foreground hover:bg-muted">
                        <span class="material-symbols-outlined">dashboard</span>
                        <span class="text-sm font-medium">Dashboard</span>
                    </a></li>
                    <li><a href="{{ route('alertas.index') }}" class="flex items-center gap-3 rounded-lg px-4 py-2 text-primary bg-primary/10 dark:bg-primary dark:text-white">
                        <span class="material-symbols-outlined">notifications</span>
                        <span class="text-sm font-medium">Alertas</span>
                    </a></li>
                    <li><a href="{{ route('reportes.index') }}" class="flex items-center gap-3 rounded-lg px-4 py-2 text-muted-foreground hover:bg-muted">
                        <span class="material-symbols-outlined">analytics</span>
                        <span class="text-sm font-medium">Reportes</span>
                    </a></li>
                    <li><a href="{{ route('usuarios.index') }}" class="flex items-center gap-3 rounded-lg px-4 py-2 text-muted-foreground hover:bg-muted">
                        <span class="material-symbols-outlined">group</span>
                        <span class="text-sm font-medium">Gestión de Usuarios</span>
                    </a></li>
                </ul>
            </nav>

            <div class="flex flex-col gap-1 mt-auto">
                <a href="#" class="flex items-center gap-3 px-3 py-2 text-foreground/80 hover:bg-muted rounded-lg">
                    <span class="material-symbols-outlined">settings</span>
                    <p class="text-sm font-medium">Configuración</p>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex w-full items-center gap-3 px-3 py-2 text-foreground/80 hover:bg-muted rounded-lg text-left">
                        <span class="material-symbols-outlined">logout</span>
                        <p class="text-sm font-medium">Cerrar sesión</p>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8 bg-background">
            <div class="flex flex-wrap justify-between gap-3 mb-6">
                <p class="text-foreground text-4xl font-black tracking-tight font-display">Panel de Alertas</p>
            </div>

            <!-- Estadísticas -->
            <div class="flex flex-wrap gap-4 mb-6">
                <div class="flex min-w-[158px] flex-1 flex-col gap-2 rounded-lg p-6 bg-card border border-border">
                    <p class="text-muted-foreground text-base font-medium">Alertas Activas</p>
                    <p class="text-foreground text-2xl font-bold">{{ $alertasLicencias->count() + $alertasMantenimiento->count() }}</p>
                </div>
                <div class="flex min-w-[158px] flex-1 flex-col gap-2 rounded-lg p-6 bg-card border border-border">
                    <p class="text-muted-foreground text-base font-medium">Licencias por Vencer</p>
                    <p class="text-foreground text-2xl font-bold">{{ $licenciasProximas->count() }}</p>
                </div>
                <div class="flex min-w-[158px] flex-1 flex-col gap-2 rounded-lg p-6 bg-card border border-border">
                    <p class="text-muted-foreground text-base font-medium">Equipos en Mantenimiento</p>
                    <p class="text-foreground text-2xl font-bold">{{ $mantenimientosProgramados->count() }}</p>
                </div>
            </div>

            <!-- Filtros y Búsqueda -->
            <div class="flex items-center justify-between gap-4 mb-4">
                <form method="GET" action="{{ route('alertas.index') }}" class="flex-1">
                    <label class="flex flex-col min-w-40 h-12 w-full max-w-md">
                        <div class="flex w-full items-stretch rounded-lg h-full">
                            <div class="text-muted-foreground flex border border-border bg-card items-center justify-center pl-4 rounded-l-lg border-r-0">
                                <span class="material-symbols-outlined">search</span>
                            </div>
                            <input name="search" value="{{ request('search') }}"
                                   class="form-input flex w-full resize-none overflow-hidden rounded-lg text-foreground focus:outline-0 focus:ring-0 border border-border bg-card h-full placeholder:text-muted-foreground px-4 rounded-l-none border-l-0 pl-2 text-base"
                                   placeholder="Buscar por software o equipo"/>
                        </div>
                    </label>
                </form>
                <div class="flex gap-3">
                    <button type="button" onclick="toggleFilter('estado')" class="flex h-10 items-center justify-center gap-2 rounded-lg bg-secondary px-4 border border-border">
                        <p class="text-secondary-foreground text-sm font-medium">Estado</p>
                        <span class="material-symbols-outlined text-secondary-foreground">expand_more</span>
                    </button>
                    <button type="button" onclick="toggleFilter('fecha')" class="flex h-10 items-center justify-center gap-2 rounded-lg bg-secondary px-4 border border-border">
                        <p class="text-secondary-foreground text-sm font-medium">Fecha</p>
                        <span class="material-symbols-outlined text-secondary-foreground">expand_more</span>
                    </button>
                </div>
            </div>

            <!-- Alertas de Licencia -->
            <div class="bg-card rounded-xl shadow-md overflow-hidden border border-border mb-8">
                <h3 class="text-lg font-bold text-foreground p-4 font-display">Alertas de Licencia</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-muted-foreground">
                        <thead class="text-xs text-foreground/80 uppercase bg-muted">
                            <tr>
                                <th class="px-6 py-3">Nombre del Software</th>
                                <th class="px-6 py-3">Fecha de Vencimiento</th>
                                <th class="px-6 py-3">Días Restantes</th>
                                <th class="px-6 py-3">Usuario Asignado</th>
                                <th class="px-6 py-3">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($alertasLicencias as $licencia)
                            @php
                                $dias = now()->diffInDays(\Carbon\Carbon::parse($licencia->fecha_vencimiento), false);
                                $color = $dias < 0 ? 'bg-red-500/10 text-red-500' : ($dias <= 30 ? 'bg-orange-500/10 text-orange-500' : '');
                                $texto = $dias < 0 ? 'Vencido' : $dias;
                            @endphp
                            <tr class="bg-card border-b border-border">
                                <th class="px-6 py-4 font-medium text-foreground">{{ $licencia->nombre }}</th>
                                <td class="px-6 py-4">
                                    <span class="text-xs font-medium px-2.5 py-0.5 rounded {{ $color }}">
                                        {{ \Carbon\Carbon::parse($licencia->fecha_vencimiento)->format('d/m/Y') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-bold {{ $dias < 0 ? 'text-red-500' : ($dias <= 30 ? 'text-orange-500' : '') }}">
                                        {{ $texto }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">{{ $licencia->user?->name ?? 'Sin asignar' }}</td>
                                <td class="px-6 py-4">
                                    <button class="bg-primary hover:bg-primary/80 text-primary-foreground text-xs font-bold py-1 px-3 rounded-lg">
                                        Renovar Licencia
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-8 text-muted-foreground">No hay licencias por vencer.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Alertas de Mantenimiento -->
            <div class="bg-card rounded-xl shadow-md overflow-hidden border border-border">
                <h3 class="text-lg font-bold text-foreground p-4 font-display">Alertas de Mantenimiento</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-muted-foreground">
                        <thead class="text-xs text-foreground/80 uppercase bg-muted">
                            <tr>
                                <th class="px-6 py-3">Nombre del Equipo</th>
                                <th class="px-6 py-3">Tipo de Mantenimiento</th>
                                <th class="px-6 py-3">Fecha Programada</th>
                                <th class="px-6 py-3">Estado</th>
                                <th class="px-6 py-3">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($alertasMantenimiento as $mantenimiento)
                            <tr class="bg-card border-b border-border">
                                <th class="px-6 py-4 font-medium text-foreground">{{ $mantenimiento->nombre }}</th>
                                <td class="px-6 py-4">{{ $mantenimiento->tipo_mantenimiento }}</td>
                                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($mantenimiento->fecha_programada)->format('d/m/Y') }}</td>
                                <td class="px-6 py-4">
                                    <span class="text-xs font-medium px-2.5 py-0.5 rounded
                                        {{ $mantenimiento->estado == 'Completado' ? 'bg-green-500/10 text-green-500' : 'bg-blue-500/10 text-blue-500' }}">
                                        {{ $mantenimiento->estado }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 flex gap-2">
                                    @if($mantenimiento->estado == 'Programado')
                                        <button class="bg-green-600 hover:bg-green-700 text-white text-xs font-bold py-1 px-3 rounded-lg">Completado</button>
                                        <button class="bg-primary hover:bg-primary/80 text-primary-foreground text-xs font-bold py-1 px-3 rounded-lg">Reprogramar</button>
                                    @else
                                        <button class="bg-muted text-muted-foreground text-xs font-bold py-1 px-3 rounded-lg cursor-not-allowed">Ver Detalles</button>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-8 text-muted-foreground">No hay mantenimientos programados.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    function toggleFilter(type) {
        // Placeholder para filtros dinámicos (Livewire o JS)
        alert('Filtro por ' + type + ' (próximamente)');
    }
</script>
</body>
</html>