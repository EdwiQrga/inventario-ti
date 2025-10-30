<!DOCTYPE html>
<html class="dark" lang="es">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Gestión de inventario de TI</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
<script>
tailwind.config = {
    darkMode: "class",
    theme: {
        extend: {
            colors: {
                primary: "#1173d4",
                "background-light": "#f6f7f8",
                "background-dark": "#101922",
            },
            fontFamily: {
                display: ["Inter", "sans-serif"]
            },
        },
    },
}
</script>
<style>
.material-symbols-outlined {
  font-variation-settings:'FILL' 0,'wght' 400,'GRAD' 0,'opsz' 24
}
.sidebar {
  transition: transform 0.3s ease-in-out;
}
.sidebar.hidden {
  transform: translateX(-100%);
}
</style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display">

<!-- Botón hamburguesa -->
<button id="menu-toggle" class="lg:hidden fixed top-4 left-4 z-50 p-2 rounded-md bg-primary text-white">
  <span class="material-symbols-outlined">menu</span>
</button>

<div class="relative flex h-auto min-h-screen w-full">

  <!-- Sidebar -->
  <aside id="sidebar" class="sidebar fixed top-0 left-0 z-40 w-64 h-full bg-white dark:bg-[#192633] border-r dark:border-[#233648] border-gray-200 p-6 hidden lg:block">
    <div class="flex flex-col h-full justify-between">
      <div>
        <div class="flex items-center gap-3 mb-8">
          <span class="material-symbols-outlined text-3xl text-primary">inventory_2</span>
          <h2 class="text-lg font-bold text-black dark:text-white">Inventario TI</h2>
        </div>
        <nav class="flex flex-col gap-3">
          <a href="#" class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-primary/10 text-black dark:text-white hover:text-primary transition">
            <span class="material-symbols-outlined">dashboard</span>
            Dashboard
          </a>
          <a href="#" class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-primary/10 text-black dark:text-white hover:text-primary transition">
            <span class="material-symbols-outlined">bar_chart</span>
            Reportes
          </a>
          <a href="#" class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-primary/10 text-black dark:text-white hover:text-primary transition">
            <span class="material-symbols-outlined">settings</span>
            Configuración
          </a>
        </nav>
      </div>
      <div class="mt-6 border-t dark:border-[#233648] pt-4">
        <button class="flex items-center gap-2 px-3 py-2 rounded-md text-sm text-gray-600 dark:text-gray-300 hover:bg-red-500/10 hover:text-red-600 transition">
          <span class="material-symbols-outlined">logout</span>
          Cerrar sesión
        </button>
      </div>
    </div>
  </aside>

  <!-- Contenido principal -->
  <div class="flex flex-col flex-1 min-h-screen lg:ml-64">

    <!-- Header -->
    <header class="flex items-center justify-between whitespace-nowrap border-b border-solid dark:border-b-[#233648] border-b-gray-200 px-10 py-3">
      <div class="flex items-center gap-4 text-black dark:text-white">
        <div class="size-6">
          <span class="material-symbols-outlined text-3xl text-primary">inventory_2</span>
        </div>
        <h2 class="text-lg font-bold leading-tight tracking-[-0.015em]">Gestión de inventario de TI</h2>
      </div>
      <div class="flex flex-1 justify-end gap-8">
        <div class="flex items-center gap-9">
          <a class="text-black dark:text-white text-sm font-medium leading-normal" href="#">Dashboard</a>
          <a class="text-black dark:text-white text-sm font-medium leading-normal" href="#">Reports</a>
          <a class="text-black dark:text-white text-sm font-medium leading-normal" href="#">Settings</a>
        </div>
        <div class="flex gap-2">
          <button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold leading-normal tracking-[0.015em]">
            <span class="truncate">Agregar Nuevo Activo</span>
          </button>
          <button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-gray-200 dark:bg-[#233648] text-black dark:text-white text-sm font-bold leading-normal tracking-[0.015em]">
            <span class="truncate">Exportar a CSV/PDF</span>
          </button>
        </div>
        <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDZG7VX3ZNwjflTXGtxG3odJ92Jl8OwHy94RyF7guUlwrLI9JPb9MMAJXHi3nbEQL2TI7R1lXBuG-nKvfxerbHoW7QqUQaSNDZrY-VrtcFm8FchaGdXOWEQY_M3PR1YFES-hNnr-0KvvmbXQp_hhbSpojJc48rARGjRaK4Yu25zrJr85DPB8YBT4gv8YJt1KicQUzrTeLuDwj7WGYL5F5QxKtYNmJLNQjRn0erfXUtmF_puYIY6D2DuKsfe5zscScepxRxE2mF7CRk");'></div>
      </div>
    </header>

    <!-- Main -->
    <main class="px-10 py-5 flex-1">
      <!-- Aquí va todo tu contenido de filtros y tabla tal cual -->
      <!-- Copia exactamente el contenido de tu <main> actual -->
    </main>
    
  </div>
</div>

<script>
const toggleBtn = document.getElementById("menu-toggle");
const sidebar = document.getElementById("sidebar");

toggleBtn.addEventListener("click", () => {
  sidebar.classList.toggle("hidden");
});
</script>

</body>
</html>
