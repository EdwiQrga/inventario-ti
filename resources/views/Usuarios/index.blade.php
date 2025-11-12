<!DOCTYPE html>
<html class="dark" lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Gestión de Usuarios</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
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
                    fontFamily: { "display": ["Inter", "sans-serif"] },
                    borderRadius: { "DEFAULT": "0.5rem", "lg": "0.75rem", "xl": "1rem", "full": "9999px" },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display">
<div class="relative flex h-auto min-h-screen w-full flex-col">
    <div class="flex h-full grow flex-row">
        <!-- Sidebar -->
        <aside class="flex h-auto flex-col justify-between bg-[#111a22] p-4 w-64">
            <div class="flex flex-col gap-4">
                <div class="flex gap-3 items-center">
                    <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
                         style='background-image: url("{{ auth()->user()->avatar ?? "https://ui-avatars.com/api/?name=" . urlencode(auth()->user()->name) }}");'></div>
                    <div class="flex flex-col">
                        <h1 class="text-white text-base font-medium leading-normal">{{ auth()->user()->name }}</h1>
                        <p class="text-[#92adc9] text-sm font-normal leading-normal">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <a class="flex items-center gap-3 px-3 py-2 text-white hover:bg-[#233648] rounded-lg" href="{{ route('dashboard') }}">
                        <span class="material-symbols-outlined">dashboard</span>
                        <p class="text-sm font-medium leading-normal">Dashboard</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2 text-white hover:bg-[#233648] rounded-lg" href="{{ route('activos.index') }}">
                        <span class="material-symbols-outlined">inventory_2</span>
                        <p class="text-sm font-medium leading-normal">Inventario</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary text-white" href="{{ route('usuarios.index') }}">
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
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-[#233648] text-white text-sm font-bold leading-normal tracking-[0.015em] w-full">
                        <span class="truncate">Cerrar Sesión</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <div class="grid grid-cols-3 gap-8">
                <!-- Tabla + Filtros -->
                <div class="col-span-3 lg:col-span-2">
                    <div class="flex flex-wrap justify-between gap-3 p-4 items-center">
                        <div class="flex flex-col gap-3">
                            <p class="text-gray-800 dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]">Gestión de Usuarios</p>
                            <p class="text-gray-500 dark:text-[#92adc9] text-base font-normal leading-normal">
                                Crear, editar y eliminar cuentas de usuario, asignar roles y gestionar permisos.
                            </p>
                        </div>
                        <button id="openCreateModal" onclick="resetForm()" class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold leading-normal tracking-[0.015em]">
                            <span class="material-symbols-outlined mr-2">add</span>
                            <span class="truncate">Agregar Usuario</span>
                        </button>
                    </div>

                    <!-- Mensaje de éxito -->
                    @if(session('success'))
                        <div class="mx-4 mb-4 p-4 bg-green-100 dark:bg-green-900/30 border border-green-300 dark:border-green-700 text-green-800 dark:text-green-200 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Errores -->
                    @if($errors->any())
                        <div class="mx-4 mb-4 p-4 bg-red-100 dark:bg-red-900/30 border border-red-300 dark:border-red-700 text-red-800 dark:text-red-200 rounded-lg">
                            <ul class="list-disc pl-5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Búsqueda -->
                    <div class="p-4">
                        <form method="GET" action="{{ route('usuarios.index') }}">
                            <label class="flex flex-col min-w-40 h-12 w-full">
                                <div class="flex w-full flex-1 items-stretch rounded-lg h-full">
                                    <div class="text-gray-400 dark:text-[#92adc9] flex border-r-0 bg-white dark:bg-[#233648] items-center justify-center pl-4 rounded-l-lg">
                                        <span class="material-symbols-outlined">search</span>
                                    </div>
                                    <input name="search" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-800 dark:text-white focus:outline-0 focus:ring-0 border-none bg-white dark:bg-[#233648] h-full placeholder:text-gray-400 dark:placeholder:text-[#92adc9] px-4 rounded-l-none border-l-0 pl-2 text-base font-normal leading-normal"
                                           placeholder="Buscar usuarios por nombre o correo..." value="{{ request('search') }}"/>
                                </div>
                            </label>
                        </form>
                    </div>

                    <!-- Filtros por Rol -->
                    <div class="flex gap-3 p-4 overflow-x-auto">
                        <form method="GET" action="{{ route('usuarios.index') }}" class="flex gap-2">
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            <button type="submit" name="rol" value="" class="flex h-8 shrink-0 items-center justify-center gap-x-2 rounded-full {{ !request('rol') ? 'bg-primary/20 dark:bg-primary text-primary dark:text-white' : 'bg-gray-200 dark:bg-[#233648] text-gray-700 dark:text-white' }} px-4">
                                <p class="text-sm font-medium leading-normal">Todos</p>
                            </button>
                            @foreach(['Administrador', 'Técnico', 'Usuario'] as $rol)
                                <button type="submit" name="rol" value="{{ $rol }}" class="flex h-8 shrink-0 items-center justify-center gap-x-2 rounded-full {{ request('rol') == $rol ? 'bg-primary/20 dark:bg-primary text-primary dark:text-white' : 'bg-gray-200 dark:bg-[#233648] text-gray-700 dark:text-white' }} px-4">
                                    <p class="text-sm font-medium leading-normal">{{ $rol }}</p>
                                </button>
                            @endforeach
                        </form>
                    </div>

                    <!-- Tabla -->
                    <div class="px-4 py-3">
                        <div class="flex overflow-hidden rounded-lg border border-gray-200 dark:border-[#324d67] bg-white dark:bg-[#111a22]">
                            <table class="flex-1 w-full">
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
                                    @forelse($usuarios as $usuario)
                                        <tr class="border-t border-t-gray-200 dark:border-t-[#324d67]">
                                            <td class="h-[72px] px-4 py-2 text-gray-800 dark:text-white text-sm font-normal leading-normal">{{ $usuario->name }}</td>
                                            <td class="h-[72px] px-4 py-2 text-gray-500 dark:text-[#92adc9] text-sm font-normal leading-normal">{{ $usuario->email }}</td>
                                            <td class="h-[72px] px-4 py-2 text-sm font-normal leading-normal">
                                                @php
                                                    $rolColors = [
                                                        'Administrador' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
                                                        'Técnico' => 'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200',
                                                        'Usuario' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200',
                                                    ];
                                                @endphp
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $rolColors[$usuario->rol] ?? 'bg-gray-100 text-gray-800' }}">
                                                    {{ $usuario->rol }}
                                                </span>
                                            </td>
                                            <td class="h-[72px] px-4 py-2 text-sm font-normal leading-normal">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $usuario->estado == 'Activo' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                                    {{ $usuario->estado }}
                                                </span>
                                            </td>
                                            <td class="h-[72px] px-4 py-2 text-sm font-bold leading-normal tracking-[0.015em]">
                                                <button onclick="editUser({{ $usuario->id }})" class="text-primary dark:text-primary p-1 rounded hover:bg-primary/10">
                                                    <span class="material-symbols-outlined text-base">edit</span>
                                                </button>
                                                <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" class="inline">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" onclick="return confirm('¿Eliminar usuario?')" class="text-red-500 p-1 rounded hover:bg-red-500/10">
                                                        <span class="material-symbols-outlined text-base">delete</span>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-8 text-gray-500 dark:text-[#92adc9]">No hay usuarios registrados.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">{{ $usuarios->appends(request()->query())->links() }}</div>
                    </div>
                </div>

                <!-- Formulario Lateral -->
                <div class="col-span-3 lg:col-span-1 bg-white dark:bg-[#192633] rounded-xl p-6 shadow-lg">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-6">Agregar/Editar Usuario</h2>
                    <form action="{{ route('usuarios.store') }}" method="POST" id="userForm">
                        @csrf
                        <input type="hidden" name="_method" id="formMethod" value="POST">
                        <input type="hidden" name="id" id="userId">
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="name">Nombre de Usuario</label>
                                <input class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-[#233648] text-gray-800 dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm" id="name" name="name" required/>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="email">Correo Electrónico</label>
                                <input type="email" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-[#233648] text-gray-800 dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm" id="email" name="email" required/>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="rol">Rol</label>
                                <select class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-[#233648] text-gray-800 dark:text-white focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md" id="rol" name="rol" required>
                                    <option value="Administrador">Administrador</option>
                                    <option value="Técnico">Técnico</option>
                                    <option value="Usuario">Usuario</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="password">Contraseña</label>
                                <input type="password" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-[#233648] text-gray-800 dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm" id="password" name="password" placeholder="Contraseña requerida (8+ chars: mayúsculas, minúsculas, números, especiales)" required/>
                                <p class="text-xs text-gray-500 mt-1">Mínimo 8 caracteres: mayúsculas, minúsculas, números y especiales (ej: !@#$%).</p>
                            </div>
                            <div class="flex justify-end space-x-3 pt-4">
                                <button type="button" onclick="resetForm()" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 bg-gray-200 dark:bg-[#233648] rounded-md hover:bg-gray-300 dark:hover:bg-[#324d67]">
                                    Cancelar
                                </button>
                                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-primary rounded-md hover:bg-primary/90">
                                    Guardar Cambios
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    function editUser(id) {
        fetch(`/usuarios/${id}/edit`)
            .then(res => res.json())
            .then(data => {
                document.getElementById('userForm').action = `/usuarios/${id}`;
                document.getElementById('formMethod').value = 'PUT';
                document.getElementById('userId').value = id;
                document.getElementById('name').value = data.name;
                document.getElementById('email').value = data.email;
                document.getElementById('rol').value = data.rol;
                document.getElementById('password').placeholder = 'Dejar vacío para no cambiar';
                document.getElementById('password').removeAttribute('required');
            })
            .catch(err => console.error('Error:', err));
    }

    function resetForm() {
        document.getElementById('userForm').reset();
        document.getElementById('userForm').action = '{{ route('usuarios.store') }}';
        document.getElementById('formMethod').value = 'POST';
        document.getElementById('password').setAttribute('required', 'required');
        document.getElementById('password').placeholder = 'Contraseña requerida (8+ chars: mayúsculas, minúsculas, números, especiales)';
    }

    // Reset al cargar
    window.addEventListener('load', resetForm);
</script>
</body>
</html>