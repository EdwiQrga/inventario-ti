<!DOCTYPE html>
<html lang="es"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Panel de Alertas de Inventario de TI</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&amp;family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet"/>
<style type="text/tailwindcss">
    @layer base {
      :root {
        --background: 0 0% 100%;
        --foreground: 224 71.4% 4.1%;
        --card: 0 0% 100%;
        --card-foreground: 224 71.4% 4.1%;
        --popover: 0 0% 100%;
        --popover-foreground: 224 71.4% 4.1%;
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
        --popover: 224 71.4% 4.1%;
        --popover-foreground: 0 0% 98%;
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
            primary: {
              DEFAULT: "hsl(var(--primary))",
              foreground: "hsl(var(--primary-foreground))"
            },
            secondary: {
              DEFAULT: "hsl(var(--secondary))",
              foreground: "hsl(var(--secondary-foreground))"
            },
            destructive: {
              DEFAULT: "hsl(var(--destructive))",
              foreground: "hsl(var(--destructive-foreground))"
            },
            muted: {
              DEFAULT: "hsl(var(--muted))",
              foreground: "hsl(var(--muted-foreground))"
            },
            accent: {
              DEFAULT: "hsl(var(--accent))",
              foreground: "hsl(var(--accent-foreground))"
            },
            popover: {
              DEFAULT: "hsl(var(--popover))",
              foreground: "hsl(var(--popover-foreground))",
            },
            card: {
              DEFAULT: "hsl(var(--card))",
              foreground: "hsl(var(--card-foreground))",
            },
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
    .material-symbols-outlined {
      font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
  </style>
</head>
<body class="bg-background font-body text-foreground dark">
<div class="relative flex h-auto min-h-screen w-full flex-col">
<div class="flex h-full grow flex-row">
<aside class="flex flex-col w-64 bg-card p-4 border-r border-border">
<div class="flex flex-col gap-4 mb-8">
<div class="flex gap-3 items-center">
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" data-alt="User avatar" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDTZ3LEbaJJYtL9-UnxbQ_Virk1g3dsN0YJkCNLSfA6eZQt4p_A8P-NeKimM0p5PdrOFlLynJLWxXE8dKuODHN1LJmW34oJtsjb5RDdPMszH3somnRZ_cDJmSoM81u7GbqXbfQWxcSQNAuAWQsko2g7qtiPU2gfpTpMvPtvkXVFZtTREv1JnpiORNhJ2N1mgr5RIu23uY9NG2zt3FuuoM9Ym1kGqLxCAjPhQZ6UcL4BIJPrl966LNyF-J063sN2eDlE2LJustWb1Kc");'></div>
<div class="flex flex-col">
<h1 class="text-foreground text-base font-bold leading-normal font-display">Admin</h1>
<p class="text-muted-foreground text-sm font-normal leading-normal">Departamento de TI</p>
</div>
</div>
</div>
<nav class="flex-1 px-4 py-4">
        <ul class="flex flex-col gap-2">
            <li><a class="flex items-center gap-3 rounded-lg px-4 py-2 text-gray-500 dark:text-accent hover:bg-gray-100 dark:hover:bg-primary-dark/50" href="{{ route('activos.index') }}"> <span class="material-symbols-outlined">home</span> <span class="text-sm font-medium">Inicio</span> </a></li>
            <li><a class="flex items-center gap-3 rounded-lg px-4 py-2 text-primary bg-primary/10 dark:bg-primary-dark dark:text-white" href="{{ route('activos.index') }}"> <span class="material-symbols-outlined">inventory</span> <span class="text-sm font-medium">Inventario</span> </a></li>
            <li><a class="flex items-center gap-3 rounded-lg px-4 py-2 text-gray-500 dark:text-accent hover:bg-gray-100 dark:hover:bg-primary-dark/50" href="{{ route('dashboard') }}"> <span class="material-symbols-outlined">dashboard</span> <span class="text-sm font-medium">Dashboard</span> </a></li>
            <li><a class="flex items-center gap-3 rounded-lg px-4 py-2 text-gray-500 dark:text-accent hover:bg-gray-100 dark:hover:bg-primary-dark/50" href="{{ route('alertas.index') }}"> <span class="material-symbols-outlined">notifications</span> <span class="text-sm font-medium">Alertas</span> </a></li>
            <li><a class="flex items-center gap-3 rounded-lg px-4 py-2 text-gray-500 dark:text-accent hover:bg-gray-100 dark:hover:bg-primary-dark/50" href="{{ route('reportes.index') }}"> <span class="material-symbols-outlined">analytics</span> <span class="text-sm font-medium">Reportes</span> </a></li>
            <li><a class="flex items-center gap-3 rounded-lg px-4 py-2 text-gray-500 dark:text-accent hover:bg-gray-100 dark:hover:bg-primary-dark/50" href="{{ route('usuarios.index') }}"> <span class="material-symbols-outlined">group</span> <span class="text-sm font-medium">Gestión de Usuarios</span> </a></li>
        </ul>
    </nav>
<div class="flex flex-col gap-1 mt-auto">
<a class="flex items-center gap-3 px-3 py-2 text-foreground/80 hover:bg-muted rounded-lg" href="#">
<span class="material-symbols-outlined">settings</span>
<p class="text-sm font-medium leading-normal">Configuración</p>
</a>
<a class="flex items-center gap-3 px-3 py-2 text-foreground/80 hover:bg-muted rounded-lg" href="#">
<span class="material-symbols-outlined">logout</span>
<p class="text-sm font-medium leading-normal">Cerrar sesión</p>
</a>
</div>
</aside>
<main class="flex-1 p-8 bg-background">
<div class="flex flex-wrap justify-between gap-3 mb-6">
<p class="text-foreground text-4xl font-black leading-tight tracking-[-0.033em] font-display min-w-72">Panel de Alertas</p>
</div>
<div class="flex flex-wrap gap-4 mb-6">
<div class="flex min-w-[158px] flex-1 flex-col gap-2 rounded-lg p-6 bg-card border border-border">
<p class="text-muted-foreground text-base font-medium leading-normal">Alertas Activas</p>
<p class="text-foreground tracking-light text-2xl font-bold leading-tight">12</p>
</div>
<div class="flex min-w-[158px] flex-1 flex-col gap-2 rounded-lg p-6 bg-card border border-border">
<p class="text-muted-foreground text-base font-medium leading-normal">Licencias por Vencer</p>
<p class="text-foreground tracking-light text-2xl font-bold leading-tight">5</p>
</div>
<div class="flex min-w-[158px] flex-1 flex-col gap-2 rounded-lg p-6 bg-card border border-border">
<p class="text-muted-foreground text-base font-medium leading-normal">Equipos en Mantenimiento</p>
<p class="text-foreground tracking-light text-2xl font-bold leading-tight">7</p>
</div>
</div>
<div class="flex items-center justify-between gap-4 mb-4">
<div class="flex-1">
<label class="flex flex-col min-w-40 h-12 w-full">
<div class="flex w-full flex-1 items-stretch rounded-lg h-full">
<div class="text-muted-foreground flex border border-border bg-card items-center justify-center pl-4 rounded-l-lg border-r-0">
<span class="material-symbols-outlined">search</span>
</div>
<input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-foreground focus:outline-0 focus:ring-0 border border-border bg-card focus:border-border h-full placeholder:text-muted-foreground px-4 rounded-l-none border-l-0 pl-2 text-base font-normal leading-normal" placeholder="Buscar por software o equipo" value=""/>
</div>
</label>
</div>
<div class="flex gap-3">
<button class="flex h-10 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-secondary px-4 border border-border">
<p class="text-secondary-foreground text-sm font-medium leading-normal">Estado</p>
<span class="material-symbols-outlined text-secondary-foreground">expand_more</span>
</button>
<button class="flex h-10 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-secondary px-4 border border-border">
<p class="text-secondary-foreground text-sm font-medium leading-normal">Fecha de Vencimiento</p>
<span class="material-symbols-outlined text-secondary-foreground">expand_more</span>
</button>
</div>
</div>
<div class="bg-card rounded-xl shadow-md overflow-hidden border border-border">
<h3 class="text-lg font-bold text-foreground p-4 font-display">Alertas de Licencia</h3>
<div class="overflow-x-auto">
<table class="w-full text-sm text-left text-muted-foreground">
<thead class="text-xs text-foreground/80 uppercase bg-muted">
<tr>
<th class="px-6 py-3" scope="col">Nombre del Software</th>
<th class="px-6 py-3" scope="col">Fecha de Vencimiento</th>
<th class="px-6 py-3" scope="col">Días Restantes</th>
<th class="px-6 py-3" scope="col">Usuario Asignado</th>
<th class="px-6 py-3" scope="col">Acción</th>
</tr>
</thead>
<tbody>
<tr class="bg-card border-b border-border">
<th class="px-6 py-4 font-medium text-foreground whitespace-nowrap" scope="row">Adobe Photoshop</th>
<td class="px-6 py-4"><span class="bg-red-500/10 text-red-500 text-xs font-medium me-2 px-2.5 py-0.5 rounded">2024-05-15</span></td>
<td class="px-6 py-4"><span class="text-red-500 font-bold">Vencido</span></td>
<td class="px-6 py-4">Juan Pérez</td>
<td class="px-6 py-4">
<button class="bg-primary hover:bg-primary/80 text-primary-foreground text-xs font-bold py-1 px-3 rounded-lg">Renovar Licencia</button>
</td>
</tr>
<tr class="bg-card border-b border-border">
<th class="px-6 py-4 font-medium text-foreground whitespace-nowrap" scope="row">Microsoft Office 365</th>
<td class="px-6 py-4"><span class="bg-orange-500/10 text-orange-500 text-xs font-medium me-2 px-2.5 py-0.5 rounded">2024-06-20</span></td>
<td class="px-6 py-4"><span class="text-orange-500 font-bold">15</span></td>
<td class="px-6 py-4">Ana Gómez</td>
<td class="px-6 py-4">
<button class="bg-primary hover:bg-primary/80 text-primary-foreground text-xs font-bold py-1 px-3 rounded-lg">Renovar Licencia</button>
</td>
</tr>
<tr class="bg-card">
<th class="px-6 py-4 font-medium text-foreground whitespace-nowrap" scope="row">JetBrains IntelliJ IDEA</th>
<td class="px-6 py-4">2024-07-10</td>
<td class="px-6 py-4">45</td>
<td class="px-6 py-4">Carlos Ruiz</td>
<td class="px-6 py-4">
<button class="bg-primary hover:bg-primary/80 text-primary-foreground text-xs font-bold py-1 px-3 rounded-lg">Renovar Licencia</button>
</td>
</tr>
</tbody>
</table>
</div>
</div>
<div class="mt-8 bg-card rounded-xl shadow-md overflow-hidden border border-border">
<h3 class="text-lg font-bold text-foreground p-4 font-display">Alertas de Mantenimiento</h3>
<div class="overflow-x-auto">
<table class="w-full text-sm text-left text-muted-foreground">
<thead class="text-xs text-foreground/80 uppercase bg-muted">
<tr>
<th class="px-6 py-3" scope="col">Nombre del Equipo</th>
<th class="px-6 py-3" scope="col">Tipo de Mantenimiento</th>
<th class="px-6 py-3" scope="col">Fecha Programada</th>
<th class="px-6 py-3" scope="col">Estado</th>
<th class="px-6 py-3" scope="col">Acción</th>
</tr>
</thead>
<tbody>
<tr class="bg-card border-b border-border">
<th class="px-6 py-4 font-medium text-foreground whitespace-nowrap" scope="row">Servidor Principal</th>
<td class="px-6 py-4">Preventivo</td>
<td class="px-6 py-4">2024-06-05</td>
<td class="px-6 py-4"><span class="bg-blue-500/10 text-blue-500 text-xs font-medium me-2 px-2.5 py-0.5 rounded">Programado</span></td>
<td class="px-6 py-4 flex gap-2">
<button class="bg-green-600 hover:bg-green-700 text-white text-xs font-bold py-1 px-3 rounded-lg">Completado</button>
<button class="bg-primary hover:bg-primary/80 text-primary-foreground text-xs font-bold py-1 px-3 rounded-lg">Reprogramar</button>
</td>
</tr>
<tr class="bg-card border-b border-border">
<th class="px-6 py-4 font-medium text-foreground whitespace-nowrap" scope="row">Laptop Dell XPS 15</th>
<td class="px-6 py-4">Correctivo</td>
<td class="px-6 py-4">2024-05-28</td>
<td class="px-6 py-4"><span class="bg-green-500/10 text-green-500 text-xs font-medium me-2 px-2.5 py-0.5 rounded">Completado</span></td>
<td class="px-6 py-4">
<button class="bg-muted text-muted-foreground text-xs font-bold py-1 px-3 rounded-lg cursor-not-allowed">Ver Detalles</button>
</td>
</tr>
<tr class="bg-card">
<th class="px-6 py-4 font-medium text-foreground whitespace-nowrap" scope="row">Impresora HP LaserJet</th>
<td class="px-6 py-4">Cambio de Tóner</td>
<td class="px-6 py-4">2024-06-10</td>
<td class="px-6 py-4"><span class="bg-blue-500/10 text-blue-500 text-xs font-medium me-2 px-2.5 py-0.5 rounded">Programado</span></td>
<td class="px-6 py-4 flex gap-2">
<button class="bg-green-600 hover:bg-green-700 text-white text-xs font-bold py-1 px-3 rounded-lg">Completado</button>
<button class="bg-primary hover:bg-primary/80 text-primary-foreground text-xs font-bold py-1 px-3 rounded-lg">Reprogramar</button>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</main>
</div>
</div>
</body></html>