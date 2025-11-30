<!DOCTYPE html>
<html class="dark" lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Inicio de Sesión - Gestión de Inventario PMN</title>
    
    <!-- META TAGS ANTI-CACHE - DENTRO DEL HEAD -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    
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

        // Función para alternar entre login y registro
        function toggleForm() {
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            const forgotPasswordForm = document.getElementById('forgot-password-form');
            const loginTitle = document.getElementById('login-title');
            const registerTitle = document.getElementById('register-title');
            const forgotPasswordTitle = document.getElementById('forgot-password-title');
            const loginSubtitle = document.getElementById('login-subtitle');
            const registerSubtitle = document.getElementById('register-subtitle');
            const forgotPasswordSubtitle = document.getElementById('forgot-password-subtitle');
            
            if (loginForm.classList.contains('hidden')) {
                // Mostrar login, ocultar registro y recuperación
                loginForm.classList.remove('hidden');
                registerForm.classList.add('hidden');
                forgotPasswordForm.classList.add('hidden');
                loginTitle.classList.remove('hidden');
                registerTitle.classList.add('hidden');
                forgotPasswordTitle.classList.add('hidden');
                loginSubtitle.classList.remove('hidden');
                registerSubtitle.classList.add('hidden');
                forgotPasswordSubtitle.classList.add('hidden');
            } else {
                // Mostrar registro, ocultar login y recuperación
                loginForm.classList.add('hidden');
                registerForm.classList.remove('hidden');
                forgotPasswordForm.classList.add('hidden');
                loginTitle.classList.add('hidden');
                registerTitle.classList.remove('hidden');
                forgotPasswordTitle.classList.add('hidden');
                loginSubtitle.classList.add('hidden');
                registerSubtitle.classList.remove('hidden');
                forgotPasswordSubtitle.classList.add('hidden');
            }
        }

        // Función para mostrar recuperación de contraseña
        function showForgotPassword() {
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            const forgotPasswordForm = document.getElementById('forgot-password-form');
            const loginTitle = document.getElementById('login-title');
            const registerTitle = document.getElementById('register-title');
            const forgotPasswordTitle = document.getElementById('forgot-password-title');
            const loginSubtitle = document.getElementById('login-subtitle');
            const registerSubtitle = document.getElementById('register-subtitle');
            const forgotPasswordSubtitle = document.getElementById('forgot-password-subtitle');
            
            // Ocultar login y registro, mostrar recuperación
            loginForm.classList.add('hidden');
            registerForm.classList.add('hidden');
            forgotPasswordForm.classList.remove('hidden');
            loginTitle.classList.add('hidden');
            registerTitle.classList.add('hidden');
            forgotPasswordTitle.classList.remove('hidden');
            loginSubtitle.classList.add('hidden');
            registerSubtitle.classList.add('hidden');
            forgotPasswordSubtitle.classList.remove('hidden');
        }

        // Función para mostrar login
        function showLogin() {
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            const forgotPasswordForm = document.getElementById('forgot-password-form');
            const loginTitle = document.getElementById('login-title');
            const registerTitle = document.getElementById('register-title');
            const forgotPasswordTitle = document.getElementById('forgot-password-title');
            const loginSubtitle = document.getElementById('login-subtitle');
            const registerSubtitle = document.getElementById('register-subtitle');
            const forgotPasswordSubtitle = document.getElementById('forgot-password-subtitle');
            
            // Ocultar registro y recuperación, mostrar login
            registerForm.classList.add('hidden');
            forgotPasswordForm.classList.add('hidden');
            loginForm.classList.remove('hidden');
            registerTitle.classList.add('hidden');
            forgotPasswordTitle.classList.add('hidden');
            loginTitle.classList.remove('hidden');
            registerSubtitle.classList.add('hidden');
            forgotPasswordSubtitle.classList.add('hidden');
            loginSubtitle.classList.remove('hidden');
        }

        // Validación de contraseña en tiempo real
        function validatePassword(password) {
            const requirements = {
                length: password.length >= 8,
                uppercase: /[A-Z]/.test(password),
                lowercase: /[a-z]/.test(password),
                number: /[0-9]/.test(password),
                special: /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password)
            };
            
            return requirements;
        }

        function updatePasswordRequirements(password) {
            const requirements = validatePassword(password);
            const requirementElements = {
                length: document.getElementById('req-length'),
                uppercase: document.getElementById('req-uppercase'),
                lowercase: document.getElementById('req-lowercase'),
                number: document.getElementById('req-number'),
                special: document.getElementById('req-special')
            };
            
            // Actualizar cada requisito
            Object.keys(requirements).forEach(key => {
                const element = requirementElements[key];
                if (element) {
                    if (requirements[key]) {
                        element.classList.remove('text-red-500');
                        element.classList.add('text-green-500');
                        element.querySelector('.material-symbols-outlined').textContent = 'check_circle';
                    } else {
                        element.classList.remove('text-green-500');
                        element.classList.add('text-red-500');
                        element.querySelector('.material-symbols-outlined').textContent = 'cancel';
                    }
                }
            });
            
            return Object.values(requirements).every(valid => valid);
        }

        // Inicializar eventos cuando el DOM esté listo
        document.addEventListener('DOMContentLoaded', function() {
            // Validación de contraseña en tiempo real
            const passwordInput = document.querySelector('input[name="password"]');
            if (passwordInput) {
                passwordInput.addEventListener('input', function(e) {
                    updatePasswordRequirements(e.target.value);
                });
            }
            
            // Mostrar formulario correcto basado en errores
            @if($errors->any() && request('form_type') == 'register')
                toggleForm(); // Mostrar registro si hay errores de registro
            @endif
            
            @if(session('status'))
                showForgotPassword(); // Mostrar recuperación si hay mensaje de estado
            @endif
        });
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
                           <!-- Título para Login -->
                           <p id="login-title" class="text-gray-900 dark:text-white text-2xl font-bold leading-tight tracking-[-0.033em]">
                               Bienvenido a PMN-Stock
                           </p>
                           <!-- Título para Registro -->
                           <p id="register-title" class="hidden text-gray-900 dark:text-white text-2xl font-bold leading-tight tracking-[-0.033em]">
                               Crear cuenta en PMN-Stock
                           </p>
                           <!-- Título para Recuperación -->
                           <p id="forgot-password-title" class="hidden text-gray-900 dark:text-white text-2xl font-bold leading-tight tracking-[-0.033em]">
                               Recuperar contraseña
                           </p>
                           
                           <!-- Subtítulo para Login -->
                           <p id="login-subtitle" class="text-gray-500 dark:text-gray-400 text-base font-normal leading-normal">
                               Por favor, inicie sesión para continuar
                           </p>
                           <!-- Subtítulo para Registro -->
                           <p id="register-subtitle" class="hidden text-gray-500 dark:text-gray-400 text-base font-normal leading-normal">
                               Complete sus datos para registrarse
                           </p>
                           <!-- Subtítulo para Recuperación -->
                           <p id="forgot-password-subtitle" class="hidden text-gray-500 dark:text-gray-400 text-base font-normal leading-normal">
                               Ingrese su email para recuperar su contraseña
                           </p>
                       </div>
                   </div>

                    <!-- Formulario de LOGIN CON VALIDACIONES MEJORADAS -->
                    <form id="login-form" action="{{ url('/login') }}" method="POST" class="w-full space-y-6">
                        @csrf

                        <!-- Mostrar errores ESPECÍFICOS -->
                        @if ($errors->any())
                            <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                                <div class="text-red-600 text-sm">
                                    @foreach ($errors->all() as $error)
                                        <p class="flex items-center gap-2 mb-1">
                                            <span class="material-symbols-outlined text-sm">error</span>
                                            {{ $error }}
                                        </p>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Inputs -->
                        <div class="flex flex-col gap-4">
                            <!-- Email -->
                            <label class="flex flex-col w-full">
                                <p class="text-gray-800 dark:text-white text-sm font-medium leading-normal pb-2">Correo electrónico</p>
                                <input name="email" value="{{ old('email') }}" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary-accent/50 border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300 dark:border-gray-600' }} bg-gray-50 dark:bg-gray-700/50 h-12 placeholder:text-gray-400 dark:placeholder:text-gray-500 p-3 text-base font-normal leading-normal" placeholder="Introduzca su correo electrónico" required/>
                                @if($errors->has('email'))
                                    <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                                        <span class="material-symbols-outlined text-sm">error</span>
                                        {{ $errors->first('email') }}
                                    </p>
                                @endif
                            </label>

                            <!-- Contraseña -->
                            <label class="flex flex-col w-full">
                                <p class="text-gray-800 dark:text-white text-sm font-medium leading-normal pb-2">Contraseña</p>
                                <input name="password" type="password" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary-accent/50 border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-300 dark:border-gray-600' }} bg-gray-50 dark:bg-gray-700/50 h-12 placeholder:text-gray-400 dark:placeholder:text-gray-500 p-3 text-base font-normal leading-normal" placeholder="Introduzca su contraseña" required/>
                                @if($errors->has('password'))
                                    <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                                        <span class="material-symbols-outlined text-sm">error</span>
                                        {{ $errors->first('password') }}
                                    </p>
                                @endif
                            </label>
                        </div>

                        <!-- Selección de rol CON VALIDACIÓN -->
                        <div class="flex flex-col gap-2">
                            <p class="text-gray-800 dark:text-white text-sm font-medium leading-normal">Seleccionar rol</p>
                            <div class="flex flex-wrap gap-3">
                                <label class="text-sm font-medium leading-normal flex items-center justify-center rounded-lg border {{ $errors->has('role-selector') ? 'border-red-500' : 'border-gray-300 dark:border-gray-600' }} px-4 h-11 text-gray-800 dark:text-white has-[:checked]:border-2 has-[:checked]:border-primary-accent has-[:checked]:bg-primary-accent/10 relative cursor-pointer flex-1 transition-all duration-200">
                                    Administrador
                                    <input name="role-selector" value="admin" type="radio" {{ old('role-selector', 'admin') == 'admin' ? 'checked' : '' }} class="invisible absolute" required/>
                                </label>
                                <label class="text-sm font-medium leading-normal flex items-center justify-center rounded-lg border {{ $errors->has('role-selector') ? 'border-red-500' : 'border-gray-300 dark:border-gray-600' }} px-4 h-11 text-gray-800 dark:text-white has-[:checked]:border-2 has-[:checked]:border-primary-accent has-[:checked]:bg-primary-accent/10 relative cursor-pointer flex-1 transition-all duration-200">
                                    Usuario
                                    <input name="role-selector" value="user" type="radio" {{ old('role-selector') == 'user' ? 'checked' : '' }} class="invisible absolute" required/>
                                </label>
                            </div>
                            @if($errors->has('role-selector'))
                                <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm">error</span>
                                    {{ $errors->first('role-selector') }}
                                </p>
                            @endif
                        </div>

                        <!-- Botón -->
                        <div class="w-full flex flex-col items-center gap-4">
                            <button type="submit" class="flex items-center justify-center w-full h-12 px-6 bg-primary text-white font-semibold rounded-lg hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-primary-accent focus:ring-offset-2 dark:focus:ring-offset-background-dark active:bg-primary-active transition-colors duration-300">
                                Iniciar sesión
                            </button>
                            <div class="flex flex-col items-center gap-2 w-full">
                                <button type="button" onclick="showForgotPassword()" class="text-sm text-secondary hover:text-primary-accent hover:underline">
                                    ¿Olvidaste tu contraseña?
                                </button>
                                <button type="button" onclick="toggleForm()" class="text-sm text-secondary hover:text-primary-accent hover:underline">
                                    ¿No tienes cuenta? Crear cuenta
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Formulario de REGISTRO -->
                    <form id="register-form" action="{{ url('/register') }}" method="POST" class="hidden w-full space-y-6">
                        @csrf
                        <input type="hidden" name="form_type" value="register">

                        <!-- Mostrar errores -->
                        @if ($errors->any())
                            <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                                <div class="text-red-600 text-sm">
                                    @foreach ($errors->all() as $error)
                                        <p class="flex items-center gap-2 mb-1">
                                            <span class="material-symbols-outlined text-sm">error</span>
                                            {{ $error }}
                                        </p>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Inputs -->
                        <div class="flex flex-col gap-4">
                            <!-- Nombre -->
                            <label class="flex flex-col w-full">
                                <p class="text-gray-800 dark:text-white text-sm font-medium leading-normal pb-2">Nombre completo</p>
                                <input name="name" value="{{ old('name') }}" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary-accent/50 border {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300 dark:border-gray-600' }} bg-gray-50 dark:bg-gray-700/50 h-12 placeholder:text-gray-400 dark:placeholder:text-gray-500 p-3 text-base font-normal leading-normal" placeholder="Introduzca su nombre completo" required/>
                                @if($errors->has('name'))
                                    <p class="text-red-500 text-xs mt-1">{{ $errors->first('name') }}</p>
                                @endif
                            </label>

                            <!-- Email -->
                            <label class="flex flex-col w-full">
                                <p class="text-gray-800 dark:text-white text-sm font-medium leading-normal pb-2">Correo electrónico</p>
                                <input name="email" value="{{ old('email') }}" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary-accent/50 border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300 dark:border-gray-600' }} bg-gray-50 dark:bg-gray-700/50 h-12 placeholder:text-gray-400 dark:placeholder:text-gray-500 p-3 text-base font-normal leading-normal" placeholder="Introduzca su correo electrónico" required/>
                                @if($errors->has('email'))
                                    <p class="text-red-500 text-xs mt-1">{{ $errors->first('email') }}</p>
                                @endif
                            </label>

                            <!-- Contraseña -->
                            <label class="flex flex-col w-full">
                                <p class="text-gray-800 dark:text-white text-sm font-medium leading-normal pb-2">Contraseña</p>
                                <input name="password" type="password" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary-accent/50 border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-300 dark:border-gray-600' }} bg-gray-50 dark:bg-gray-700/50 h-12 placeholder:text-gray-400 dark:placeholder:text-gray-500 p-3 text-base font-normal leading-normal" placeholder="Cree una contraseña segura" required/>
                                
                                <!-- Requisitos de contraseña -->
                                <div class="mt-2 space-y-1">
                                    <p class="text-xs text-gray-600 dark:text-gray-400 font-medium">La contraseña debe contener:</p>
                                    <div id="req-length" class="flex items-center gap-1 text-xs text-red-500">
                                        <span class="material-symbols-outlined text-sm">cancel</span>
                                        <span>Mínimo 8 caracteres</span>
                                    </div>
                                    <div id="req-uppercase" class="flex items-center gap-1 text-xs text-red-500">
                                        <span class="material-symbols-outlined text-sm">cancel</span>
                                        <span>Una letra mayúscula</span>
                                    </div>
                                    <div id="req-lowercase" class="flex items-center gap-1 text-xs text-red-500">
                                        <span class="material-symbols-outlined text-sm">cancel</span>
                                        <span>Una letra minúscula</span>
                                    </div>
                                    <div id="req-number" class="flex items-center gap-1 text-xs text-red-500">
                                        <span class="material-symbols-outlined text-sm">cancel</span>
                                        <span>Un número</span>
                                    </div>
                                    <div id="req-special" class="flex items-center gap-1 text-xs text-red-500">
                                        <span class="material-symbols-outlined text-sm">cancel</span>
                                        <span>Un carácter especial (!@#$%^&*...)</span>
                                    </div>
                                </div>
                                @if($errors->has('password'))
                                    <p class="text-red-500 text-xs mt-1">{{ $errors->first('password') }}</p>
                                @endif
                            </label>

                            <!-- Confirmar Contraseña -->
                            <label class="flex flex-col w-full">
                                <p class="text-gray-800 dark:text-white text-sm font-medium leading-normal pb-2">Confirmar contraseña</p>
                                <input name="password_confirmation" type="password" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary-accent/50 border {{ $errors->has('password_confirmation') ? 'border-red-500' : 'border-gray-300 dark:border-gray-600' }} bg-gray-50 dark:bg-gray-700/50 h-12 placeholder:text-gray-400 dark:placeholder:text-gray-500 p-3 text-base font-normal leading-normal" placeholder="Confirme su contraseña" required/>
                                @if($errors->has('password_confirmation'))
                                    <p class="text-red-500 text-xs mt-1">{{ $errors->first('password_confirmation') }}</p>
                                @endif
                            </label>
                        </div>

                        <!-- Selección de rol -->
                        <div class="flex flex-col gap-2">
                            <p class="text-gray-800 dark:text-white text-sm font-medium leading-normal">Seleccionar rol</p>
                            <div class="flex flex-wrap gap-3">
                                <label class="text-sm font-medium leading-normal flex items-center justify-center rounded-lg border {{ $errors->has('role') ? 'border-red-500' : 'border-gray-300 dark:border-gray-600' }} px-4 h-11 text-gray-800 dark:text-white has-[:checked]:border-2 has-[:checked]:border-primary-accent has-[:checked]:bg-primary-accent/10 relative cursor-pointer flex-1 transition-all duration-200">
                                    Administrador
                                    <input name="role" value="admin" type="radio" {{ old('role', 'user') == 'admin' ? 'checked' : '' }} class="invisible absolute" required/>
                                </label>
                                <label class="text-sm font-medium leading-normal flex items-center justify-center rounded-lg border {{ $errors->has('role') ? 'border-red-500' : 'border-gray-300 dark:border-gray-600' }} px-4 h-11 text-gray-800 dark:text-white has-[:checked]:border-2 has-[:checked]:border-primary-accent has-[:checked]:bg-primary-accent/10 relative cursor-pointer flex-1 transition-all duration-200">
                                    Usuario
                                    <input name="role" value="user" type="radio" {{ old('role', 'user') == 'user' ? 'checked' : '' }} class="invisible absolute" required/>
                                </label>
                            </div>
                            @if($errors->has('role'))
                                <p class="text-red-500 text-xs mt-1">{{ $errors->first('role') }}</p>
                            @endif
                        </div>

                        <!-- Botón -->
                        <div class="w-full flex flex-col items-center gap-4">
                            <button type="submit" class="flex items-center justify-center w-full h-12 px-6 bg-primary text-white font-semibold rounded-lg hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-primary-accent focus:ring-offset-2 dark:focus:ring-offset-background-dark active:bg-primary-active transition-colors duration-300">
                                Crear cuenta
                            </button>
                            <button type="button" onclick="toggleForm()" class="text-sm text-secondary hover:text-primary-accent hover:underline">
                                ¿Ya tienes cuenta? Inicia sesión
                            </button>
                        </div>
                    </form>

                    <!-- Formulario de RECUPERACIÓN DE CONTRASEÑA -->
                    <form id="forgot-password-form" action="{{ url('/forgot-password') }}" method="POST" class="hidden w-full space-y-6">
                        @csrf

                        <!-- Mostrar mensajes -->
                        @if (session('status'))
                            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                                <div class="text-green-600 text-sm">
                                    <p class="flex items-center gap-2">
                                        <span class="material-symbols-outlined text-sm">check_circle</span>
                                        {{ session('status') }}
                                    </p>
                                </div>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                                <div class="text-red-600 text-sm">
                                    @foreach ($errors->all() as $error)
                                        <p class="flex items-center gap-2 mb-1">
                                            <span class="material-symbols-outlined text-sm">error</span>
                                            {{ $error }}
                                        </p>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="text-center">
                            <p class="text-gray-600 dark:text-gray-400 text-sm">
                                Ingrese su dirección de correo electrónico y le enviaremos un enlace para restablecer su contraseña.
                            </p>
                        </div>

                        <!-- Email -->
                        <label class="flex flex-col w-full">
                            <p class="text-gray-800 dark:text-white text-sm font-medium leading-normal pb-2">Correo electrónico</p>
                            <input name="email" type="email" value="{{ old('email') }}" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary-accent/50 border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300 dark:border-gray-600' }} bg-gray-50 dark:bg-gray-700/50 h-12 placeholder:text-gray-400 dark:placeholder:text-gray-500 p-3 text-base font-normal leading-normal" placeholder="Introduzca su correo electrónico" required/>
                            @if($errors->has('email'))
                                <p class="text-red-500 text-xs mt-1">{{ $errors->first('email') }}</p>
                            @endif
                        </label>

                        <!-- Botón -->
                        <div class="w-full flex flex-col items-center gap-4">
                            <button type="submit" class="flex items-center justify-center w-full h-12 px-6 bg-primary text-white font-semibold rounded-lg hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-primary-accent focus:ring-offset-2 dark:focus:ring-offset-background-dark active:bg-primary-active transition-colors duration-300">
                                Enviar enlace de recuperación
                            </button>
                            <button type="button" onclick="showLogin()" class="text-sm text-secondary hover:text-primary-accent hover:underline">
                                Volver al inicio de sesión
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT ANTI-CACHE - AGREGAR AL FINAL -->
<script>
// SOLUCIÓN COMPLETA PARA PREVENIR CACHE

// 1. Detectar cuando la página se carga desde cache
window.addEventListener('pageshow', function(event) {
    if (event.persisted) {
        console.log('Página cargada desde cache - Recargando...');
        window.location.reload();
    }
});

// 2. Prevenir completamente el botón "atrás" del navegador
history.pushState(null, null, window.location.href);
window.addEventListener('popstate', function(event) {
    history.pushState(null, null, window.location.href);
    
    // Si no estamos en login y la URL no es de login, redirigir
    if (!window.location.href.includes('/login')) {
        window.location.href = '/login';
    }
});

// 3. Limpiar todo el storage del navegador
function clearBrowserStorage() {
    sessionStorage.clear();
    localStorage.clear();
}

// 4. Ejecutar limpieza cuando se detecte clic en logout
document.addEventListener('DOMContentLoaded', function() {
    const logoutElements = document.querySelectorAll('a[href*="logout"], form[action*="logout"]');
    logoutElements.forEach(element => {
        element.addEventListener('click', function() {
            clearBrowserStorage();
        });
    });
});

// 5. Forzar recarga si se detecta navegación por cache
if (performance && performance.getEntriesByType("navigation").length > 0) {
    const navEntry = performance.getEntriesByType("navigation")[0];
    if (navEntry.type === 'back_forward') {
        window.location.reload();
    }
}

// 6. Verificar cada 10 segundos si estamos en una página sin sesión
setInterval(function() {
    // Si estamos en una ruta protegida sin sesión, redirigir
    const protectedRoutes = ['/dashboard', '/inventario'];
    const currentPath = window.location.pathname;
    
    if (protectedRoutes.some(route => currentPath.includes(route))) {
        fetch('/login', { 
            method: 'HEAD',
            credentials: 'same-origin'
        })
        .then(response => {
            if (response.redirected) {
                window.location.href = '/login';
            }
        })
        .catch(() => {
            // En caso de error, redirigir al login
            window.location.href = '/login';
        });
    }
}, 10000);

console.log('Script anti-cache cargado correctamente');
</script>
</body>
</html>