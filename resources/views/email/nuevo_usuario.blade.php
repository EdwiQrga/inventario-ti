<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nuevo Usuario Creado</title>
    <style>
        body { font-family: 'Inter', sans-serif; background: #f6f7f8; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; background: white; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .header { background: #005850; color: white; padding: 20px; text-align: center; border-radius: 12px 12px 0 0; }
        .content { padding: 30px; }
        .badge { display: inline-block; padding: 6px 12px; border-radius: 9999px; font-size: 13px; font-weight: 600; }
        .badge-admin { background: #e3f2fd; color: #1976d2; }
        .badge-tecnico { background: #e8f5e8; color: #2e7d32; }
        .badge-usuario { background: #f5f5f5; color: #616161; }
        .footer { text-align: center; padding: 20px; color: #777; font-size: 12px; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Nuevo Usuario Creado</h1>
    </div>
    <div class="content">
        <p>Hola <strong>{{ auth()->user()->name }}</strong>,</p>
        <p>Has creado exitosamente un nuevo usuario en el sistema <strong>Inventario TI</strong>.</p>

        <table style="width:100%; margin:20px 0;">
            <tr>
                <td><strong>Nombre:</strong></td>
                <td>{{ $usuario->name }}</td>
            </tr>
            <tr>
                <td><strong>Email:</strong></td>
                <td>{{ $usuario->email }}</td>
            </tr>
            <tr>
                <td><strong>Rol:</strong></td>
                <td>
                    <span class="badge badge-{{ strtolower(str_replace(' ', '-', $usuario->rol)) }}">
                        {{ $usuario->rol }}
                    </span>
                </td>
            </tr>
            <tr>
                <td><strong>Estado:</strong></td>
                <td>
                    <span class="badge" style="background:#e8f5e8;color:#2e7d32;">
                        {{ $usuario->estado }}
                    </span>
                </td>
            </tr>
        </table>

        <p>El usuario puede iniciar sesión con su correo y la contraseña que le asignaste.</p>
        <p><em>Este es un mensaje automático. No respondas a este correo.</em></p>
    </div>
    <div class="footer">
        <p>Inventario TI &copy; {{ date('Y') }} | Generado el {{ now()->format('d/m/Y H:i') }}</p>
    </div>
</div>
</body>
</html>