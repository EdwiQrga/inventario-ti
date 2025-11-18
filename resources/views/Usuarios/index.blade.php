<!DOCTYPE html>
<html class="dark" lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Gestión de Usuarios - Inventario de TI</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    boxShadow: {
                        'DEFAULT': '0 1px 2px 0 rgb(0 0 0 / 0.05)',
                        'md': '0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1)',
                        'lg': '0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1)',
                    },
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
            font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 20;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-gray-800 dark:text-gray-200">
<div class="relative flex h-auto min-h-screen w-full group/design-root overflow-x-hidden">
    <div class="layout-container flex h-full grow flex-row">

        <!-- Sidebar -->
        <aside class="flex-col gap-y-6 items-stretch p-4 bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-800 hidden lg:flex w-64 shadow-sm">
            <div class="flex items-center gap-x-2.5 text-primary px-3 py-2">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd" d="M12.0799 24L4 19.2479L9.95537 8.75216L18.04 13.4961L18.0446 4H29.9554L29.96 13.4961L38.0446 8.75216L44 19.2479L35.92 24L44 28.7521L38.0446 39.2479L29.96 34.5039L29.9554 44H18.0446L18.04 34.5039L9.95537 39.2479L4 28.7521L12.0799 24Z" fill="currentColor" fill-rule="evenodd"></path>
                </svg>
                <span class="text-xl font-bold">Inventario TI</span>
            </div>
            <nav class="flex flex-col gap-y-1.5 flex-1">
                <a class="flex items-center gap-x-3 py-2.5 px-3 rounded-lg text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800/60 hover:text-gray-900 dark:hover:text-gray-100 transition-colors" href="{{ route('dashboard') }}">
                    <span class="material-symbols-outlined text-xl">home</span>
                    <span class="text-sm font-medium">Inicio</span>
                </a>
                <a class="flex items-center gap-x-3 py-2.5 px-3 rounded-lg text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800/60 hover:text-gray-900 dark:hover:text-gray-100 transition-colors" href="{{ route('activos.index') }}">
                    <span class="material-symbols-outlined text-xl">inventory_2</span>
                    <span class="text-sm font-medium">Inventario</span>
                </a>
                <a class="flex items-center gap-x-3 py-2.5 px-3 rounded-lg text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800/60 hover:text-gray-900 dark:hover:text-gray-100 transition-colors" href="#">
                    <span class="material-symbols-outlined text-xl">dashboard</span>
                    <span class="text-sm font-medium">Dashboard</span>
                </a>
                <a class="flex items-center gap-x-3 py-2.5 px-3 rounded-lg text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800/60 hover:text-gray-900 dark:hover:text-gray-100 transition-colors" href="#">
                    <span class="material-symbols-outlined text-xl">notifications_active</span>
                    <span class="text-sm font-medium">Alertas</span>
                </a>
                <a class="flex items-center gap-x-3 py-2.5 px-3 rounded-lg text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800/60 hover:text-gray-900 dark:hover:text-gray-100 transition-colors" href="{{ route('reportes.index') }}">
                    <span class="material-symbols-outlined text-xl">assessment</span>
                    <span class="text-sm font-medium">Reportes</span>
                </a>
                <a class="flex items-center gap-x-3 py-2.5 px-3 rounded-lg text-white bg-primary shadow-sm" href="{{ route('usuarios.index') }}">
                    <span class="material-symbols-outlined text-xl" style="font-variation-settings: 'FILL' 1, 'wght' 400;">group</span>
                    <span class="text-sm font-semibold">Gestión de Usuarios</span>
                </a>
            </nav>
            <div class="flex flex-col gap-y-1.5">
                <a class="flex items-center gap-x-3 py-2.5 px-3 rounded-lg text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800/60 hover:text-gray-900 dark:hover:text-gray-100 transition-colors" href="#">
                    <span class="material-symbols-outlined text-xl">settings</span>
                    <span class="text-sm font-medium">Configuración</span>
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="flex w-full items-center gap-x-3 py-2.5 px-3 rounded-lg text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800/60 hover:text-gray-900 dark:hover:text-gray-100 transition-colors text-left">
                        <span class="material-symbols-outlined text-xl">logout</span>
                        <span class="text-sm font-medium">Cerrar Sesión</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex flex-col flex-1">
            <!-- Header -->
            <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-gray-200 dark:border-gray-800 px-6 sm:px-8 lg:px-10 py-4 bg-white/80 dark:bg-gray-900/80 backdrop-blur-sm sticky top-0 z-10">
                <div class="flex items-center gap-4">
                    <button class="lg:hidden text-gray-600 dark:text-gray-300">
                        <span class="material-symbols-outlined">menu</span>
                    </button>
                    <h1 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">Gestión de Usuarios</h1>
                </div>
                <div class="flex flex-1 justify-end gap-x-2 sm:gap-x-4 items-center">
                    <button class="flex items-center justify-center rounded-full h-10 w-10 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800/60 transition-colors">
                        <span class="material-symbols-outlined text-2xl">notifications</span>
                    </button>
                    <div class="flex items-center gap-x-3">
                        <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
                             style='background-image: url("{{ auth()->user()->avatar ?? "https://ui-avatars.com/api/?name=" . urlencode(auth()->user()->name) }}");'></div>
                        <div class="hidden sm:flex flex-col flex-1 min-w-0">
                            <span class="text-sm font-semibold text-gray-800 dark:text-gray-100 truncate">{{ auth()->user()->name }}</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ auth()->user()->role ?? 'Administrador' }}</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main -->
            <main class="flex-1 px-6 sm:px-8 lg:px-10 py-8 bg-background-light dark:bg-background-dark">
                <div class="max-w-7xl mx-auto space-y-8">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                        <!-- Tabla + Filtros -->
                        <div class="lg:col-span-2 flex flex-col gap-6">
                            <div class="flex flex-wrap justify-between items-center gap-4">
                                <h2 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Lista de Usuarios</h2>
                                <button onclick="resetForm()" class="flex min-w-[40px] max-w-[480px] cursor-pointer items-center justify-center gap-2 overflow-hidden rounded-lg h-10 px-4 bg-primary text-white text-sm font-medium hover:bg-primary/90 transition-all shadow-sm">
                                    <span class="material-symbols-outlined text-xl">add</span>
                                    <span class="truncate">Añadir Usuario</span>
                                </button>
                            </div>

                            <!-- Mensajes -->
                            @if(session('success'))
                                <div class="p-4 bg-secondary/10 dark:bg-secondary/20 border border-secondary/20 dark:border-secondary/30 text-secondary rounded-lg">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if($errors->any())
                                <div class="p-4 bg-red-100 dark:bg-red-900/30 border border-red-300 dark:border-red-700 text-red-800 dark:text-red-200 rounded-lg">
                                    <ul class="list-disc pl-5">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Búsqueda -->
                            <div class="mb-4">
                                <form method="GET" action="{{ route('usuarios.index') }}">
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500 dark:text-gray-400">
                                            <span class="material-symbols-outlined text-xl">search</span>
                                        </span>
                                        <input name="search" type="text" placeholder="Buscar por nombre o email..." value="{{ request('search') }}"
                                               class="pl-10 w-full h-10 px-3 text-sm rounded-lg bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-primary/50">
                                    </div>
                                </form>
                            </div>

                            <!-- Tabla -->
                            <div class="rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 shadow-sm overflow-hidden">
                                <div class="overflow-x-auto">
                                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800 dark:text-gray-400">
                                            <tr>
                                                <th class="px-6 py-3" scope="col">Nombre</th>
                                                <th class="px-6 py-3" scope="col">Email</th>
                                                <th class="px-6 py-3" scope="col">Rol</th>
                                                <th class="px-6 py-3" scope="col">Estado</th>
                                                <th class="px-6 py-3" scope="col"><span class="sr-only">Acciones</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($usuarios as $usuario)
                                                <tr class="bg-white dark:bg-gray-900 border-b dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/60">
                                                    <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" scope="row">
                                                        {{ $usuario->name }}
                                                    </th>
                                                    <td class="px-6 py-4">{{ $usuario->email }}</td>
                                                    <td class="px-6 py-4">
                                                        @php
                                                            $rolColors = [
                                                                'Administrador' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-200',
                                                                'Técnico' => 'bg-indigo-100 text-indigo-800 dark:bg-indigo-900/40 dark:text-indigo-200',
                                                                'Usuario' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
                                                            ];
                                                        @endphp
                                                        <span class="inline-flex items-center gap-x-1.5 py-1 px-2.5 rounded-full text-xs font-medium {{ $rolColors[$usuario->rol] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                                                            {{ $usuario->rol }}
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <span class="inline-flex items-center gap-x-1.5 py-1 px-2.5 rounded-full text-xs font-medium {{ $usuario->estado == 'Activo' ? 'bg-secondary/10 text-secondary dark:bg-secondary/20 dark:text-secondary' : 'bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-300' }}">
                                                            {{ $usuario->estado }}
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 text-right">
                                                        <button onclick="editUser({{ $usuario->id }})" class="font-medium text-primary dark:text-accent-4 hover:underline">Editar</button>
                                                        <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST" class="inline ml-3">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" onclick="return confirm('¿Eliminar usuario?')" class="text-red-600 hover:underline text-sm">Eliminar</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center py-8 text-gray-500 dark:text-gray-400">No hay usuarios registrados.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="p-4">{{ $usuarios->appends(request()->query())->links() }}</div>
                            </div>
                        </div>

                        <!-- Formulario Lateral -->
                        <div class="lg:col-span-1 flex flex-col gap-6">
                            <div class="flex flex-col gap-4 rounded-xl border border-gray-200 dark:border-gray-800 p-6 bg-white dark:bg-gray-900 shadow-sm h-fit">
                                <h3 class="text-gray-900 dark:text-white text-lg font-semibold">Crear Nuevo Usuario</h3>
                                <form action="{{ route('usuarios.store') }}" method="POST" id="userForm">
                                    @csrf
                                    <input type="hidden" name="_method" id="formMethod" value="POST">
                                    <input type="hidden" name="id" id="userId">

                                    <div class="space-y-4">
                                        <div>
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="name">Nombre completo</label>
                                            <input name="name" id="name" type="text" placeholder="Ej: Juan Pérez" required
                                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-accent-4 dark:focus:border-accent-4">
                                        </div>
                                        <div>
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="email">Email</label>
                                            <input name="email" id="email" type="email" placeholder="juan.perez@example.com" required
                                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-accent-4 dark:focus:border-accent-4">
                                        </div>
                                        <div>
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="rol">Rol</label>
                                            <select name="rol" id="rol" required
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-accent-4 dark:focus:border-accent-4">
                                                <option value="">Seleccionar rol</option>
                                                <option value="Administrador">Administrador</option>
                                                <option value="Técnico">Técnico</option>
                                                <option value="Usuario">Usuario</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="password">Contraseña</label>
                                            <input name="password" id="password" type="password" placeholder="Mínimo 8 caracteres" required
                                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-accent-4 dark:focus:border-accent-4">
                                        </div>
                                        <div class="flex gap-2">
                                            <button type="button" onclick="resetForm()" class="flex-1 h-10 px-4 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 text-sm font-medium">
                                                Cancelar
                                            </button>
                                            <button type="submit" class="flex-1 h-10 px-4 bg-primary text-white rounded-lg hover:bg-primary/90 text-sm font-medium shadow-sm">
                                                Guardar Usuario
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
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
        document.getElementById('password').placeholder = 'Mínimo 8 caracteres';
    }

    window.addEventListener('load', resetForm);
</script>
</body>
</html>