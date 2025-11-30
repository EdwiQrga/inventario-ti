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
            font-variation-settings: 'FILL' 1;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-gray-800 dark:text-gray-200">
<div class="relative flex h-auto min-h-screen w-full group/design-root overflow-x-hidden">
    <div class="layout-container flex h-full grow flex-row">

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
            <a href="{{ route('activos.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60">
                <span class="material-symbols-outlined">inventory_2</span>
                <span class="text-sm font-medium">Inventario</span>
            </a>
            <a href="{{ route('impresoras.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60">
                <span class="material-symbols-outlined">inventory_2</span>
                <span class="text-sm font-medium">Impresoras</span>
            </a>
            <a href="{{ route('usuarios.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60">
                <span class="material-symbols-outlined">group</span>
                <span class="text-sm font-medium">Usuarios</span>
            </a>
            <a href="{{ route('reportes.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-white bg-primary shadow-sm hover:bg-primary/90">
                <span class="material-symbols-outlined">group</span>
                <span class="text-sm font-semibold">Reportes</span>
            </a>
            <a href="{{ route('alertas.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60">
                <span class="material-symbols-outlined">notifications_active</span>
                <span class="text-sm font-medium">Alertas</span>
            </a>
        </nav>
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

                    <!-- Usuario + Nombre + Email -->
                    <div class="flex items-center gap-x-3">
                        <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-9"
                             style='background-image: url("{{ auth()->user()->avatar ?? "https://ui-avatars.com/api/?name=" . urlencode(auth()->user()->name) }}");'></div>
                        <div class="hidden sm:flex flex-col flex-1 min-w-0">
                            <span class="text-sm font-semibold text-gray-800 dark:text-gray-100 truncate">{{ auth()->user()->name }}</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ auth()->user()->email }}</span>
                        </div>
                    </div>

                    <!-- CERRAR SESIÓN -->
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
            <main class="flex-1 px-6 sm:px-8 lg:px-10 py-8 bg-background-light dark:bg-background-dark">
                <div class="max-w-7xl mx-auto">
                    
                    <!-- Mensajes de éxito/error -->
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                        <!-- Selección de Reportes -->
                        <div class="lg:col-span-8 flex flex-col gap-6">
                            <div class="flex flex-col gap-6 rounded-lg border border-gray-200 dark:border-gray-700/50 p-6 bg-white dark:bg-gray-800/50 shadow">
                                <h3 class="text-gray-900 dark:text-white text-lg font-semibold">Seleccione Reporte</h3>
                                
                                <!-- UN SOLO FORMULARIO PARA TODO -->
                                <form method="GET" action="{{ route('reportes.export') }}" id="export-form">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                                        <!-- Inventario General -->
                                        <label class="text-left p-4 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-primary dark:hover:border-primary hover:bg-primary/5 dark:hover:bg-primary/10 transition-colors focus-within:ring-2 focus-within:ring-primary focus-within:ring-offset-2 dark:focus-within:ring-offset-background-dark cursor-pointer">
                                            <input type="radio" name="reporte" value="inventario_general" class="hidden" {{ request('reporte') == 'inventario_general' ? 'checked' : '' }}>
                                            <div class="flex items-center gap-3">
                                                <span class="material-symbols-outlined text-primary text-2xl">inventory</span>
                                                <span class="font-semibold text-gray-800 dark:text-gray-100">Inventario General</span>
                                            </div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Equipos de cómputo e impresoras.</p>
                                        </label>

                                        <!-- Activos por Usuario -->
                                        <label class="text-left p-4 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-primary dark:hover:border-primary hover:bg-primary/5 dark:hover:bg-primary/10 transition-colors focus-within:ring-2 focus-within:ring-primary focus-within:ring-offset-2 dark:focus-within:ring-offset-background-dark cursor-pointer">
                                            <input type="radio" name="reporte" value="activos_usuario" class="hidden" {{ request('reporte') == 'activos_usuario' ? 'checked' : 'checked' }}>
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

                                        <!-- Inventario de Impresoras -->
                                        <label class="text-left p-4 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-primary dark:hover:border-primary hover:bg-primary/5 dark:hover:bg-primary/10 transition-colors focus-within:ring-2 focus-within:ring-primary focus-within:ring-offset-2 dark:focus-within:ring-offset-background-dark cursor-pointer">
                                            <input type="radio" name="reporte" value="inventario_impresoras" class="hidden" {{ request('reporte') == 'inventario_impresoras' ? 'checked' : '' }}>
                                            <div class="flex items-center gap-3">
                                                <span class="material-symbols-outlined text-primary text-2xl">print</span>
                                                <span class="font-semibold text-gray-800 dark:text-gray-100">Inventario de Impresoras</span>
                                            </div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Lista completa de todas las impresoras.</p>
                                        </label>
                                    </div>

                                    <!-- Filtros y Exportación -->
                                    <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                                        <h3 class="text-gray-900 dark:text-white text-lg font-semibold mb-4">Filtros y Exportación</h3>
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
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
                                                    <option value="xlsx" {{ request('formato') == 'xlsx' ? 'selected' : 'selected' }}>Excel (.xlsx)</option>
                                                    <option value="csv" {{ request('formato') == 'csv' ? 'selected' : '' }}>CSV (.csv)</option>
                                                    <option value="pdf" {{ request('formato') == 'pdf' ? 'selected' : '' }}>PDF (.pdf)</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Botón de exportación -->
                                        <button type="submit"
                                                class="flex w-full min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center gap-2 overflow-hidden rounded h-10 px-4 bg-primary text-white text-sm font-medium hover:bg-primary/90 transition-all shadow-sm mt-6">
                                            <span class="material-symbols-outlined text-lg">download</span>
                                            <span class="truncate">Exportar Reporte</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Información adicional -->
                        <div class="lg:col-span-4 flex flex-col gap-6">
                            <div class="flex flex-col gap-6 rounded-lg border border-gray-200 dark:border-gray-700/50 p-6 bg-white dark:bg-gray-800/50 shadow">
                                <h3 class="text-gray-900 dark:text-white text-lg font-semibold">Información del Sistema</h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600 dark:text-gray-400">Equipos de Cómputo:</span>
                                        <span class="text-sm font-semibold">{{ \App\Models\Activo::count() }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600 dark:text-gray-400">Impresoras:</span>
                                        <span class="text-sm font-semibold">{{ \App\Models\Impresora::count() }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600 dark:text-gray-400">Total Activos:</span>
                                        <span class="text-sm font-semibold">{{ \App\Models\Activo::count() + \App\Models\Impresora::count() }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600 dark:text-gray-400">Alertas Activas:</span>
                                        <span class="text-sm font-semibold">{{ \App\Models\Alerta::where('estado', 'pendiente')->count() }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600 dark:text-gray-400">Usuarios Registrados:</span>
                                        <span class="text-sm font-semibold">{{ \App\Models\User::count() }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Información de ayuda -->
                            <div class="flex flex-col gap-6 rounded-lg border border-gray-200 dark:border-gray-700/50 p-6 bg-white dark:bg-gray-800/50 shadow">
                                <h3 class="text-gray-900 dark:text-white text-lg font-semibold">¿Cómo usar?</h3>
                                <div class="space-y-3 text-sm text-gray-600 dark:text-gray-400">
                                    <p>1. Selecciona el tipo de reporte que necesitas</p>
                                    <p>2. Aplica filtros si es necesario (usuario, fechas)</p>
                                    <p>3. Elige el formato de exportación</p>
                                    <p>4. Haz clic en "Exportar Reporte"</p>
                                </div>
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
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('✅ Página de reportes cargada');

    // 1. Configuración de Flatpickr (versión segura)
    try {
        flatpickr("#date-range", {
            mode: "range",
            dateFormat: "Y-m-d",
            locale: "es",
            defaultDate: "today"
        });
        console.log('✅ Flatpickr inicializado correctamente');
    } catch (error) {
        console.warn('⚠️ Error con Flatpickr, usando configuración básica');
        flatpickr("#date-range", {
            mode: "range",
            dateFormat: "Y-m-d"
        });
    }

    // 2. Sincronizar selección de reporte con estilos
    function updateRadioStyles() {
        document.querySelectorAll('label').forEach(label => {
            label.classList.remove(
                'border-primary', 'dark:border-primary', 
                'bg-primary/5', 'dark:bg-primary/10', 
                'ring-2', 'ring-primary', 'ring-offset-2', 
                'dark:ring-offset-background-dark'
            );
            label.classList.add('border-gray-200', 'dark:border-gray-700');
        });
        
        const selectedRadio = document.querySelector('input[name="reporte"]:checked');
        if (selectedRadio) {
            const selectedLabel = selectedRadio.closest('label');
            selectedLabel.classList.add(
                'border-primary', 'dark:border-primary',
                'bg-primary/5', 'dark:bg-primary/10', 
                'ring-2', 'ring-primary', 'ring-offset-2',
                'dark:ring-offset-background-dark'
            );
            console.log('🎯 Reporte seleccionado:', selectedRadio.value);
        }
    }

    // 3. Asegurar que siempre haya un reporte seleccionado
    const radios = document.querySelectorAll('input[name="reporte"]');
    if (radios.length > 0) {
        // Si no hay ninguno seleccionado, seleccionar el primero
        if (!document.querySelector('input[name="reporte"]:checked')) {
            radios[0].checked = true;
            console.log('🔘 Reporte seleccionado por defecto:', radios[0].value);
        }
        
        // Agregar event listeners a todos los radios
        radios.forEach(radio => {
            radio.addEventListener('change', updateRadioStyles);
        });
        
        // Aplicar estilos iniciales
        updateRadioStyles();
    }

    // 4. Debug del formulario de exportación
    const exportForm = document.getElementById('export-form');
    
    if (exportForm) {
        console.log('✅ Formulario de exportación encontrado');
        
        exportForm.addEventListener('submit', function(e) {
            const reporte = document.querySelector('input[name="reporte"]:checked');
            const formato = document.querySelector('select[name="formato"]');
            
            console.log('📤 Enviando formulario de exportación...');
            console.log('📊 Reporte seleccionado:', reporte?.value);
            console.log('📁 Formato seleccionado:', formato?.value);
            console.log('👤 Usuario:', document.querySelector('select[name="usuario"]')?.value);
            console.log('📅 Fecha rango:', document.querySelector('input[name="fecha_rango"]')?.value);
            
            // Validación básica
            if (!reporte) {
                e.preventDefault();
                alert('❌ Por favor selecciona un tipo de reporte');
                return false;
            }
            
            if (!formato || !formato.value) {
                e.preventDefault();
                alert('❌ Por favor selecciona un formato de archivo');
                return false;
            }
            
            console.log('✅ Formulario válido, procediendo con la exportación...');
            
            // Mostrar mensaje de carga
            const button = this.querySelector('button[type="submit"]');
            const originalText = button.innerHTML;
            button.innerHTML = '<span class="material-symbols-outlined text-lg">downloading</span><span class="truncate">Generando reporte...</span>';
            button.disabled = true;
            
            // Restaurar después de 3 segundos (por si hay error)
            setTimeout(() => {
                button.innerHTML = originalText;
                button.disabled = false;
            }, 3000);
        });
    } else {
        console.error('❌ Formulario de exportación NO encontrado');
    }
</script>
</body>
</html>