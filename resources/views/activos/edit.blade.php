<!DOCTYPE html>
<html class="dark" lang="es">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Editar Activo</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
<script>
tailwind.config = {
    darkMode: "class",
    theme: {
        extend: {
            colors: {
                "primary": "#00868a",
                "primary-focus": "#005850",
                "accent": "#62c443",
                "background-light": "#f6f7f8",
                "background-dark": "#101922",
                "teal-light": "#7ac5c7",
                "teal-darker": "#05553c",
                "teal-medium": "#01a48b",
                "teal-dark": "#007a63"
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
<body class="font-display bg-background-light dark:bg-background-dark">
<div class="relative flex min-h-screen w-full">
<!-- Sidebar -->
<aside class="flex h-screen w-64 flex-col bg-white dark:bg-gray-900/50 border-r border-gray-200 dark:border-gray-800">
    <div class="flex flex-col grow p-4">
        <!-- 🔹 LOGO CAMBIADO A IMAGEN -->
        <div class="flex items-center gap-3 mb-8 px-2">
            <img src="images/pmn.png" alt="Logo AssetFlow" class="w-10 h-10 rounded-lg object-cover bg-primary-focus p-1"/>
            <h1 class="text-gray-800 dark:text-white text-lg font-bold leading-normal">AssetFlow</h1>
        </div>

        <!-- Menú lateral -->
        <div class="flex flex-col gap-2">
            <a class="flex items-center gap-3 px-3 py-2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800/50 rounded-lg" href="#">
                <span class="material-symbols-outlined text-2xl">dashboard</span>
                <p class="text-sm font-medium">Dashboard</p>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-teal-light/20 dark:bg-primary-focus/80 text-teal-dark dark:text-white" href="#">
                <span class="material-symbols-outlined text-2xl text-primary dark:text-teal-light" style="font-variation-settings: 'FILL' 1;">inventory</span>
                <p class="text-sm font-medium">Inventario</p>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800/50 rounded-lg" href="#">
                <span class="material-symbols-outlined text-2xl">group</span>
                <p class="text-sm font-medium">Usuarios</p>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800/50 rounded-lg" href="#">
                <span class="material-symbols-outlined text-2xl">monitoring</span>
                <p class="text-sm font-medium">Reportes</p>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800/50 rounded-lg" href="#">
                <span class="material-symbols-outlined text-2xl">settings</span>
                <p class="text-sm font-medium">Configuración</p>
            </a>
        </div>

        <!-- Sección inferior -->
        <div class="mt-auto flex flex-col gap-1">
            <a class="flex items-center gap-3 px-3 py-2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800/50 rounded-lg" href="#">
                <span class="material-symbols-outlined text-2xl">help</span>
                <p class="text-sm font-medium">Ayuda</p>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800/50 rounded-lg" href="#">
                <span class="material-symbols-outlined text-2xl">logout</span>
                <p class="text-sm font-medium">Cerrar Sesión</p>
            </a>
        </div>
    </div>
</aside>

<!-- Main content -->
<main class="flex-1 overflow-y-auto">
<div class="px-6 py-8 md:px-10">
<div class="mx-auto max-w-7xl">
<div class="mb-8">
<p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Inventario &gt; Editar Activo</p>
<h1 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Editar Activo: Laptop de Desarrollo</h1>
</div>

<!-- Formulario -->
<div class="bg-white dark:bg-gray-900/50 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800">
<form class="p-6 md:p-8">
<div class="space-y-8">
<div class="space-y-6">
<h2 class="text-lg font-semibold text-gray-900 dark:text-white">Información General</h2>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
<label class="flex flex-col col-span-1 lg:col-span-2">
<p class="text-sm font-medium text-gray-700 dark:text-gray-300 pb-2">Nombre del Activo</p>
<input class="form-input flex w-full rounded-lg text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-teal-dark focus:border-teal-dark h-11 placeholder:text-gray-400 dark:placeholder:text-gray-500 px-3 text-sm" type="text" value="Laptop de Desarrollo Principal"/>
</label>
<label class="flex flex-col col-span-1">
<p class="text-sm font-medium text-gray-700 dark:text-gray-300 pb-2">Tipo de Activo</p>
<select class="form-select flex w-full rounded-lg text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-teal-dark focus:border-teal-dark h-11 px-3 text-sm">
<option>Monitor</option>
<option selected="">Laptop</option>
<option>Teclado</option>
<option>Servidor</option>
</select>
</label>
<label class="flex flex-col col-span-1">
<p class="text-sm font-medium text-gray-700 dark:text-gray-300 pb-2">Estado</p>
<select class="form-select flex w-full rounded-lg text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-teal-dark focus:border-teal-dark h-11 px-3 text-sm">
<option selected="">En Uso</option>
<option>En Almacén</option>
<option>En Mantenimiento</option>
<option>Retirado</option>
</select>
</label>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
<label class="flex flex-col col-span-1">
<p class="text-sm font-medium text-gray-700 dark:text-gray-300 pb-2">Número de Serie</p>
<input class="form-input flex w-full rounded-lg text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-teal-dark focus:border-teal-dark h-11 placeholder:text-gray-400 dark:placeholder:text-gray-500 px-3 text-sm" type="text" value="SN-XPS15-9520-12345"/>
</label>
<label class="flex flex-col col-span-1">
<p class="text-sm font-medium text-gray-700 dark:text-gray-300 pb-2">Identificador Único</p>
<input class="form-input flex w-full rounded-lg text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-teal-dark focus:border-teal-dark h-11 placeholder:text-gray-400 dark:placeholder:text-gray-500 px-3 text-sm" type="text" value="IT-DEV-001"/>
</label>
<label class="flex flex-col col-span-1">
<p class="text-sm font-medium text-gray-700 dark:text-gray-300 pb-2">Ubicación</p>
<select class="form-select flex w-full rounded-lg text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-teal-dark focus:border-teal-dark h-11 px-3 text-sm">
<option>Oficina Central - Piso 3</option>
<option selected="">Oficina Central - Piso 5</option>
<option>Almacén Principal</option>
<option>Remoto</option>
</select>
</label>
<label class="flex flex-col col-span-1">
<p class="text-sm font-medium text-gray-700 dark:text-gray-300 pb-2">Usuario Asignado</p>
<input class="form-input flex w-full rounded-lg text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-teal-dark focus:border-teal-dark h-11 placeholder:text-gray-400 dark:placeholder:text-gray-500 px-3 text-sm" type="text" value="juan.perez@empresa.com"/>
</label>
</div>
</div>

<hr class="border-gray-200 dark:border-gray-800"/>

<div class="space-y-6">
<h2 class="text-lg font-semibold text-gray-900 dark:text-white">Detalles de Adquisición y Vida Útil</h2>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
<label class="flex flex-col col-span-1">
<p class="text-sm font-medium text-gray-700 dark:text-gray-300 pb-2">Fecha de Compra</p>
<input class="form-input flex w-full rounded-lg text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-teal-dark focus:border-teal-dark h-11 px-3 text-sm" type="date" value="2023-01-15"/>
</label>
<label class="flex flex-col col-span-1">
<p class="text-sm font-medium text-gray-700 dark:text-gray-300 pb-2">Vencimiento de Garantía</p>
<input class="form-input flex w-full rounded-lg text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-teal-dark focus:border-teal-dark h-11 px-3 text-sm" type="date" value="2026-01-14"/>
</label>
</div>
</div>

<hr class="border-gray-200 dark:border-gray-800"/>

<div class="space-y-6">
<h2 class="text-lg font-semibold text-gray-900 dark:text-white">Notas Adicionales</h2>
<label class="flex flex-col">
<textarea class="form-textarea w-full rounded-lg text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-teal-dark focus:border-teal-dark placeholder:text-gray-400 dark:placeholder:text-gray-500 p-3 text-sm" rows="4">Se instaló software de desarrollo adicional el 20/03/2024. Batería reemplazada en Q1 2024.</textarea>
</label>
</div>
</div>

<div class="flex items-center justify-end gap-4 pt-8 mt-8 border-t border-gray-200 dark:border-gray-800">
<button class="px-4 py-2 text-sm font-semibold text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700/50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-background-light dark:focus:ring-offset-background-dark focus:ring-teal-dark" type="button">Cancelar</button>
<button class="px-4 py-2 text-sm font-semibold text-white bg-primary hover:bg-teal-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-background-light dark:focus:ring-offset-background-dark focus:ring-primary-focus rounded-lg shadow-sm" type="submit">Guardar Cambios</button>
</div>
</form>
</div>
</div>
</div>
</main>
</div>
</body>
</html>
