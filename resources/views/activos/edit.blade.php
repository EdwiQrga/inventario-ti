<!DOCTYPE html>
<html class="dark" lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Editar Activo - Inventario TI</title>
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
                <h1 class="text-lg xs:text-xl font-bold text-gray-900 dark:text-white truncate">Editar Activo #{{ $activo->id }}</h1>
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
                <form id="editForm" action="{{ route('activos.update', $activo->id) }}" method="POST" class="flex flex-col lg:flex-row gap-4 xs:gap-6 lg:gap-8">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">

                    <!-- FORMULARIO PRINCIPAL -->
                    <div class="flex-1">
                        <div class="bg-white dark:bg-gray-900/70 rounded-xl xs:rounded-2xl border border-gray-200 dark:border-gray-800 shadow-lg p-4 xs:p-6 lg:p-8">
                            <div class="mb-6 xs:mb-8">
                                <h2 class="text-xl xs:text-2xl font-bold text-gray-900 dark:text-white">Información del Activo</h2>
                                <p class="text-gray-500 dark:text-gray-400 mt-1 text-sm xs:text-base">Actualiza los datos del equipo</p>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 xs:gap-6">
                                <!-- ID (solo lectura) -->
                                <div>
                                    <label class="block text-sm font-semibold mb-2">ID</label>
                                    <input type="text" readonly value="{{ $activo->id }}" 
                                           class="w-full h-10 xs:h-12 px-3 xs:px-4 rounded-lg xs:rounded-xl bg-gray-100 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-base xs:text-lg font-medium">
                                </div>

                                <!-- Sucursal/Área -->
                                <div>
                                    <label class="block text-sm font-semibold mb-2">Sucursal/Área *</label>
                                    <input name="sucursal_area" value="{{ old('sucursal_area', $activo->sucursal_area) }}" required 
                                           class="w-full h-10 xs:h-12 px-3 xs:px-4 rounded-lg xs:rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 focus:ring-2 focus:ring-primary/50 text-sm xs:text-base">
                                    <p class="text-red-500 text-xs mt-1 hidden error-text"></p>
                                </div>

                                <!-- Razón Social -->
                                <div>
                                    <label class="block text-sm font-semibold mb-2">Razón Social *</label>
                                    <input name="razon_social" value="{{ old('razon_social', $activo->razon_social) }}" required 
                                           class="w-full h-10 xs:h-12 px-3 xs:px-4 rounded-lg xs:rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 focus:ring-2 focus:ring-primary/50 text-sm xs:text-base">
                                    <p class="text-red-500 text-xs mt-1 hidden error-text"></p>
                                </div>

                                <!-- Código de Barras (full width) -->
                                <div class="sm:col-span-2 xl:col-span-3">
                                    <label class="block text-sm font-semibold mb-2">Código de Barras *</label>
                                    <input name="codigo_barras" value="{{ old('codigo_barras', $activo->codigo_barras) }}" required 
                                           class="w-full h-10 xs:h-12 px-3 xs:px-4 rounded-lg xs:rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 font-mono text-base xs:text-lg focus:ring-2 focus:ring-primary/50">
                                    <p class="text-red-500 text-xs mt-1 hidden error-text"></p>
                                </div>

                                <!-- Marca -->
                                <div>
                                    <label class="block text-sm font-semibold mb-2">Marca *</label>
                                    <input name="marca" value="{{ old('marca', $activo->marca) }}" required 
                                           class="w-full h-10 xs:h-12 px-3 xs:px-4 rounded-lg xs:rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 focus:ring-2 focus:ring-primary/50 text-sm xs:text-base">
                                    <p class="text-red-500 text-xs mt-1 hidden error-text"></p>
                                </div>

                                <!-- Modelo -->
                                <div>
                                    <label class="block text-sm font-semibold mb-2">Modelo *</label>
                                    <input name="modelo" value="{{ old('modelo', $activo->modelo) }}" required 
                                           class="w-full h-10 xs:h-12 px-3 xs:px-4 rounded-lg xs:rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 focus:ring-2 focus:ring-primary/50 text-sm xs:text-base">
                                    <p class="text-red-500 text-xs mt-1 hidden error-text"></p>
                                </div>

                                <!-- SD -->
                                <div>
                                    <label class="block text-sm font-semibold mb-2">SD *</label>
                                    <input name="sd" value="{{ old('sd', $activo->sd) }}" required 
                                           class="w-full h-10 xs:h-12 px-3 xs:px-4 rounded-lg xs:rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 focus:ring-2 focus:ring-primary/50 text-sm xs:text-base">
                                    <p class="text-red-500 text-xs mt-1 hidden error-text"></p>
                                </div>

                                <!-- RAM -->
                                <div>
                                    <label class="block text-sm font-semibold mb-2">RAM *</label>
                                    <input name="ram" value="{{ old('ram', $activo->ram) }}" required 
                                           class="w-full h-10 xs:h-12 px-3 xs:px-4 rounded-lg xs:rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 focus:ring-2 focus:ring-primary/50 text-sm xs:text-base">
                                    <p class="text-red-500 text-xs mt-1 hidden error-text"></p>
                                </div>

                                <!-- Procesador (doble ancho) -->
                                <div class="xl:col-span-2">
                                    <label class="block text-sm font-semibold mb-2">Procesador *</label>
                                    <input name="procesador" value="{{ old('procesador', $activo->procesador) }}" required 
                                           class="w-full h-10 xs:h-12 px-3 xs:px-4 rounded-lg xs:rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 focus:ring-2 focus:ring-primary/50 text-sm xs:text-base">
                                    <p class="text-red-500 text-xs mt-1 hidden error-text"></p>
                                </div>

                                <!-- Asignado a -->
                                <div>
                                    <label class="block text-sm font-semibold mb-2">Asignado a</label>
                                    <input name="asignado" value="{{ old('asignado', $activo->asignado_a ?? '') }}" 
                                           class="w-full h-10 xs:h-12 px-3 xs:px-4 rounded-lg xs:rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-sm xs:text-base">
                                    <p class="text-red-500 text-xs mt-1 hidden error-text"></p>
                                </div>

                                <!-- Estado -->
                                <div>
                                    <label class="block text-sm font-semibold mb-2">Estado *</label>
                                    <select name="estado" required 
                                            class="w-full h-10 xs:h-12 px-3 xs:px-4 rounded-lg xs:rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 focus:ring-2 focus:ring-primary/50 text-sm xs:text-base">
                                        <option value="Activo" {{ $activo->estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                                        <option value="En Reparación" {{ $activo->estado == 'En Reparación' ? 'selected' : '' }}>En Reparación</option>
                                        <option value="Obsoleto" {{ $activo->estado == 'Obsoleto' ? 'selected' : '' }}>Obsoleto</option>
                                        <option value="En Almacén" {{ $activo->estado == 'En Almacén' ? 'selected' : '' }}>En Almacén</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- BOTONES LATERALES -->
                    <div class="lg:w-80 xl:w-96">
                        <div class="sticky top-24 bg-white dark:bg-gray-900/70 rounded-xl xs:rounded-2xl border border-gray-200 dark:border-gray-800 shadow-lg p-4 xs:p-6 lg:p-8 space-y-4 xs:space-y-6">
                            <div class="text-center">
                                <h3 class="text-lg xs:text-xl font-bold mb-2">Acciones</h3>
                                <p class="text-gray-500 dark:text-gray-400 text-sm">Guarda los cambios realizados</p>
                            </div>

                            <div class="space-y-3 xs:space-y-4">
                                <!-- Botón Cancelar -->
                                <a href="{{ route('activos.index') }}" 
                                   class="w-full block text-center py-3 xs:py-4 px-4 xs:px-6 border-2 border-gray-300 dark:border-gray-700 rounded-lg xs:rounded-2xl font-semibold hover:bg-gray-50 dark:hover:bg-gray-800 transition text-sm xs:text-base">
                                    <span class="flex items-center justify-center gap-2">
                                        <span class="material-symbols-outlined text-lg xs:text-xl">close</span>
                                        Cancelar
                                    </span>
                                </a>

                                <!-- Botón Guardar -->
                                <button type="submit" id="btnGuardar" 
                                        class="w-full py-3 xs:py-4 px-4 xs:px-6 bg-primary text-white rounded-lg xs:rounded-2xl font-bold text-base xs:text-lg hover:bg-primary/90 transition shadow-lg xs:shadow-xl flex items-center justify-center gap-2 xs:gap-3">
                                    <span class="material-symbols-outlined text-xl xs:text-2xl">save</span>
                                    <span>Guardar Cambios</span>
                                </button>

                                <!-- Botón Ver Detalles (adicional) -->
                                <a href="{{ route('activos.show', $activo) }}" 
                                   class="w-full block text-center py-3 xs:py-4 px-4 xs:px-6 border-2 border-primary text-primary rounded-lg xs:rounded-2xl font-semibold hover:bg-primary/5 transition text-sm xs:text-base">
                                    <span class="flex items-center justify-center gap-2">
                                        <span class="material-symbols-outlined text-lg xs:text-xl">visibility</span>
                                        Ver Detalles
                                    </span>
                                </a>
                            </div>

                            <!-- Información adicional -->
                            <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                <div class="text-center text-xs xs:text-sm text-gray-500 dark:text-gray-400">
                                    <p>Última actualización:</p>
                                    <p class="font-medium text-gray-700 dark:text-gray-300">{{ $activo->updated_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>

<!-- TOAST -->
<div id="toast" class="fixed bottom-4 xs:bottom-8 right-4 xs:right-8 bg-green-600 text-white px-4 xs:px-8 py-3 xs:py-5 rounded-xl xs:rounded-2xl shadow-xl flex items-center gap-2 xs:gap-4 z-50 text-sm xs:text-lg font-semibold hidden">
    <span class="material-symbols-outlined text-xl xs:text-3xl">check_circle</span>
    <span>¡Activo actualizado!</span>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('editForm');
        const btnGuardar = document.getElementById('btnGuardar');
        
        if (form && btnGuardar) {
            form.onsubmit = function(e) {
                e.preventDefault();
                const original = btnGuardar.innerHTML;
                btnGuardar.disabled = true;
                btnGuardar.innerHTML = '<span class="material-symbols-outlined animate-spin text-xl xs:text-2xl">sync</span> Guardando...';

                // Limpiar errores anteriores
                document.querySelectorAll('.error-text').forEach(el => {
                    el.classList.add('hidden');
                    el.textContent = '';
                });

                fetch(this.action, {
                    method: 'POST',
                    body: new FormData(this),
                    headers: { 
                        'X-Requested-With': 'XMLHttpRequest', 
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => { throw err; });
                    }
                    return response.json();
                })
                .then(data => {
                    // Mostrar toast de éxito
                    const toast = document.getElementById('toast');
                    toast.classList.remove('hidden');
                    
                    // Redirigir después de un breve delay
                    setTimeout(() => {
                        window.location.href = "{{ route('activos.index') }}";
                    }, 1500);
                })
                .catch(err => {
                    console.error('Error:', err);
                    if (err.errors) {
                        Object.keys(err.errors).forEach(key => {
                            const input = document.querySelector(`[name="${key}"]`);
                            if (input) {
                                const errorElement = input.parentNode.querySelector('.error-text');
                                if (errorElement) {
                                    errorElement.textContent = err.errors[key][0];
                                    errorElement.classList.remove('hidden');
                                    
                                    // Scroll al primer error
                                    if (Object.keys(err.errors)[0] === key) {
                                        input.scrollIntoView({ 
                                            behavior: 'smooth', 
                                            block: 'center' 
                                        });
                                    }
                                }
                            }
                        });
                    } else {
                        alert('Error del servidor. Por favor, intenta nuevamente.');
                    }
                })
                .finally(() => {
                    btnGuardar.disabled = false;
                    btnGuardar.innerHTML = original;
                });
            };
        }

        // Sidebar móvil
        const sidebar = document.getElementById('sidebar');
        const openBtn = document.getElementById('openSidebar');
        const closeBtn = document.getElementById('closeSidebar');
        const overlay = document.getElementById('overlay');

        if (openBtn) {
            openBtn.addEventListener('click', () => {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            });
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', () => {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            });
        }

        if (overlay) {
            overlay.addEventListener('click', () => {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            });
        }
    });
</script>
</body>
</html>