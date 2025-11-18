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
                    boxShadow: { 'DEFAULT': '0 1px 2px 0 rgb(0 0 0 / 0.05)', 'md': '0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1)', 'lg': '0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1)', },
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
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 20; }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-gray-800 dark:text-gray-200">

<div class="relative flex h-auto min-h-screen w-full group/design-root overflow-x-hidden">
    <div class="layout-container flex h-full grow flex-row">

        <!-- TU SIDEBAR EXACTO -->
        <aside class="flex-col gap-y-6 items-stretch px-4 py-8 bg-white dark:bg-gray-900/50 border-r border-gray-200 dark:border-gray-800 hidden lg:flex w-64 shadow-sm">
            <div class="flex items-center justify-center gap-x-2 text-primary px-2">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd" d="M12.0799 24L4 19.2479L9.95537 8.75216L18.04 13.4961L18.0446 4H29.9554L29.96 13.4961L38.0446 8.75216L44 19.2479L35.92 24L44 28.7521L38.0446 39.2479L29.96 34.5039L29.9554 44H18.0446L18.04 34.5039L9.95537 39.2479L4 28.7521L12.0799 24Z" fill="currentColor" fill-rule="evenodd"></path>
                </svg>
                <span class="text-xl font-bold">Inventario TI</span>
            </div>
            <nav class="flex flex-col gap-y-2 flex-1">
                <a class="flex items-center gap-x-3 py-2 px-3 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60 transition-colors" href="#">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span class="text-sm font-medium">Dashboard</span>
                </a>
                <a class="flex items-center gap-x-3 py-2 px-3 rounded-lg text-white dark:text-white bg-primary dark:bg-primary transition-colors" href="#">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1, 'wght' 400;">inventory_2</span>
                    <span class="text-sm font-semibold">Inventario</span>
                </a>
                <a class="flex items-center gap-x-3 py-2 px-3 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60 transition-colors" href="#">
                    <span class="material-symbols-outlined">assessment</span>
                    <span class="text-sm font-medium">Reportes</span>
                </a>
                <a class="flex items-center gap-x-3 py-2 px-3 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60 transition-colors" href="#">
                    <span class="material-symbols-outlined">group</span>
                    <span class="text-sm font-medium">Usuarios</span>
                </a>
                <a class="flex items-center gap-x-3 py-2 px-3 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60 transition-colors" href="#">
                    <span class="material-symbols-outlined">category</span>
                    <span class="text-sm font-medium">Categorías</span>
                </a>
            </nav>
            <div class="flex flex-col gap-y-2">
                <a class="flex items-center gap-x-3 py-2 px-3 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60 transition-colors" href="#">
                    <span class="material-symbols-outlined">settings</span>
                    <span class="text-sm font-medium">Configuración</span>
                </a>
                <a class="flex items-center gap-x-3 py-2 px-3 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60 transition-colors" href="#">
                    <span class="material-symbols-outlined">logout</span>
                    <span class="text-sm font-medium">Cerrar Sesión</span>
                </a>
            </div>
        </aside>

        <div class="flex flex-col flex-1">
            <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-gray-200 dark:border-gray-800 px-6 sm:px-8 lg:px-10 py-3 bg-white/80 dark:bg-gray-900/80 backdrop-blur-sm sticky top-0 z-10">
                <div class="flex items-center gap-4">
                    <button class="lg:hidden text-gray-600 dark:text-gray-300">
                        <span class="material-symbols-outlined">menu</span>
                    </button>
                    <h1 class="text-lg font-semibold tracking-tight text-gray-900 dark:text-white">Editar Activo</h1>
                </div>
                <div class="flex flex-1 justify-end gap-2 items-center">
                    <button class="flex items-center justify-center rounded-full h-10 w-10 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60 transition-colors">
                        <span class="material-symbols-outlined">notifications</span>
                    </button>
                    <div class="flex items-center gap-x-3 py-2 pl-2 pr-3 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800/60 transition-colors cursor-pointer">
                        <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-9" data-alt="User avatar" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuA6DVvTRMI01mdiaqYjF9V4oxM0z9WULXszsPaaaaYoXXtrngbFF7MOPwD6OdpxAWGvzkXerhpPY9mAmC9vSKMLV8hKsZp2T5otC-Ea8y_XyDIj1nCBLHEcvtPsesGiDZ3niNWLv3-4DSHIlYP5SfjyDHqvPSfV8TQTmD419Cd0qB5pQC834L0HIHU6O11pxOiXoZeAF3b4GKBbpULfwHmYlC5ZN6a-EVUWpeAEpvLX64RIJsGfZikhuJgDmdvV6z22imA37kvlOfY");'></div>
                        <div class="hidden sm:flex flex-col flex-1 min-w-0">
                            <span class="text-sm font-semibold text-gray-800 dark:text-gray-100 truncate">Ana García</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400 truncate">Administrador</span>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 px-6 sm:px-8 lg:px-10 py-8 bg-background-light dark:bg-background-dark">
                <div class="max-w-7xl mx-auto flex flex-col gap-8">

                   <form id="editForm" action="{{ route('activos.update', $activo->id) }}" method="POST">
    @csrf
    <input type="hidden" name="_method" value="PUT">

    <!-- TODO TU CONTENIDO DEL FORMULARIO EXACTO (sin cambiar nada más) -->
    <div class="lg:col-span-2 flex flex-col gap-8">
        <div class="flex flex-col gap-6 p-6 sm:p-8 rounded-xl bg-white dark:bg-gray-900/50 border border-gray-200 dark:border-gray-800 shadow-sm">
            <div class="pb-4 border-b border-gray-200 dark:border-gray-800">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Información del Activo</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Detalles generales, especificaciones y estado actual del activo.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-5">

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">ID</label>
                    <input type="text" readonly value="{{ $activo->id }}" class="w-full h-10 px-3 text-sm rounded-lg bg-gray-50 dark:bg-gray-800/60 border border-gray-300 dark:border-gray-700">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Sucursal/Área</label>
                    <input name="sucursal_area" value="{{ $activo->sucursal_area }}" required class="w-full h-10 px-3 text-sm rounded-lg bg-gray-50 dark:bg-gray-800/60 border border-gray-300 dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-accent-1/50">
                    <p class="text-red-500 text-xs mt-1 hidden error-text"></p>
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Razón Social</label>
                    <input name="razon_social" value="{{ $activo->razon_social }}" required class="w-full h-10 px-3 text-sm rounded-lg bg-gray-50 dark:bg-gray-800/60 border border-gray-300 dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-accent-1/50">
                    <p class="text-red-500 text-xs mt-1 hidden error-text"></p>
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Código de Barras</label>
                    <input name="codigo_barras" value="{{ $activo->codigo_barras }}" required class="w-full h-10 px-3 text-sm rounded-lg bg-gray-50 dark:bg-gray-800/60 border border-gray-300 dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-accent-1/50">
                    <p class="text-red-500 text-xs mt-1 hidden error-text"></p>
                </div>

                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Marca</label><input name="marca" value="{{ $activo->marca }}" required class="w-full h-10 px-3 text-sm rounded-lg bg-gray-50 dark:bg-gray-800/60 border border-gray-300 dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-accent-1/50"><p class="text-red-500 text-xs mt-1 hidden error-text"></p></div>
                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Modelo</label><input name="modelo" value="{{ $activo->modelo }}" required class="w-full h-10 px-3 text-sm rounded-lg bg-gray-50 dark:bg-gray-800/60 border border-gray-300 dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-accent-1/50"><p class="text-red-500 text-xs mt-1 hidden error-text"></p></div>
                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">SD</label><input name="sd" value="{{ $activo->sd }}" required class="w-full h-10 px-3 text-sm rounded-lg bg-gray-50 dark:bg-gray-800/60 border border-gray-300 dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-accent-1/50"><p class="text-red-500 text-xs mt-1 hidden error-text"></p></div>
                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">RAM</label><input name="ram" value="{{ $activo->ram }}" required class="w-full h-10 px-3 text-sm rounded-lg bg-gray-50 dark:bg-gray-800/60 border border-gray-300 dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-accent-1/50"><p class="text-red-500 text-xs mt-1 hidden error-text"></p></div>
                <div class="sm:col-span-2"><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Procesador</label><input name="procesador" value="{{ $activo->procesador }}" required class="w-full h-10 px-3 text-sm rounded-lg bg-gray-50 dark:bg-gray-800/60 border border-gray-300 dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-accent-1/50"><p class="text-red-500 text-xs mt-1 hidden error-text"></p></div>
                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Asignado</label><input name="asignado" value="{{ $activo->asignado_a ?? '' }}" class="w-full h-10 px-3 text-sm rounded-lg bg-gray-50 dark:bg-gray-800/60 border border-gray-300 dark:border-gray-700"><p class="text-red-500 text-xs mt-1 hidden error-text"></p></div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Estado</label>
                    <select name="estado" required class="w-full h-10 px-3 text-sm rounded-lg bg-gray-50 dark:bg-gray-800/60 border border-gray-300 dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-accent-1/50">
                        <option value="Activo" {{ $activo->estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="En reparación" {{ $activo->estado == 'En reparación' ? 'selected' : '' }}>En reparación</option>
                        <option value="Obsoleto" {{ $activo->estado == 'Obsoleto' ? 'selected' : '' }}>Obsoleto</option>
                        <option value="En Almacén" {{ $activo->estado == 'En Almacén' ? 'selected' : '' }}>En Almacén</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-6 p-6 sm:p-8 rounded-xl bg-white dark:bg-gray-900/50 border border-gray-200 dark:border-gray-800 shadow-sm">
            <div class="pb-4 border-b border-gray-200 dark:border-gray-800">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Notas Adicionales</h2>
            </div>
            <textarea name="notas" class="w-full p-3 text-sm rounded-lg bg-gray-50 dark:bg-gray-800/60 border border-gray-300 dark:border-gray-700 min-h-[160px]">{{ $activo->notas ?? '' }}</textarea>
        </div>
    </div>

    <div class="lg:col-span-1 flex flex-col justify-end">
        <div class="sticky bottom-0 lg:static bg-background-light dark:bg-background-dark py-4 lg:py-0 flex justify-end items-center gap-3 lg:mt-auto">
            <a href="{{ url()->previous() }}" class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center gap-2 overflow-hidden rounded-lg h-10 px-4 bg-white dark:bg-gray-700/80 border border-gray-300 dark:border-gray-700 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors shadow-sm">
                <span class="truncate">Cancelar</span>
            </a>
            <button type="submit" id="btnGuardar" class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center gap-2 overflow-hidden rounded-lg h-10 px-4 bg-primary text-white text-sm font-medium hover:bg-primary/90 transition-colors shadow-sm">
                <span class="material-symbols-outlined text-lg">save</span>
                <span class="truncate">Guardar Cambios</span>
            </button>
        </div>
    </div>
</form>
</div>

<!-- TOAST -->
<div id="toast" class="fixed bottom-6 right-6 bg-green-600 text-white px-6 py-4 rounded-xl shadow-2xl hidden flex items-center gap-3 z-50">
    <span class="material-symbols-outlined">check_circle</span>
    <span>¡Cambios guardados!</span>
</div>
<script>
document.getElementById('editForm').onsubmit = function(e) {
    e.preventDefault();
    
    const btn = document.getElementById('btnGuardar');
    const original = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<span class="material-symbols-outlined text-lg animate-spin">sync</span> Guardando...';

    // Limpiar errores
    document.querySelectorAll('.error-text').forEach(el => {
        el.classList.add('hidden');
        el.textContent = '';
    });

    fetch(this.action, {
        method: 'POST',
        body: new FormData(this),
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(r => {
        if (!r.ok) {
            return r.json().then(err => { throw err; });
        }
        return r.json();
    })
    .then(data => {
        alert('¡Activo actualizado correctamente!');
        window.location.href = "{{ route('activos.index') }}";
    })
    .catch(err => {
        if (err.errors) {
            Object.keys(err.errors).forEach(key => {
                const input = document.querySelector(`[name="${key}"]`);
                if (input) {
                    const p = input.parentNode.querySelector('.error-text');
                    if (p) {
                        p.textContent = err.errors[key][0];
                        p.classList.remove('hidden');
                    }
                }
            });
        }
    })
    .finally(() => {
        btn.disabled = false;
        btn.innerHTML = original;
    });
};
</script>
</body>
</html>