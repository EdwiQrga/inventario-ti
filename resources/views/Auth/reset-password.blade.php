<!-- resources/views/auth/reset-password.blade.php -->
<!DOCTYPE html>
<html class="dark" lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Restablecer Contraseña - PMN Stock</title>
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
                    }
                },
            },
        }

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

        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.querySelector('input[name="password"]');
            if (passwordInput) {
                passwordInput.addEventListener('input', function(e) {
                    updatePasswordRequirements(e.target.value);
                });
            }
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

                   <div class="flex flex-col items-center gap-4">
                       <img src="{{ asset('images/pmn.png') }}" alt="Logo PMN" class="w-24 h-24 object-contain"/>
                       <div class="flex flex-col items-center gap-2">
                           <p class="text-gray-900 dark:text-white text-2xl font-bold leading-tight tracking-[-0.033em]">
                               Restablecer Contraseña
                           </p>
                           <p class="text-gray-500 dark:text-gray-400 text-base font-normal leading-normal text-center">
                               Ingrese su nueva contraseña
                           </p>
                       </div>
                   </div>

                    <form action="{{ url('/reset-password') }}" method="POST" class="w-full space-y-6">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        @if ($errors->any())
                            <div class="text-red-500 text-sm mb-2">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <div class="flex flex-col gap-4">
                            <label class="flex flex-col w-full">
                                <p class="text-gray-800 dark:text-white text-sm font-medium leading-normal pb-2">Correo electrónico</p>
                                <input name="email" type="email" value="{{ $email ?? old('email') }}" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary-accent/50 border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700/50 h-12 placeholder:text-gray-400 dark:placeholder:text-gray-500 p-3 text-base font-normal leading-normal" placeholder="Su correo electrónico" required readonly/>
                            </label>

                            <label class="flex flex-col w-full">
                                <p class="text-gray-800 dark:text-white text-sm font-medium leading-normal pb-2">Nueva contraseña</p>
                                <input name="password" type="password" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary-accent/50 border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700/50 h-12 placeholder:text-gray-400 dark:placeholder:text-gray-500 p-3 text-base font-normal leading-normal" placeholder="Ingrese nueva contraseña" required/>
                                
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
                            </label>

                            <label class="flex flex-col w-full">
                                <p class="text-gray-800 dark:text-white text-sm font-medium leading-normal pb-2">Confirmar nueva contraseña</p>
                                <input name="password_confirmation" type="password" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary-accent/50 border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700/50 h-12 placeholder:text-gray-400 dark:placeholder:text-gray-500 p-3 text-base font-normal leading-normal" placeholder="Confirme su nueva contraseña" required/>
                            </label>
                        </div>

                        <button type="submit" class="flex items-center justify-center w-full h-12 px-6 bg-primary text-white font-semibold rounded-lg hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-primary-accent focus:ring-offset-2 dark:focus:ring-offset-background-dark active:bg-primary-active transition-colors duration-300">
                            Restablecer contraseña
                        </button>

                        <div class="text-center">
                            <a href="{{ route('login') }}" class="text-sm text-secondary hover:text-primary-accent hover:underline">
                                Volver al inicio de sesión
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>