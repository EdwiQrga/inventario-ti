<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html class="dark" lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Inicio de Sesión - Gestión de Inventario PMN</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&amp;display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#005850",
                        "primary-accent": "#62c443",
                        "secondary": "#00868a",
                        "secondary-accent": "#7ac5c7",
                        "dark-primary": "#05553c",
                        "primary-hover": "#01a48b",
                        "primary-active": "#007a63",
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
<body class="bg-background-light dark:bg-dark-primary font-display">
<div class="relative flex h-auto min-h-screen w-full flex-col dark group/design-root overflow-x-hidden">
    <div class="layout-container flex h-full grow flex-col">
        <div class="flex flex-1 justify-center items-center py-5">
            <div class="layout-content-container flex flex-col w-full max-w-md">
                <div class="flex flex-col items-center justify-center p-8 space-y-8 bg-white dark:bg-background-dark rounded-xl shadow-lg">

                   <!-- Logo y título -->
<div class="flex flex-col items-center gap-4">
    <img src="{{ asset('images\pmn.png') }}" alt="Logo PMN" class="w-24 h-24 object-contain"/>
    <div class="flex flex-col items-center gap-2">
        <p class="text-gray-900 dark:text-white text-2xl font-bold leading-tight tracking-[-0.033em]">
            Bienvenido a PMN-Stock
        </p>
        <p class="text-gray-500 dark:text-gray-400 text-base font-normal leading-normal">
            Por favor, inicie sesión para continuar
        </p>
    </div>
</div>


                    <!-- Formulario -->
                    <form action="{{ url('/login') }}" method="POST" class="w-full space-y-6">
                        @csrf

                        <!-- Mostrar errores -->
                        @if ($errors->any())
                            <div class="text-red-500 text-sm mb-2">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <!-- Inputs -->
                        <div class="flex flex-col gap-4">
                            <!-- Email -->
                            <label class="flex flex-col w-full">
                                <p class="text-gray-800 dark:text-white text-sm font-medium leading-normal pb-2">Correo electrónico</p>
                                <input name="email" value="{{ old('email') }}" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary-accent/50 border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700/50 h-12 placeholder:text-gray-400 dark:placeholder:text-gray-500 p-3 text-base font-normal leading-normal" placeholder="Introduzca su correo electrónico"/>
                            </label>

                            <!-- Contraseña -->
                            <label class="flex flex-col w-full">
                                <p class="text-gray-800 dark:text-white text-sm font-medium leading-normal pb-2">Contraseña</p>
                                <input name="password" type="password" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary-accent/50 border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700/50 h-12 placeholder:text-gray-400 dark:placeholder:text-gray-500 p-3 text-base font-normal leading-normal" placeholder="Introduzca su contraseña"/>
                            </label>
                        </div>

                        <!-- Selección de rol -->
                        <div class="flex flex-col gap-2">
                            <p class="text-gray-800 dark:text-white text-sm font-medium leading-normal">Seleccionar rol</p>
                            <div class="flex flex-wrap gap-3">
                                <label class="text-sm font-medium leading-normal flex items-center justify-center rounded-lg border border-gray-300 dark:border-gray-600 px-4 h-11 text-gray-800 dark:text-white has-[:checked]:border-2 has-[:checked]:border-primary-accent has-[:checked]:bg-primary-accent/10 relative cursor-pointer flex-1 transition-all duration-200">
                                    Administrador
                                    <input name="role-selector" value="admin" type="radio" checked class="invisible absolute"/>
                                </label>
                                <label class="text-sm font-medium leading-normal flex items-center justify-center rounded-lg border border-gray-300 dark:border-gray-600 px-4 h-11 text-gray-800 dark:text-white has-[:checked]:border-2 has-[:checked]:border-primary-accent has-[:checked]:bg-primary-accent/10 relative cursor-pointer flex-1 transition-all duration-200">
                                    Usuario
                                    <input name="role-selector" value="user" type="radio" class="invisible absolute"/>
                                </label>
                            </div>
                        </div>

                        <!-- Botón -->
                        <div class="w-full flex flex-col items-center gap-4">
                            <button type="submit" class="flex items-center justify-center w-full h-12 px-6 bg-primary text-white font-semibold rounded-lg hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-primary-accent focus:ring-offset-2 dark:focus:ring-offset-background-dark active:bg-primary-active transition-colors duration-300">
                                Iniciar sesión
                            </button>
                            <a class="text-sm text-secondary hover:text-primary-accent hover:underline" href="#">¿Olvidaste tu contraseña?</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
