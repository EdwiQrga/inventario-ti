<!DOCTYPE html>
<html class="dark" lang="es"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Generación de Informes</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#4ade80",
                        "background-light": "#f3f4f6",
                        "background-dark": "#111827",
                        "sidebar": "#1f2937",
                        "card": "#374151",
                        "accent": "#4b5563",
                        "subtle-accent": "#9ca3af",
                        "table-header": "#374151"
                    },
                    fontFamily: {
                        "display": ["Inter", "Noto Sans", "sans-serif"]
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
</head>
<body class="bg-background-light dark:bg-background-dark font-display">
<div class="relative flex h-auto min-h-screen w-full flex-col group/design-root overflow-x-hidden">
<div class="flex flex-grow">
<div class="w-64 bg-sidebar p-4 flex-col justify-between hidden lg:flex">
<div class="flex flex-col gap-4">
<div class="flex flex-col gap-2 mt-4">
    <a href="{{ route('home') }}" class="flex items-center gap-3 px-3 py-2 cursor-pointer rounded-lg hover:bg-accent">
        <span class="material-symbols-outlined text-subtle-accent">home</span>
        <p class="text-subtle-accent text-sm font-medium leading-normal">Inicio</p>
    </a>

    <a href="{{ route('inventario.index') }}" class="flex items-center gap-3 px-3 py-2 cursor-pointer rounded-lg hover:bg-accent">
        <span class="material-symbols-outlined text-subtle-accent">inventory_2</span>
        <p class="text-subtle-accent text-sm font-medium leading-normal">Inventario</p>
    </a>

    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2 cursor-pointer rounded-lg hover:bg-accent">
        <span class="material-symbols-outlined text-subtle-accent">dashboard</span>
        <p class="text-subtle-accent text-sm font-medium leading-normal">Dashboard</p>
    </a>

    <a href="{{ route('alertas.index') }}" class="flex items-center gap-3 px-3 py-2 cursor-pointer rounded-lg hover:bg-accent">
        <span class="material-symbols-outlined text-subtle-accent">notifications</span>
        <p class="text-subtle-accent text-sm font-medium leading-normal">Alertas</p>
    </a>

    <a href="{{ route('reportes.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg bg-accent cursor-pointer">
        <span class="material-symbols-outlined text-white" style="font-variation-settings: 'FILL' 1">description</span>
        <p class="text-white text-sm font-medium leading-normal">Reportes</p>
    </a>

    <a href="{{ route('usuarios.index') }}" class="flex items-center gap-3 px-3 py-2 cursor-pointer rounded-lg hover:bg-accent">
        <span class="material-symbols-outlined text-subtle-accent">group</span>
        <p class="text-subtle-accent text-sm font-medium leading-normal">Gestión de Usuarios</p>
    </a>
</div>


</div>
<div class="flex flex-col gap-4">
<div class="w-full h-px bg-accent"></div>
<div class="flex gap-3 items-center px-3">
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" data-alt="User avatar" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCcWxnp-vgrkQO4K2_ENcSA8i48v9zHB_RZI5QBk2fPJoqhzEfeogzO5lHc9BhdDuYZ_PVd8RTTcps7tWlHkHKxRxTgqBRVqqs-6CVzsQEysLSTO3ZO5nO_AmyL3UV1MBh-WmRNLVE5tNY7SmhWu7iNY3yAhej8hjEiTgs4k7-0TtlG4guGy3aOxY-ts2l0JgvtaZz2Tdj6Q-hBwytqk6NsARDKzTFknEKTEdCIUR0EyJeKEHb5bWJFPcYQFxqTo03zbXswaxuX0WM");'></div>
<div class="flex flex-col">
<h2 class="text-white text-sm font-medium">Admin</h2>
<p class="text-subtle-accent text-xs">admin@example.com</p>
</div>
<button class="ml-auto p-2 rounded-lg hover:bg-accent">
<span class="material-symbols-outlined text-subtle-accent">logout</span>
</button>
</div>
</div>
</div>
<main class="flex-1 p-6 lg:p-10">
<div class="max-w-7xl mx-auto">
<div class="flex flex-col lg:flex-row gap-8">
<div class="w-full lg:w-1/3 xl:w-1/4">
<div class="bg-sidebar p-6 rounded-xl">
<h2 class="text-white text-xl font-bold mb-6">Filtros</h2>
<div class="flex flex-col gap-6">
<label class="flex flex-col min-w-40 flex-1">
<p class="text-white text-base font-medium leading-normal pb-2">Rango de Fechas</p>
<div class="flex w-full flex-1 items-stretch rounded-lg">
<input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-white focus:outline-0 focus:ring-0 border border-accent bg-card focus:border-primary h-14 placeholder:text-subtle-accent p-[15px] rounded-r-none border-r-0 pr-2 text-base font-normal leading-normal" placeholder="Seleccionar rango" value=""/>
<div class="text-subtle-accent flex border border-accent bg-card items-center justify-center pr-[15px] rounded-r-lg border-l-0">
<span class="material-symbols-outlined">calendar_today</span>
</div>
</div>
</label>
<label class="flex flex-col min-w-40 flex-1">
<p class="text-white text-base font-medium leading-normal pb-2">Tipo de Activo</p>
<select class="form-select flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-white focus:outline-0 focus:ring-0 border border-accent bg-card focus:border-primary h-14 bg-[image:--select-button-svg] placeholder:text-subtle-accent p-[15px] text-base font-normal leading-normal">
<option value="all">Todos</option>
<option value="laptop">Portátil</option>
<option value="monitor">Monitor</option>
<option value="printer">Impresora</option>
</select>
</label>
<label class="flex flex-col min-w-40 flex-1">
<p class="text-white text-base font-medium leading-normal pb-2">Ubicación</p>
<select class="form-select flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-white focus:outline-0 focus:ring-0 border border-accent bg-card focus:border-primary h-14 bg-[image:--select-button-svg] placeholder:text-subtle-accent p-[15px] text-base font-normal leading-normal">
<option value="all">Todas</option>
<option value="office">Oficina</option>
<option value="warehouse">Almacén</option>
</select>
</label>
<label class="flex flex-col min-w-40 flex-1">
<p class="text-white text-base font-medium leading-normal pb-2">Estado</p>
<select class="form-select flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-white focus:outline-0 focus:ring-0 border border-accent bg-card focus:border-primary h-14 bg-[image:--select-button-svg] placeholder:text-subtle-accent p-[15px] text-base font-normal leading-normal">
<option value="all">Todos</option>
<option value="active">Activo</option>
<option value="repair">En Reparación</option>
<option value="retired">Retirado</option>
</select>
</label>
<button class="flex min-w-[84px] w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-4 bg-primary text-background-dark text-base font-bold leading-normal tracking-[0.015em] mt-2">
<span class="truncate">Generar Informe</span>
</button>
</div>
</div>
</div>
<div class="flex-1">
<div class="flex flex-wrap justify-between gap-4 items-center mb-6">
<div class="flex min-w-72 flex-col gap-1">
<p class="text-white text-4xl font-black leading-tight tracking-[-0.033em]">Informes de Inventario de TI</p>
<p class="text-subtle-accent text-base font-normal leading-normal">Genere y exporte informes de inventario.</p>
</div>
<div class="flex items-center gap-2">
<button class="flex items-center justify-center gap-2 h-10 px-4 rounded-lg bg-card text-white text-sm font-medium hover:bg-accent">
<span class="material-symbols-outlined text-base">picture_as_pdf</span>
<span>PDF</span>
</button>
<button class="flex items-center justify-center gap-2 h-10 px-4 rounded-lg bg-card text-white text-sm font-medium hover:bg-accent">
<span class="material-symbols-outlined text-base">receipt_long</span>
<span>Excel</span>
</button>
<button class="flex items-center justify-center gap-2 h-10 px-4 rounded-lg bg-card text-white text-sm font-medium hover:bg-accent">
<span class="material-symbols-outlined text-base">toc</span>
<span>CSV</span>
</button>
</div>
</div>
<div class="bg-sidebar rounded-xl p-4">
<div class="flex justify-between items-center mb-4 px-2">
<div class="relative w-full max-w-sm">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-subtle-accent">search</span>
<input class="form-input w-full rounded-lg text-white border border-accent bg-card focus:border-primary h-12 pl-10 placeholder:text-subtle-accent text-sm" placeholder="Buscar en el informe..." type="text"/>
</div>
</div>
<div class="overflow-x-auto">
<table class="w-full text-left text-sm text-subtle-accent">
<thead class="border-b border-accent text-xs text-white uppercase bg-table-header">
<tr>
<th class="px-6 py-3" scope="col">ID de Activo</th>
<th class="px-6 py-3" scope="col">Nombre del Activo</th>
<th class="px-6 py-3" scope="col">Tipo</th>
<th class="px-6 py-3" scope="col">Ubicación</th>
<th class="px-6 py-3" scope="col">Estado</th>
<th class="px-6 py-3" scope="col">Fecha de Compra</th>
</tr>
</thead>
<tbody>
<tr class="border-b border-accent">
<td class="px-6 py-4 text-white">LAP-001</td>
<td class="px-6 py-4 text-white">Dell XPS 15</td>
<td class="px-6 py-4">Portátil</td>
<td class="px-6 py-4">Oficina</td>
<td class="px-6 py-4"><span class="px-2 py-1 bg-green-500/20 text-green-400 rounded-full text-xs">Activo</span></td>
<td class="px-6 py-4">2023-01-15</td>
</tr>
<tr class="border-b border-accent">
<td class="px-6 py-4 text-white">MON-003</td>
<td class="px-6 py-4 text-white">HP EliteDisplay</td>
<td class="px-6 py-4">Monitor</td>
<td class="px-6 py-4">Almacén</td>
<td class="px-6 py-4"><span class="px-2 py-1 bg-yellow-500/20 text-yellow-400 rounded-full text-xs">En Reparación</span></td>
<td class="px-6 py-4">2022-11-20</td>
</tr>
<tr class="border-b border-accent">
<td class="px-6 py-4 text-white">PRN-002</td>
<td class="px-6 py-4 text-white">Brother HL-L2350DW</td>
<td class="px-6 py-4">Impresora</td>
<td class="px-6 py-4">Oficina</td>
<td class="px-6 py-4"><span class="px-2 py-1 bg-red-500/20 text-red-400 rounded-full text-xs">Retirado</span></td>
<td class="px-6 py-4">2021-05-10</td>
</tr>
<tr class="border-b border-accent">
<td class="px-6 py-4 text-white">LAP-002</td>
<td class="px-6 py-4 text-white">Macbook Pro 16</td>
<td class="px-6 py-4">Portátil</td>
<td class="px-6 py-4">Oficina</td>
<td class="px-6 py-4"><span class="px-2 py-1 bg-green-500/20 text-green-400 rounded-full text-xs">Activo</span></td>
<td class="px-6 py-4">2023-03-22</td>
</tr>
<tr class="border-b border-accent">
<td class="px-6 py-4 text-white">MON-004</td>
<td class="px-6 py-4 text-white">LG UltraFine 5K</td>
<td class="px-6 py-4">Monitor</td>
<td class="px-6 py-4">Oficina</td>
<td class="px-6 py-4"><span class="px-2 py-1 bg-green-500/20 text-green-400 rounded-full text-xs">Activo</span></td>
<td class="px-6 py-4">2023-02-01</td>
</tr>
</tbody>
</table>
</div>
<div class="flex justify-between items-center mt-4 px-2 text-subtle-accent">
<span class="text-sm">Mostrando 1 a 5 de 20 resultados</span>
<div class="flex items-center gap-2">
<button class="p-2 rounded-lg hover:bg-accent disabled:opacity-50" disabled="">
<span class="material-symbols-outlined">chevron_left</span>
</button>
<span class="text-sm font-medium text-white">1</span>
<button class="p-2 rounded-lg hover:bg-accent">
<span class="material-symbols-outlined">chevron_right</span>
</button>
</div>
</div>
</div>
</div>
</div>
</div>
</main>
</div>
</div>

</body></html>