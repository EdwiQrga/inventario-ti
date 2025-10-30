<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activo;
use App\Models\User;

class ActivoSeeder extends Seeder
{
    public function run()
    {
        // Ejecutar el seeder de usuarios
        $this->call(UserSeeder::class);

        // Buscar al usuario admin (ajusta el email según tu UserSeeder)
        $admin = User::where('email', 'quirogaedwin008@gmail.com')->first();

        // Crear los activos
        Activo::create([
            'nombre' => 'Monitor LED',
            'tipo' => 'Monitors',
            'sucursal' => 'Sucursal E',
            'serial' => 'a2b3c4d5-e6f7-g8h9-i0j1-k2l3m4n5o6p',
            'descripcion' => 'Monitor LED de 24 pulgadas',
            'ubicacion' => 'Sala de conferencias',
            'fecha_compra' => '2025-09-15',
            'fecha_vencimiento' => '2027-09-15',
            'estado' => 'Ready to Deploy',
            'costo' => 250.00,
            'user_id' => $admin ? $admin->id : null,
        ]);

        Activo::create([
            'nombre' => 'Router Wi-Fi',
            'tipo' => 'Networking',
            'sucursal' => 'Sucursal F',
            'serial' => 'b3c4d5e6-f7g8-h9i0-j1k2-l3m4n5o6p7q',
            'descripcion' => 'Router de doble banda',
            'ubicacion' => 'Almacén',
            'fecha_compra' => '2025-08-20',
            'fecha_vencimiento' => '2027-08-20',
            'estado' => 'Deployed',
            'costo' => 120.00,
            'user_id' => null,
        ]);

        Activo::create([
            'nombre' => 'Teclado Mecánico',
            'tipo' => 'Peripherals',
            'sucursal' => 'Sucursal A',
            'serial' => 'c4d5e6f7-g8h9-i0j1-k2l3-m4n5o6p7q8r',
            'descripcion' => 'Teclado mecánico RGB',
            'ubicacion' => 'Oficina 1',
            'fecha_compra' => '2025-07-10',
            'fecha_vencimiento' => '2027-07-10',
            'estado' => 'Pending',
            'costo' => 90.00,
            'user_id' => null,
        ]);

        Activo::create([
            'nombre' => 'Servidor Rack',
            'tipo' => 'Servers',
            'sucursal' => 'Sucursal B',
            'serial' => 'd5e6f7g8-h9i0-j1k2-l3m4-n5o6p7q8r9s',
            'descripcion' => 'Servidor de rack de 16 núcleos',
            'ubicacion' => 'Centro de datos',
            'fecha_compra' => '2025-06-01',
            'fecha_vencimiento' => '2027-06-01',
            'estado' => 'Deployed',
            'costo' => 3000.00,
            'user_id' => $admin ? $admin->id : null,
        ]);

        Activo::create([
            'nombre' => 'Proyector',
            'tipo' => 'Projectors',
            'sucursal' => 'Sucursal C',
            'serial' => 'e6f7g8h9-i0j1-k2l3-m4n5-o6p7q8r9s0t',
            'descripcion' => 'Proyector Full HD',
            'ubicacion' => 'Sala de reuniones',
            'fecha_compra' => '2025-05-15',
            'fecha_vencimiento' => '2027-05-15',
            'estado' => 'Ready to Deploy',
            'costo' => 800.00,
            'user_id' => null,
        ]);
    }
}
