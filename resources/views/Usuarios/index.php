<!DOCTYPE html>

<html class="dark" lang="es"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Gestión de Usuarios</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&amp;display=swap" rel="stylesheet"/>
<script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#4A90E2",
                        "background-light": "#F5F5F5",
                        "background-dark": "#101922",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.5rem",
                        "lg": "0.75rem",
                        "xl": "1rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display">
<div class="relative flex h-auto min-h-screen w-full flex-col">
<div class="flex h-full grow flex-row">
<aside class="flex h-auto flex-col justify-between bg-[#111a22] p-4 w-64">
<div class="flex flex-col gap-4">
<div class="flex gap-3 items-center">
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" data-alt="Admin User Avatar" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuANCcC4Vg5N0NQLEevQVET4_GtNHmQLwC8cj5oFEcK48QKqxfDXRyD67vHrdqZg5gFSjM-QGCd5eVZaGSQHPhWWqgRbFacfi7TgJ_jeGxs6a4J9aeTYfyJ3YEf6FaVGKECMSn-Tf7MIrShyDYKXQ3DTPrMKB_z8vL4rQhlnINQ0Eb_-ExWdY_URdOpyAR6YANqTv7lXda2gBTpYaBzlZEKqzWQjaVWsGTGjGrruyCnK08Lut6mOwL4kIyhZCK6WAMvVAzS7kO4VwO4");'></div>
<div class="flex flex-col">
<h1 class="text-white text-base font-medium leading-normal">Admin User</h1>
<p class="text-[#92adc9] text-sm font-normal leading-normal">admin@example.com</p>
</div>
</div>
<div class="flex flex-col gap-2">
<a class="flex items-center gap-3 px-3 py-2 text-white hover:bg-[#233648] rounded-lg" href="#">
<span class="material-symbols-outlined">dashboard</span>
<p class="text-sm font-medium leading-normal">Dashboard</p>
</a>
<a class="flex items-center gap-3 px-3 py-2 text-white hover:bg-[#233648] rounded-lg" href="#">
<span class="material-symbols-outlined">inventory_2</span>
<p class="text-sm font-medium leading-normal">Inventario</p>
</a>
<a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary text-white" href="#">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">group</span>
<p class="text-sm font-medium leading-normal">Usuarios</p>
</a>
<a class="flex items-center gap-3 px-3 py-2 text-white hover:bg-[#233648] rounded-lg" href="#">
<span class="material-symbols-outlined">settings</span>
<p class="text-sm font-medium leading-normal">Configuración</p>
</a>
</div>
</div>
<div class="flex flex-col gap-4">
<button class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-[#233648] text-white text-sm font-bold leading-normal tracking-[0.015em] w-full">
<span class="truncate">Cerrar Sesión</span>
</button>
</div>
</aside>
<main class="flex-1 p-8">
<div class="grid grid-cols-3 gap-8">
<div class="col-span-3 lg:col-span-2">
<div class="flex flex-wrap justify-between gap-3 p-4 items-center">
<div class="flex flex-col gap-3">
<p class="text-gray-800 dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]">Gestión de Usuarios</p>
<p class="text-gray-500 dark:text-[#92adc9] text-base font-normal leading-normal">Crear, editar y eliminar cuentas de usuario, asignar roles y gestionar permisos.</p>
</div>
<button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold leading-normal tracking-[0.015em]">
<span class="material-symbols-outlined mr-2">add</span>
<span class="truncate">Agregar Usuario</span>
</button>
</div>
<div class="p-4">
<label class="flex flex-col min-w-40 h-12 w-full">
<div class="flex w-full flex-1 items-stretch rounded-lg h-full">
<div class="text-gray-400 dark:text-[#92adc9] flex border-r-0 bg-white dark:bg-[#233648] items-center justify-center pl-4 rounded-l-lg">
<span class="material-symbols-outlined">search</span>
</div>
<input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-800 dark:text-white focus:outline-0 focus:ring-0 border-none bg-white dark:bg-[#233648] h-full placeholder:text-gray-400 dark:placeholder:text-[#92adc9] px-4 rounded-l-none border-l-0 pl-2 text-base font-normal leading-normal" placeholder="Buscar usuarios por nombre o correo electrónico" value=""/>
</div>
</label>
</div>
<div class="flex gap-3 p-4 overflow-x-auto">
<button class="flex h-8 shrink-0 items-center justify-center gap-x-2 rounded-full bg-primary/20 dark:bg-[#233648] px-4">
<p class="text-primary dark:text-white text-sm font-medium leading-normal">Todos</p>
</button>
<button class="flex h-8 shrink-0 items-center justify-center gap-x-2 rounded-full bg-gray-200 dark:bg-[#233648] px-4">
<p class="text-gray-700 dark:text-white text-sm font-medium leading-normal">Administrador</p>
</button>
<button class="flex h-8 shrink-0 items-center justify-center gap-x-2 rounded-full bg-gray-200 dark:bg-[#233648] px-4">
<p class="text-gray-700 dark:text-white text-sm font-medium leading-normal">Técnico</p>
</button>
<button class="flex h-8 shrink-0 items-center justify-center gap-x-2 rounded-full bg-gray-200 dark:bg-[#233648] px-4">
<p class="text-gray-700 dark:text-white text-sm font-medium leading-normal">Usuario</p>
</button>
</div>
<div class="px-4 py-3">
<div class="flex overflow-hidden rounded-lg border border-gray-200 dark:border-[#324d67] bg-background-light dark:bg-[#111a22]">
<table class="flex-1">
<thead>
<tr class="bg-gray-100 dark:bg-[#192633]">
<th class="px-4 py-3 text-left text-gray-600 dark:text-white w-[25%] text-sm font-medium leading-normal">Usuario</th>
<th class="px-4 py-3 text-left text-gray-600 dark:text-white w-[25%] text-sm font-medium leading-normal">Email</th>
<th class="px-4 py-3 text-left text-gray-600 dark:text-white w-[15%] text-sm font-medium leading-normal">Rol</th>
<th class="px-4 py-3 text-left text-gray-600 dark:text-white w-[15%] text-sm font-medium leading-normal">Estado</th>
<th class="px-4 py-3 text-left text-gray-600 dark:text-white w-[20%] text-sm font-medium leading-normal">Acciones</th>
</tr>
</thead>
<tbody>
<tr class="border-t border-t-gray-200 dark:border-t-[#324d67]">
<td class="h-[72px] px-4 py-2 text-gray-800 dark:text-white text-sm font-normal leading-normal">ana.garcia</td>
<td class="h-[72px] px-4 py-2 text-gray-500 dark:text-[#92adc9] text-sm font-normal leading-normal">ana.garcia@example.com</td>
<td class="h-[72px] px-4 py-2 text-sm font-normal leading-normal">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">Administrador</span>
</td>
<td class="h-[72px] px-4 py-2 text-sm font-normal leading-normal">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">Activo</span>
</td>
<td class="h-[72px] px-4 py-2 text-sm font-bold leading-normal tracking-[0.015em]">
<button class="text-primary dark:text-primary p-1 rounded hover:bg-primary/10"><span class="material-symbols-outlined text-base">edit</span></button>
<button class="text-red-500 p-1 rounded hover:bg-red-500/10"><span class="material-symbols-outlined text-base">delete</span></button>
</td>
</tr>
<tr class="border-t border-t-gray-200 dark:border-t-[#324d67]">
<td class="h-[72px] px-4 py-2 text-gray-800 dark:text-white text-sm font-normal leading-normal">carlos.rodriguez</td>
<td class="h-[72px] px-4 py-2 text-gray-500 dark:text-[#92adc9] text-sm font-normal leading-normal">carlos.rodriguez@example.com</td>
<td class="h-[72px] px-4 py-2 text-sm font-normal leading-normal">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">Técnico</span>
</td>
<td class="h-[72px] px-4 py-2 text-sm font-normal leading-normal">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">Activo</span>
</td>
<td class="h-[72px] px-4 py-2 text-sm font-bold leading-normal tracking-[0.015em]">
<button class="text-primary dark:text-primary p-1 rounded hover:bg-primary/10"><span class="material-symbols-outlined text-base">edit</span></button>
<button class="text-red-500 p-1 rounded hover:bg-red-500/10"><span class="material-symbols-outlined text-base">delete</span></button>
</td>
</tr>
<tr class="border-t border-t-gray-200 dark:border-t-[#324d67]">
<td class="h-[72px] px-4 py-2 text-gray-800 dark:text-white text-sm font-normal leading-normal">sofia.martinez</td>
<td class="h-[72px] px-4 py-2 text-gray-500 dark:text-[#92adc9] text-sm font-normal leading-normal">sofia.martinez@example.com</td>
<td class="h-[72px] px-4 py-2 text-sm font-normal leading-normal">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">Usuario</span>
</td>
<td class="h-[72px] px-4 py-2 text-sm font-normal leading-normal">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">Inactivo</span>
</td>
<td class="h-[72px] px-4 py-2 text-sm font-bold leading-normal tracking-[0.015em]">
<button class="text-primary dark:text-primary p-1 rounded hover:bg-primary/10"><span class="material-symbols-outlined text-base">edit</span></button>
<button class="text-red-500 p-1 rounded hover:bg-red-500/10"><span class="material-symbols-outlined text-base">delete</span></button>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
<div class="col-span-3 lg:col-span-1 bg-white dark:bg-[#192633] rounded-xl p-6 shadow-lg">
<h2 class="text-xl font-bold text-gray-800 dark:text-white mb-6">Agregar/Editar Usuario</h2>
<form class="space-y-6">
<div>
<label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="username">Nombre de Usuario</label>
<input class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-[#233648] text-gray-800 dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm" id="username" name="username" placeholder="e.g., juan.perez" type="text"/>
</div>
<div>
<label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="email">Correo Electrónico</label>
<input class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-[#233648] text-gray-800 dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm" id="email" name="email" placeholder="e.g., juan.perez@example.com" type="email"/>
</div>
<div>
<label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="role">Rol</label>
<select class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-[#233648] text-gray-800 dark:text-white focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md" id="role" name="role">
<option>Administrador</option>
<option>Técnico</option>
<option selected="">Usuario</option>
</select>
</div>
<div>
<label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="password">Contraseña</label>
<button class="mt-1 w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-400 dark:bg-gray-600 hover:bg-gray-500 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500" type="button">
                                    Restablecer Contraseña
                                </button>
</div>
<div class="flex justify-end space-x-3 pt-4">
<button class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 bg-gray-200 dark:bg-[#233648] rounded-md hover:bg-gray-300 dark:hover:bg-[#324d67]" type="button">Cancelar</button>
<button class="px-4 py-2 text-sm font-medium text-white bg-primary rounded-md hover:bg-primary/90" type="submit">Guardar Cambios</button>
</div>
</form>
</div>
</div>
</main>
</div>
</div>
</body></html>