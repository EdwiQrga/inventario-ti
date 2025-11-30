<!DOCTYPE html>
<html class="dark" lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Inventario de Impresoras - Inventario TI</title>
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
                        primary: "#005850",
                        secondary: "#62c443",
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
        .truncate { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
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
            <a href="{{ route('activos.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60">
                <span class="material-symbols-outlined">inventory_2</span>
                <span class="text-sm font-medium">Inventario</span>
            </a>
            <a href="{{ route('impresoras.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-white bg-primary shadow-sm hover:bg-primary/90">
                <span class="material-symbols-outlined">inventory_2</span>
                <span class="text-sm font-semibold">Impresoras</span>
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

    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden lg:hidden"></div>

    <div class="flex-1 flex flex-col">
        <header class="flex items-center justify-between px-4 lg:px-10 py-3 h-16 border-b border-gray-200 dark:border-gray-800 bg-white/80 dark:bg-gray-900/80 backdrop-blur-sm sticky top-0 z-10">
            <div class="flex items-center gap-4">
                <button id="openSidebar" class="lg:hidden"><span class="material-symbols-outlined text-2xl">menu</span></button>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white">Inventario de Impresoras</h1>
            </div>
            <div class="flex items-center gap-3">
                <button class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800/60"><span class="material-symbols-outlined">notifications</span></button>
                <div class="flex items-center gap-2 cursor-pointer">
                    <div class="bg-cover bg-center rounded-full size-9" style='background-image: url("{{ auth()->user()->avatar ?? "https://ui-avatars.com/api/?name=" . urlencode(auth()->user()->name) . "&background=005850&color=fff" }}");'></div>
                    <div class="hidden sm:block text-left">
                        <p class="text-sm font-semibold text-gray-800 dark:text-gray-100 truncate max-w-32">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate max-w-32">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="inline-flex items-center">@csrf
                    <button type="submit" class="flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/60 rounded-lg transition-colors">
                        <span class="material-symbols-outlined text-base">logout</span><span class="hidden sm:inline">Cerrar Sesión</span>
                    </button>
                </form>
            </div>
        </header>

        <main class="flex-1 p-4 lg:p-8 overflow-auto">
            <div class="max-w-full mx-auto">
                <div class="flex flex-wrap justify-between items-center gap-4 mb-8">
                    <div class="relative w-full max-w-sm">
                        <form method="GET" action="{{ route('impresoras.index') }}">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500">search</span>
                            <input name="search" value="{{ request('search') }}" class="w-full pl-10 pr-4 py-2 text-sm rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 focus:ring-2 focus:ring-primary/50 focus:border-primary" placeholder="Buscar por sucursal, serial, IP..." type="text"/>
                        </form>
                    </div>
                    <div class="flex items-center gap-3">
                        <button type="button" id="openFilterModal" class="flex h-9 items-center justify-center gap-2 rounded-lg px-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/60 transition-colors shadow-sm">
                            <span class="material-symbols-outlined text-lg">filter_list</span><span>Filtros</span>
                        </button>
                        <button id="openCreateModal" class="flex h-9 items-center justify-center gap-2 rounded-lg px-4 bg-primary text-white text-sm font-medium hover:bg-primary/90 transition-colors shadow-sm">
                            <span class="material-symbols-outlined text-lg">add</span><span>Añadir Impresora</span>
                        </button>
                    </div>
                </div>

                <!-- Tabla -->
                <div class="rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800/50 shadow-sm overflow-x-auto">
                    <table class="w-full text-xs text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700/50">
                            <tr>
                                <th class="px-3 py-2">ID</th>
                                <th class="px-3 py-2">Proveedor</th>
                                <th class="px-3 py-2">Sucursal</th>
                                <th class="px-3 py-2">Nombre Fiscal</th>
                                <th class="px-3 py-2">Marca</th>
                                <th class="px-3 py-2">Modelo</th>
                                <th class="px-3 py-2">Serial</th>
                                <th class="px-3 py-2">IP</th>
                                <th class="px-3 py-2">Estatus</th>
                                <th class="px-3 py-2 text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($impresoras as $i)
                                @php
                                    $estadoColor = $i->estatus == 'Rentada' ? 'bg-orange-500' : ($i->estatus == 'Comprada' ? 'bg-secondary' : 'bg-gray-500');
                                @endphp
                                <tr class="bg-white dark:bg-gray-800/50 hover:bg-gray-50 dark:hover:bg-gray-700/50 border-b dark:border-gray-700">
                                    <td class="px-3 py-2 font-medium text-gray-900 dark:text-white">{{ $loop->iteration }}</td>
                                    <td class="px-3 py-2 max-w-32 truncate" title="{{ $i->proveedor }}">{{ $i->proveedor }}</td>
                                    <td class="px-3 py-2 font-medium text-primary max-w-32 truncate" title="{{ $i->sucursal }}">{{ $i->sucursal }}</td>
                                    <td class="px-3 py-2 max-w-40 truncate" title="{{ $i->nombre_fiscal }}">{{ $i->nombre_fiscal }}</td>
                                    <td class="px-3 py-2">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            {{ $i->marca == 'Kyocera' ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300' :
                                               ($i->marca == 'Canon' ? 'bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-300' :
                                               'bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300') }}">
                                            {{ $i->marca }}
                                        </span>
                                    </td>
                                    <td class="px-3 py-2">{{ $i->modelo }}</td>
                                    <td class="px-3 py-2 font-mono bg-yellow-50 dark:bg-yellow-900/20 px-2 py-1 rounded">{{ $i->numero_serial }}</td>
                                    <td class="px-3 py-2 font-mono text-blue-600 dark:text-blue-400">{{ $i->direccion_ip ?? '—' }}</td>
                                    <td class="px-3 py-2">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                            {{ $i->estatus == 'Rentada' ? 'bg-orange-500/10 text-orange-800 dark:bg-orange-500/20 dark:text-orange-300' : 
                                               ($i->estatus == 'Comprada' ? 'bg-secondary/10 text-secondary-800 dark:bg-secondary/20 dark:text-secondary-300' : 
                                               'bg-gray-500/10 text-gray-800 dark:bg-gray-600/20 dark:text-gray-300') }}">
                                            <span class="w-2 h-2 mr-2 rounded-full {{ $estadoColor }}"></span>
                                            {{ $i->estatus }}
                                        </span>
                                    </td>
                                    <td class="px-3 py-2 text-right">
                                        <div class="flex items-center justify-end gap-x-1">
                                            <button onclick="editar({{ $i->id }})" class="p-1.5 rounded-md text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                <span class="material-symbols-outlined text-base">edit</span>
                                            </button>
                                            <form action="{{ route('impresoras.destroy', $i) }}" method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" onclick="return confirm('¿Eliminar esta impresora?')" class="p-1.5 rounded-md text-red-600 hover:bg-red-50 dark:hover:bg-red-900/40">
                                                    <span class="material-symbols-outlined text-base">delete</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="10" class="text-center py-12 text-gray-500 dark:text-gray-400">No hay impresoras registradas</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="flex flex-wrap items-center justify-between gap-4 mt-6">
                    <span class="text-sm text-gray-600 dark:text-gray-400">
                        Mostrando {{ $impresoras->firstItem() ?? 0 }}-{{ $impresoras->lastItem() ?? 0 }} de {{ $impresoras->total() }} impresoras
                    </span>
                    {{ $impresoras->appends(request()->query())->links('pagination::tailwind') }}
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Modal Crear / Editar -->
<div id="createModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700">
            <h2 id="modalTitle" class="text-xl font-bold">Añadir Impresora</h2>
            <button type="button" onclick="document.getElementById('createModal').classList.add('hidden')" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form id="impresoraForm" class="p-6 space-y-6">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">
            <input type="hidden" name="id" id="impresoraId">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div><label class="block text-sm font-medium mb-2">Proveedor *</label><input name="proveedor" required class="w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:ring-2 focus:ring-primary/50 focus:border-primary"><p class="text-red-500 text-xs mt-1 hidden"></p></div>
                <div><label class="block text-sm font-medium mb-2">Sucursal *</label><input name="sucursal" required class="w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:ring-2 focus:ring-primary/50 focus:border-primary"><p class="text-red-500 text-xs mt-1 hidden"></p></div>
                <div class="md:col-span-2"><label class="block text-sm font-medium mb-2">Nombre Fiscal *</label><input name="nombre_fiscal" required class="w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:ring-2 focus:ring-primary/50 focus:border-primary"><p class="text-red-500 text-xs mt-1 hidden"></p></div>
                <div><label class="block text-sm font-medium mb-2">Marca *</label>
                    <select name="marca" required class="w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:ring-2 focus:ring-primary/50 focus:border-primary">
                        <option value="">Seleccionar</option>
                        <option>Kyocera</option><option>Canon</option><option>Brother</option><option>HP</option><option>Ricoh</option>
                    </select>
                </div>
                <div><label class="block text-sm font-medium mb-2">Modelo *</label><input name="modelo" required class="w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:ring-2 focus:ring-primary/50 focus:border-primary"><p class="text-red-500 text-xs mt-1 hidden"></p></div>
                <div><label class="block text-sm font-medium mb-2">Número Serial *</label><input name="numero_serial" required class="w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm font-mono focus:ring-2 focus:ring-primary/50 focus:border-primary"><p class="text-red-500 text-xs mt-1 hidden"></p></div>
                <div><label class="block text-sm font-medium mb-2">Dirección IP</label><input name="direccion_ip" class="w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:ring-2 focus:ring-primary/50 focus:border-primary"><p class="text-red-500 text-xs mt-1 hidden"></p></div>
                <div><label class="block text-sm font-medium mb-2">Estatus *</label>
                    <select name="estatus" required class="w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:ring-2 focus:ring-primary/50 focus:border-primary">
                        <option value="">Seleccionar</option>
                        <option>Rentada</option><option>Comprada</option><option>En reparación</option><option>Dada de baja</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button type="button" onclick="document.getElementById('createModal').classList.add('hidden')" class="px-6 py-2 rounded-lg border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">Cancelar</button>
                <button type="submit" id="btnSubmit" class="px-6 py-2 bg-primary text-white rounded-lg font-medium hover:bg-primary/90 transition">Guardar Impresora</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Filtros -->
<div id="filterModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl max-w-md w-full">
        <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-xl font-bold">Filtros</h2>
            <button type="button" onclick="document.getElementById('filterModal').classList.add('hidden')" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg"><span class="material-symbols-outlined">close</span></button>
        </div>
        <form method="GET" action="{{ route('impresoras.index') }}" class="p-6 space-y-4">
            <div>
                <label class="block text-sm font-medium mb-2">Marca</label>
                <select name="marca" class="w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:ring-2 focus:ring-primary/50 focus:border-primary">
                    <option value="">Todas</option>
                    <option {{ request('marca') == 'Kyocera' ? 'selected' : '' }}>Kyocera</option>
                    <option {{ request('marca') == 'Canon' ? 'selected' : '' }}>Canon</option>
                    <option {{ request('marca') == 'Brother' ? 'selected' : '' }}>Brother</option>
                    <option {{ request('marca') == 'HP' ? 'selected' : '' }}>HP</option>
                    <option {{ request('marca') == 'Ricoh' ? 'selected' : '' }}>Ricoh</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-2">Estatus</label>
                <select name="estatus" class="w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:ring-2 focus:ring-primary/50 focus:border-primary">
                    <option value="">Todos</option>
                    <option {{ request('estatus') == 'Rentada' ? 'selected' : '' }}>Rentada</option>
                    <option {{ request('estatus') == 'Comprada' ? 'selected' : '' }}>Comprada</option>
                    <option {{ request('estatus') == 'En reparación' ? 'selected' : '' }}>En reparación</option>
                    <option {{ request('estatus') == 'Dada de baja' ? 'selected' : '' }}>Dada de baja</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-2">Sucursal</label>
                <input name="sucursal" value="{{ request('sucursal') }}" class="w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:ring-2 focus:ring-primary/50 focus:border-primary" placeholder="Ej: WTC"/>
            </div>
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('impresoras.index') }}" class="px-6 py-2 rounded-lg border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">Limpiar</a>
                <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg font-medium hover:bg-primary/90 transition">Aplicar</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const createModal = document.getElementById('createModal');
    const filterModal = document.getElementById('filterModal');
    const form = document.getElementById('impresoraForm');

    // Abrir modal crear
    document.getElementById('openCreateModal').onclick = () => {
        createModal.classList.remove('hidden');
        form.reset();
        document.getElementById('formMethod').value = 'POST';
        form.action = '{{ route('impresoras.store') }}';
        document.getElementById('modalTitle').textContent = 'Añadir Impresora';
        document.getElementById('btnSubmit').textContent = 'Guardar Impresora';
        form.querySelectorAll('.text-red-500').forEach(el => { el.classList.add('hidden'); el.textContent = ''; });
    };

    // Abrir modal filtros
    document.getElementById('openFilterModal').onclick = () => filterModal.classList.remove('hidden');

    // Editar impresora
    window.editar = id => {
        fetch(`/impresoras/${id}/edit`)
            .then(r => r.json())
            .then(d => {
                document.getElementById('impresoraId').value = d.id;
                ['proveedor','sucursal','nombre_fiscal','marca','modelo','numero_serial','direccion_ip','estatus'].forEach(field => {
                    const el = form.querySelector(`[name="${field}"]`);
                    if (el) el.value = d[field] || '';
                });
                document.getElementById('formMethod').value = 'PUT';
                form.action = `/impresoras/${id}`;
                document.getElementById('modalTitle').textContent = 'Editar Impresora';
                document.getElementById('btnSubmit').textContent = 'Actualizar';
                createModal.classList.remove('hidden');
                form.querySelectorAll('.text-red-500').forEach(el => { el.classList.add('hidden'); el.textContent = ''; });
            });
    };

    // Enviar formulario con AJAX
    form.onsubmit = function(e) {
        e.preventDefault();
        const btn = document.getElementById('btnSubmit');
        const original = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = 'Guardando...';

        form.querySelectorAll('.text-red-500').forEach(el => { el.classList.add('hidden'); el.textContent = ''; });

        const fd = new FormData(this);
        if (document.getElementById('formMethod').value === 'PUT') fd.append('_method', 'PUT');

        fetch(this.action, {
            method: 'POST',
            body: fd,
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
        })
        .then(r => {
            if (!r.ok) return r.json().then(err => { throw err; });
            location.reload();
        })
        .catch(err => {
            if (err.errors) {
                Object.keys(err.errors).forEach(key => {
                    const input = form.querySelector(`[name="${key}"]`);
                    if (input) {
                        const msg = input.parentNode.querySelector('.text-red-500');
                        if (msg) { msg.textContent = err.errors[key][0]; msg.classList.remove('hidden'); }
                    }
                });
            }
        })
        .finally(() => {
            btn.disabled = false;
            btn.innerHTML = original;
        });
    };
});

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