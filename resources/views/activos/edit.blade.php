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
                    colors: {
                        "primary": "#005850",
                        "secondary": "#62c443",
                        "accent-1": "#00868a",
                        "background-light": "#f6f7f8",
                        "background-dark": "#101922",
                    },
                    fontFamily: { display: ["Inter", "sans-serif"] },
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
                <svg class="h-8 w-8" fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd" d="M12.0799 24L4 19.2479L9.95537 8.75216L18.04 13.4961L18.0446 4H29.9554L29.96 13.4961L38.0446 8.75216L44 19.2479L35.92 24L44 28.7521L38.0446 39.4009L29.96 34.5039L29.9554 44H18.0446L18.04 34.5039L9.95537 39.4009L4 28.7521L12.0799 24Z" fill="currentColor" fill-rule="evenodd"></path>
                </svg>
                <span class="text-xl font-bold text-primary">Inventario TI</span>
            </div>
            <button id="closeSidebar" class="lg:hidden">
               

 <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <nav class="p-4 space-y-2">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60">
                <span class="material-symbols-outlined">dashboard</span> Dashboard
            </a>
            <a href="{{ route('activos.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-white bg-primary shadow-sm hover:bg-primary/90">
                <span class="material-symbols-outlined material-symbols-filled">inventory_2</span> Inventario
            </a>
        </nav>
    </aside>

    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden lg:hidden"></div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Header con flecha atrás -->
        <header class="flex items-center justify-between px-4 lg:px-8 py-4 h-16 border-b border-gray-200 dark:border-gray-800 bg-white/80 dark:bg-gray-900/80 backdrop-blur-sm sticky top-0 z-10">
            <div class="flex items-center gap-4">
                <button id="openSidebar" class="lg:hidden">
                    <span class="material-symbols-outlined text-2xl">menu</span>
                </button>
                <div class="flex items-center gap-3">
                    <a href="{{ route('activos.index') }}" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800/60 transition">
                        <span class="material-symbols-outlined text-2xl">arrow_back</span>
                    </a>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Editar Activo #{{ $activo->id }}</h1>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <button class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800/60">
                    <span class="material-symbols-outlined">notifications</span>
                </button>
                <div class="flex items-center gap-3">
                    <div class="bg-cover bg-center rounded-full size-10" 
                         style='background-image: url("{{ auth()->user()->avatar ?? "https://ui-avatars.com/api/?name=" . urlencode(auth()->user()->name) . "&background=005850&color=fff" }}");'>
                    </div>
                    <div class="hidden sm:block text-left">
                        <p class="font-semibold">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60 rounded-lg transition">
                        <span class="material-symbols-outlined">logout</span>
                        <span class="hidden sm:inline">Cerrar Sesión</span>
                    </button>
                </form>
            </div>
        </header>

        <!-- CONTENIDO PRINCIPAL -->
        <main class="flex-1 p-6 lg:p-10">
            <div class="max-w-7xl mx-auto">

                <form id="editForm" action="{{ route('activos.update', $activo->id) }}" method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">

                    <!-- FORMULARIO (AHORA SIN NOTAS - MÁS LIMPIO Y OCUPA TODO EL ESPACIO) -->
                    <div class="lg:col-span-9">
                        <div class="bg-white dark:bg-gray-900/70 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-lg p-8">
                            <div class="mb-8">
                                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Información del Activo</h2>
                                <p class="text-gray-500 dark:text-gray-400 mt-1">Actualiza los datos del equipo</p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold mb-2">ID</label>
                                    <input type="text" readonly value="{{ $activo->id }}" class="w-full h-12 px-4 rounded-xl bg-gray-100 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-lg font-medium">
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold mb-2">Sucursal/Área *</label>
                                    <input name="sucursal_area" value="{{ old('sucursal_area', $activo->sucursal_area) }}" required 
                                           class="w-full h-12 px-4 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 focus:ring-2 focus:ring-primary/50">
                                    <p class="text-red-500 text-xs mt-1 hidden error-text"></p>
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold mb-2">Razón Social *</label>
                                    <input name="razon_social" value="{{ old('razon_social', $activo->razon_social) }}" required 
                                           class="w-full h-12 px-4 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 focus:ring-2 focus:ring-primary/50">
                                    <p class="text-red-500 text-xs mt-1 hidden error-text"></p>
                                </div>

                                <div class="md:col-span-2 xl:col-span-3">
                                    <label class="block text-sm font-semibold mb-2">Código de Barras *</label>
                                    <input name="codigo_barras" value="{{ old('codigo_barras', $activo->codigo_barras) }}" required 
                                           class="w-full h-12 px-4 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 font-mono text-lg focus:ring-2 focus:ring-primary/50">
                                    <p class="text-red-500 text-xs mt-1 hidden error-text"></p>
                                </div>

                                <div><label class="block text-sm font-semibold mb-2">Marca *</label><input name="marca" value="{{ old('marca', $activo->marca) }}" required class="w-full h-12 px-4 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 focus:ring-2 focus:ring-primary/50"><p class="text-red-500 text-xs mt-1 hidden error-text"></p></div>
                                <div><label class="block text-sm font-semibold mb-2">Modelo *</label><input name="modelo" value="{{ old('modelo', $activo->modelo) }}" required class="w-full h-12 px-4 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 focus:ring-2 focus:ring-primary/50"><p class="text-red-500 text-xs mt-1 hidden error-text"></p></div>
                                <div><label class="block text-sm font-semibold mb-2">SD *</label><input name="sd" value="{{ old('sd', $activo->sd) }}" required class="w-full h-12 px-4 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 focus:ring-2 focus:ring-primary/50"><p class="text-red-500 text-xs mt-1 hidden error-text"></p></div>
                                <div><label class="block text-sm font-semibold mb-2">RAM *</label><input name="ram" value="{{ old('ram', $activo->ram) }}" required class="w-full h-12 px-4 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 focus:ring-2 focus:ring-primary/50"><p class="text-red-500 text-xs mt-1 hidden error-text"></p></div>
                                <div class="xl:col-span-2"><label class="block text-sm font-semibold mb-2">Procesador *</label><input name="procesador" value="{{ old('procesador', $activo->procesador) }}" required class="w-full h-12 px-4 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 focus:ring-2 focus:ring-primary/50"><p class="text-red-500 text-xs mt-1 hidden error-text"></p></div>

                                <div>
                                    <label class="block text-sm font-semibold mb-2">Asignado a</label>
                                    <input name="asignado" value="{{ old('asignado', $activo->asignado_a ?? '') }}" 
                                           class="w-full h-12 px-4 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800">
                                    <p class="text-red-500 text-xs mt-1 hidden error-text"></p>
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold mb-2">Estado *</label>
                                    <select name="estado" required class="w-full h-12 px-4 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 focus:ring-2 focus:ring-primary/50">
                                        <option value="Activo" {{ $activo->estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                                        <option value="En Reparación" {{ $activo->estado == 'En Reparación' ? 'selected' : '' }}>En Reparación</option>
                                        <option value="Obsoleto" {{ $activo->estado == 'Obsoleto' ? 'selected' : '' }}>Obsoleto</option>
                                        <option value="En Almacén" {{ $activo->estado == 'En Almacén' ? 'selected' : '' }}>En Almacén</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- BOTONES LATERALES FIJOS -->
                    <div class="lg:col-span-3">
                        <div class="sticky top-24 bg-white dark:bg-gray-900/70 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-lg p-8 space-y-6">
                            <div class="text-center">
                                <h3 class="text-xl font-bold mb-2">Acciones</h3>
                            </div>

                            <div class="space-y-4">
                                <a href="{{ route('activos.index') }}" 
                                   class="w-full block text-center py-4 px-6 border-2 border-gray-300 dark:border-gray-700 rounded-2xl font-semibold hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                    Cancelar
                                </a>
                                <button type="submit" id="btnGuardar" 
                                        class="w-full py-4 px-6 bg-primary text-white rounded-2xl font-bold text-lg hover:bg-primary/90 transition shadow-xl flex items-center justify-center gap-3">
                                    <span class="material-symbols-outlined text-2xl">save</span>
                                    Guardar Cambios
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>

<!-- TOAST -->
<div id="toast" class="fixed bottom-8 right-8 bg-green-600 text-white px-8 py-5 rounded-2xl shadow-2xl hidden flex items-center gap-4 z-50 text-lg font-semibold">
    <span class="material-symbols-outlined text-3xl">check_circle</span>
    <span>¡Activo actualizado correctamente!</span>
</div>

<script>
    // AJAX Form
    document.getElementById('editForm').onsubmit = function(e) {
        e.preventDefault();
        const btn = document.getElementById('btnGuardar');
        const original = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<span class="material-symbols-outlined animate-spin text-2xl">sync</span> Guardando...';

        document.querySelectorAll('.error-text').forEach(el => {
            el.classList.add('hidden'); el.textContent = '';
        });

        fetch(this.action, {
            method: 'POST',
            body: new FormData(this),
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(r => r.ok ? r.json() : r.json().then(err => {throw err}))
        .then(() => {
            const toast = document.getElementById('toast');
            toast.classList.remove('hidden');
            setTimeout(() => toast.classList.add('hidden'), 3000);
            setTimeout(() => location.href = "{{ route('activos.index') }}", 1000);
        })
        .catch(err => {
            if (err.errors) {
                Object.keys(err.errors).forEach(k => {
                    const input = document.querySelector(`[name="${k}"]`);
                    if (input) {
                        const p = input.parentNode.querySelector('.error-text');
                        if (p) { p.textContent = err.errors[k][0]; p.classList.remove('hidden'); }
                    }
                });
            }
        })
        .finally(() => {
            btn.disabled = false;
            btn.innerHTML = original;
        });
    };

    // Sidebar móvil
    document.getElementById('openSidebar')?.addEventListener('click', () => {
        document.getElementById('sidebar').classList.remove('-translate-x-full');
        document.getElementById('overlay').classList.remove('hidden');
    });
    document.getElementById('closeSidebar')?.addEventListener('click', () => {
        document.getElementById('sidebar').classList.add('-translate-x-full');
        document.getElementById('overlay').classList.add('hidden');
    });
    document.getElementById('overlay')?.addEventListener('click', () => {
        document.getElementById('sidebar').classList.add('-translate-x-full');
        document.getElementById('overlay').classList.add('hidden');
    });
</script>
</body>
</html>