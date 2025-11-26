<!DOCTYPE html>
<html class="dark" lang="es">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Editar Alerta - Inventario TI</title>
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
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-gray-800 dark:text-gray-200 min-h-screen">

<!-- Sidebar -->
<div class="flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-800 h-screen sticky top-0">
        <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-200 dark:border-gray-800">
            <img src="{{ asset('images/pmn.png') }}" alt="Logo" class="h-8 w-8 object-contain"/>
            <span class="text-xl font-bold text-primary">Inventario TI</span>
        </div>
        <nav class="p-4 space-y-2">
            <a href="{{ url('/dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60">
                <span class="material-symbols-outlined">home</span>
                <span class="text-sm font-medium">Inicio</span>
            </a>
            <a href="{{ route('activos.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60">
                <span class="material-symbols-outlined">inventory_2</span>
                <span class="text-sm font-medium">Inventario</span>
            </a>
            <a href="{{ url('/dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="text-sm font-medium">Dashboard</span>
            </a>
            <a href="{{ route('alertas.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-white bg-primary shadow-sm hover:bg-primary/90">
                <span class="material-symbols-outlined">notifications_active</span>
                <span class="text-sm font-semibold">Alertas</span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1">
        <!-- Header -->
        <header class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-sm border-b border-gray-200 dark:border-gray-800 px-6 py-4 sticky top-0">
            <div class="flex justify-between items-center">
                <h1 class="text-xl font-semibold text-gray-900 dark:text-white">Editar Alerta</h1>
                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-600 dark:text-gray-400">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                            Cerrar Sesión
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Form Content -->
        <main class="p-6">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">
                    <form action="{{ route('alertas.update', $alerta) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Título -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Título *
                                </label>
                                <input type="text" name="titulo" value="{{ $alerta->titulo }}" required
                                       class="w-full h-10 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors"
                                       placeholder="Ingrese el título de la alerta">
                            </div>

                            <!-- Tipo -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Tipo *
                                </label>
                                <input type="text" name="tipo" value="{{ $alerta->tipo }}" required
                                       class="w-full h-10 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors"
                                       placeholder="Ej: Mantenimiento, Garantía">
                            </div>

                            <!-- Prioridad -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Prioridad *
                                </label>
                                <select name="prioridad" required
                                        class="w-full h-10 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors">
                                    <option value="Información" {{ $alerta->prioridad == 'Información' ? 'selected' : '' }}>Información</option>
                                    <option value="Moderada" {{ $alerta->prioridad == 'Moderada' ? 'selected' : '' }}>Moderada</option>
                                    <option value="Crítica" {{ $alerta->prioridad == 'Crítica' ? 'selected' : '' }}>Crítica</option>
                                </select>
                            </div>

                            <!-- Estado -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Estado *
                                </label>
                                <select name="estado" required
                                        class="w-full h-10 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors">
                                    <option value="Nueva" {{ $alerta->estado == 'Nueva' ? 'selected' : '' }}>Nueva</option>
                                    <option value="En Proceso" {{ $alerta->estado == 'En Proceso' ? 'selected' : '' }}>En Proceso</option>
                                    <option value="Resuelta" {{ $alerta->estado == 'Resuelta' ? 'selected' : '' }}>Resuelta</option>
                                </select>
                            </div>

                            <!-- Activo -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Activo Relacionado
                                </label>
                                <select name="activo_id"
                                        class="w-full h-10 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors">
                                    <option value="">Seleccionar activo</option>
                                    @foreach($activos as $activo)
                                        <option value="{{ $activo->id }}" {{ $alerta->activo_id == $activo->id ? 'selected' : '' }}>
                                            {{ $activo->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Fecha Alerta -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Fecha de Alerta *
                                </label>
                                <input type="date" name="fecha_alerta" value="{{ $alerta->fecha_alerta->format('Y-m-d') }}" required
                                       class="w-full h-10 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors">
                            </div>

                            <!-- Fecha Vencimiento -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Fecha de Vencimiento *
                                </label>
                                <input type="date" name="fecha_vencimiento" value="{{ $alerta->fecha_vencimiento->format('Y-m-d') }}" required
                                       class="w-full h-10 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors">
                            </div>
                        </div>

                        <!-- Descripción -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Descripción *
                            </label>
                            <textarea name="descripcion" required rows="4"
                                      class="w-full px-3 py-2 rounded-lg bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors"
                                      placeholder="Describa los detalles de la alerta...">{{ $alerta->descripcion }}</textarea>
                        </div>

                        <!-- Botones -->
                        <div class="flex gap-4">
                            <button type="submit"
                                    class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-primary/90 transition-colors font-medium">
                                Actualizar Alerta
                            </button>
                            <a href="{{ route('alertas.index') }}"
                               class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition-colors font-medium">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>

</body>
</html>