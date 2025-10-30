<!DOCTYPE html>
<html class="dark" lang="es">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Dashboard de Inventario de TI</title>
@vite(['resources/css/app.css', 'resources/js/app.js'])
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
<script>
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
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
                fontFamily: {
                    "display": ["Inter", "sans-serif"]
                },
                borderRadius: {
                    "DEFAULT": "0.25rem",
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                    "full": "9999px"
                },
            },
        },
    }
</script>
<style>
    .material-symbols-outlined {
        font-variation-settings:
        'FILL' 0,
        'wght' 400,
        'GRAD' 0,
        'opsz' 24
    }
</style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display">
<div class="relative flex h-auto min-h-screen w-full group/design-root overflow-x-hidden">

<!-- Sidebar -->
<div class="layout-container flex h-full grow flex-row">
<aside class="flex-col gap-y-6 items-stretch px-4 py-8 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 hidden lg:flex">

    <!-- Logo superior -->
    <div class="flex items-center justify-center gap-x-2 text-primary">
        <img src="{{ asset('images\pmn.png') }}" alt="Logo PMN" class="h-10 w-10 object-contain"/>
        <span class="text-xl font-bold">Inventario TI</span>
    </div>

    <!-- Menú -->
    <nav class="flex flex-col gap-y-2 flex-1">
        <a class="flex items-center gap-x-3 py-2 px-3 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700" href="{{ route('dashboard') }}">
            <span class="material-symbols-outlined">home</span>
            <span class="text-sm font-medium">Inicio</span>
        </a>
        <a class="flex items-center gap-x-3 py-2 px-3 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700" href="{{ route('activos.index') }}">
            <span class="material-symbols-outlined">inventory_2</span>
            <span class="text-sm font-medium">Inventario</span>
        </a>
        <a class="flex items-center gap-x-3 py-2 px-3 rounded-lg text-white bg-primary" href="{{ route('dashboard') }}">
            <span class="material-symbols-outlined">dashboard</span>
            <span class="text-sm font-medium">Dashboard</span>
        </a>
        <a class="flex items-center gap-x-3 py-2 px-3 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700" href="{{ route('alertas.index') }}">
            <span class="material-symbols-outlined">notifications_active</span>
            <span class="text-sm font-medium">Alertas</span>
        </a>
        <a class="flex items-center gap-x-3 py-2 px-3 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700" href="{{ route('reportes.index') }}">
            <span class="material-symbols-outlined">assessment</span>
            <span class="text-sm font-medium">Reportes</span>
        </a>
        <a class="flex items-center gap-x-3 py-2 px-3 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700" href="{{ route('usuarios.index') }}">
            <span class="material-symbols-outlined">group</span>
            <span class="text-sm font-medium">Gestión de Usuarios</span>
        </a>
    </nav>

    <!-- Configuración y logout -->
    <div class="flex flex-col gap-y-2">
        <a class="flex items-center gap-x-3 py-2 px-3 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700" href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <span class="material-symbols-outlined">logout</span>
            <span class="text-sm font-medium">Cerrar Sesión</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>

        <div class="flex items-center gap-x-3 py-2 px-3 mt-4 rounded-lg border border-gray-200 dark:border-gray-700">
            <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuA6DVvTRMI01mdiaqYjF9V4oxM0z9WULXszsPaaaaYoXXtrngbFF7MOPwD6OdpxAWGvzkXerhpPY9mAmC9vSKMLV8hKsZp2T5otC-Ea8y_XYDIj1nCBLHEcvtPsesGiDZ3niNWLv3-4DSHIlYP5SfjyDHqvPSfV8TQTmD419Cd0qB5pQC834L0HIHU6O11pxOiXoZeAF3b4GKBbpULfwHmYlC5ZN6a-EVUWpeAEpvLX64RIJsGfZikhuJgDmdvV6z22imA37kvlOfY");'></div>
            <div class="flex flex-col">
                <span class="text-sm font-semibold text-gray-800 dark:text-gray-100">Ana García</span>
                <span class="text-xs text-gray-500 dark:text-gray-400">admin@example.com</span>
            </div>
        </div>
    </div>
</aside>

<!-- Contenido principal -->
<div class="flex flex-col flex-1">
<header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-gray-200 dark:border-gray-700 px-10 py-3 bg-white dark:bg-background-dark">
    <div class="flex items-center gap-4">
        <img src="{{ asset('images\pmn.png') }}" alt="Logo PMN" class="h-8 w-8 object-contain"/>
        <h2 class="text-lg font-bold leading-tight tracking-[-0.015em] text-gray-900 dark:text-white">Gestión de Inventario</h2>
    </div>
    <div class="flex flex-1 justify-end gap-4 items-center">
        <button class="flex items-center justify-center rounded-full h-10 w-10 bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">
            <span class="material-symbols-outlined text-lg">notifications</span>
        </button>
    </div>
</header>

<main class="flex-1 px-4 sm:px-6 lg:px-10 py-8">
<div class="max-w-7xl mx-auto">
    <!-- Título y botón -->
    <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
        <p class="text-gray-900 dark:text-white text-3xl font-black leading-tight tracking-[-0.033em]">Dashboard de Inventario de TI</p>
        <button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold leading-normal tracking-[0.015em] hover:bg-opacity-90">
            <span class="truncate">Personalizar Dashboard</span>
        </button>
    </div>

    <!-- Filtros -->
    <div class="flex gap-3 mb-6 overflow-x-auto pb-2">
        <button class="flex h-9 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 pl-4 pr-3 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/50">
            <p class="text-sm font-medium leading-normal">Sucursal</p>
            <span class="material-symbols-outlined text-lg">arrow_drop_down</span>
        </button>
        <button class="flex h-9 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 pl-4 pr-3 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/50">
            <p class="text-sm font-medium leading-normal">Tipo de activo</p>
            <span class="material-symbols-outlined text-lg">arrow_drop_down</span>
        </button>
        <button class="flex h-9 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 pl-4 pr-3 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/50">
            <p class="text-sm font-medium leading-normal">Rango de fechas</p>
            <span class="material-symbols-outlined text-lg">arrow_drop_down</span>
        </button>
    </div>

    <!-- Métricas rápidas -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        <div class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
            <p class="text-gray-600 dark:text-gray-400 text-base font-medium leading-normal">Total de Activos</p>
            <p class="text-gray-900 dark:text-white text-3xl font-bold leading-tight">1,234</p>
        </div>
        <div class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
            <p class="text-gray-600 dark:text-gray-400 text-base font-medium leading-normal">Activos por Asignar</p>
            <p class="text-gray-900 dark:text-white text-3xl font-bold leading-tight">56</p>
        </div>
        <div class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
            <p class="text-gray-600 dark:text-gray-400 text-base font-medium leading-normal">Vencimientos este mes</p>
            <p class="text-gray-900 dark:text-white text-3xl font-bold leading-tight">7</p>
        </div>
    </div>

    <!-- Gráficos -->
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
        <!-- Activos por Sucursal -->
        <div class="lg:col-span-2 flex flex-col gap-4 rounded-xl border border-gray-200 dark:border-gray-700 p-6 bg-white dark:bg-gray-800">
            <p class="text-gray-900 dark:text-white text-lg font-semibold leading-normal">Activos por Sucursal</p>
            <div class="flex items-center justify-center flex-1">
                <div class="relative w-48 h-48">
                    <svg class="w-full h-full" viewBox="0 0 36 36">
                        <circle class="stroke-current text-gray-200 dark:text-gray-700" cx="18" cy="18" fill="none" r="15.91549430918954" stroke-width="3"></circle>
                        <circle class="stroke-current text-accent-1" cx="18" cy="18" fill="none" r="15.91549430918954" stroke-dasharray="60, 100" stroke-dashoffset="25" stroke-width="3"></circle>
                        <circle class="stroke-current text-accent-4" cx="18" cy="18" fill="none" r="15.91549430918954" stroke-dasharray="25, 100" stroke-dashoffset="-35" stroke-width="3"></circle>
                        <circle class="stroke-current text-accent-5" cx="18" cy="18" fill="none" r="15.91549430918954" stroke-dasharray="15, 100" stroke-dashoffset="-60" stroke-width="3"></circle>
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-2xl font-bold text-gray-900 dark:text-white">1234</span>
                    </div>
                </div>
            </div>
            <div class="flex justify-center gap-4 text-sm">
                <div class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-accent-1"></span><span class="text-gray-600 dark:text-gray-400">Suc. A</span></div>
                <div class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-accent-4"></span><span class="text-gray-600 dark:text-gray-400">Suc. B</span></div>
                <div class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-accent-5"></span><span class="text-gray-600 dark:text-gray-400">Suc. C</span></div>
            </div>
        </div>

        <!-- Estado de los Activos -->
        <div class="lg:col-span-3 flex flex-col gap-4 rounded-xl border border-gray-200 dark:border-gray-700 p-6 bg-white dark:bg-gray-800">
            <p class="text-gray-900 dark:text-white text-lg font-semibold leading-normal">Estado de los Activos</p>
            <div class="flex-1 grid grid-cols-3 gap-4 items-end px-3">
                <div class="flex flex-col items-center gap-2">
                    <div class="w-full bg-secondary/30 dark:bg-secondary/20 rounded-t-lg" style="height: 60%;">
                        <div class="w-full h-full bg-secondary rounded-t-lg"></div>
                    </div>
                    <p class="text-gray-500 dark:text-gray-400 text-xs font-medium leading-normal">Activo</p>
                </div>
                <div class="flex flex-col items-center gap-2">
                    <div class="w-full bg-accent-2/30 dark:bg-accent-2/20 rounded-t-lg" style="height: 35%;">
                        <div class="w-full h-full bg-accent-2 rounded-t-lg"></div>
                    </div>
                    <p class="text-gray-500 dark:text-gray-400 text-xs font-medium leading-normal">En reparación</p>
                </div>
                <div class="flex flex-col items-center gap-2">
                    <div class="w-full bg-accent-3/30 dark:bg-accent-3/20 rounded-t-lg" style="height: 15%;">
                        <div class="w-full h-full bg-accent-3 rounded-t-lg"></div>
                    </div>
                    <p class="text-gray-500 dark:text-gray-400 text-xs font-medium leading-normal">Obsoleto</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Próximos Vencimientos -->
    <div class="mt-6 flex flex-col gap-4 rounded-xl border border-gray-200 dark:border-gray-700 p-6 bg-white dark:bg-gray-800">
        <p class="text-gray-900 dark:text-white text-lg font-semibold leading-normal">Próximos Vencimientos</p>
        <div class="h-64 w-full">
            <div class="h-full w-full flex items-end gap-6 px-4">
                <div class="flex-1 h-full flex flex-col justify-end items-center">
                    <div class="w-1/2 rounded-t-lg bg-primary/20 hover:bg-primary/40 transition-colors" style="height: 40%"></div>
                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Enero</p>
                </div>
                <div class="flex-1 h-full flex flex-col justify-end items-center">
                    <div class="w-1/2 rounded-t-lg bg-primary/20 hover:bg-primary/40 transition-colors" style="height: 60%"></div>
                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Febrero</p>
                </div>
                <div class="flex-1 h-full flex flex-col justify-end items-center">
                    <div class="w-1/2 rounded-t-lg bg-primary/20 hover:bg-primary/40 transition-colors" style="height: 30%"></div>
                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Marzo</p>
                </div>
                <div class="flex-1 h-full flex flex-col justify-end items-center">
                    <div class="w-1/2 rounded-t-lg bg-primary/20 hover:bg-primary/40 transition-colors" style="height: 75%"></div>
                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Abril</p>
                </div>
                <div class="flex-1 h-full flex flex-col justify-end items-center">
                    <div class="w-1/2 rounded-t-lg bg-primary/20 hover:bg-primary/40 transition-colors" style="height: 50%"></div>
                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Mayo</p>
                </div>
                <div class="flex-1 h-full flex flex-col justify-end items-center">
                    <div class="w-1/2 rounded-t-lg bg-primary/20 hover:bg-primary/40 transition-colors" style="height: 85%"></div>
                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Junio</p>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
</div>
</div>
</div>
</body>
</html>
