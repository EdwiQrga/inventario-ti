<?php

namespace Database\Seeders;

use App\Models\Activo;
use Illuminate\Database\Seeder;

class ActivoSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // ID 1
            ['Aguascalientes/Jurídico', 'ZACATECAS', 'KC285976', 'Lenovo', 'AIO ThinkCentre NEO 50a GEN5', '512 GB', '16 GB', 'Intel Core i5-12500H', 'MARIANA TORRES'],
            // ID 2
            ['Aguascalientes/Recepción', 'ZACATECAS', 'KC285976', 'Lenovo', 'AIO ThinkCentre NEO 50a GEN5', '512 GB', '16 GB', 'Intel Core i5-12500H', 'YESSIKA ALVARADO'],
            // ID 3
            ['Chihuahua/Recepción', 'NORTE', 'KC265985', 'Lenovo', 'AIO ThinkCentre NEO 50a', '512 GB', '16 GB', 'Intel Core i5-12450H', 'SANDY YANETT SALES PALOMERA'],
            // ID 4
            ['Chihuahua/Jurídico', 'PMN Norte', 'KC286873', 'HP', 'AIO ProOne 240 G10', '512 GB', '16 GB', 'Intel Core i5-1335U', 'GRICELDA HERNANDEZ ROMO'],
            // ID 5
            ['Chihuahua/Jurídico', 'NORTE', 'KC285986', 'Lenovo', 'AIO ThinkCentre NEO 50a', '512 GB', '16 GB', 'Intel Core i5-12450H', 'CLAUDIA KARINA SANDOVAL SOTO'],
            // ID 6
            ['Chihuahua/Renovaciones', 'PMN Norte', 'KC288872', 'HP', 'AIO ProOne 240 G10', '512 GB', '16 GB', 'Intel Core i5-1335U', 'ZEFORA FUENTES'],
            // ID 7
            ['Durango/Recepción', 'DURANGO', 'KC265988', 'Lenovo', 'AIO ThinkCentre NEO 50a', '512 GB', '16 GB', 'Intel Core i5-12450H', 'CRISTIAN ALEXANDER TADEO ROBLEDO'],
            // ID 8
            ['Jalisco/Jurídico', 'Corporativo PMN Occidente', 'KC254189', 'Lenovo', 'AIO ThinkCentre NEO 50a GEN5', '512 GB', '16 GB', 'Intel Core i5-13420H', 'FRANCISCO JOSE ROBLES MARTINEZ'],
            // ID 9
            ['Jalisco/Jurídico', 'Corporativo PMN Occidente', 'KC254187', 'Lenovo', 'AIO ThinkCentre NEO 50a GEN5', '512 GB', '16 GB', 'Intel Core i5-13420H', 'JUAN MANUEL TUFIÑO GONZALEZ'],
            // ID 10
            ['Jalisco/Jurídico', 'Corporativo PMN Occidente', 'KC254188', 'Lenovo', 'AIO ThinkCentre NEO 50a GEN5', '512 GB', '16 GB', 'Intel Core i5-13420H', 'FERNANDO LOPEZ'],
            // ID 11
            ['Jalisco/Gerencia', 'OCCIDENTE', 'KC257805', 'Lenovo', 'AIO ThinkCentre NEO 50a', '512 GB', '16 GB', 'Intel Core i5-12450H', 'MONICS PINEDA OCAMPO'],
            // ID 12
            ['Jalisco/Recepción', 'OCCIDENTE', 'KC257806', 'Lenovo', 'AIO ThinkCentre NEO 50a', '512 GB', '16 GB', 'Intel Core i5-12450H', 'LUZ XIMENA MORAN ESPINOZA'],
            // ID 13
            ['León/Recepción', 'ESTADO DE MEXICO', 'KC281827', 'Lenovo', 'AIO ThinkCentre NEO 50a', '512 GB', '16 GB', 'Intel Core i5-13420H', 'ROBERTO CANUL'],
            // ID 14
            ['Mérida/Jurídico', 'RIVERA MAYA', 'KC281333', 'Lenovo', 'AIO ThinkCentre NEO 50a', '512 GB', '16 GB', 'Intel Core i5-12450H', 'GUADALUPE ISABEL MEDINA MIZET'],
            // ID 15
            ['Mérida/Recepción', 'RIVERA MAYA', 'KC281331', 'Lenovo', 'AIO ThinkCentre NEO 50a', '512 GB', '16 GB', 'Intel Core i5-12450H', 'ANA PAOLA CANO BARRÓN'],
            // ID 16
            ['Monterrey/Jurídico', 'Corporativo PMN Occidente', 'KC285504', 'Lenovo', 'AIO ThinkCentre NEO 50a GEN7', '512 GB', '16 GB', 'Intel Core i5-13420H', 'EVELYN MARIEL HERNANDEZ MONSIVAIS'],
            // ID 17
            ['Monterrey/Renovaciones', 'Corporativo PMN Occidente', 'KC285505', 'Lenovo', 'AIO ThinkCentre NEO 50a GEN7', '512 GB', '16 GB', 'Intel Core i5-13420H', 'NORMA LETICIA PRUNEDA OCHOA'],
            // ID 18
            ['Monterrey/Recepción', 'Corporativo PMN Occidente', 'KC285506', 'Lenovo', 'AIO ThinkCentre NEO 50a GEN7', '512 GB', '16 GB', 'Intel Core i5-13420H', 'DULCE MARIANA MOTA VAZQUEZ'],
            // ID 19
            ['Monterrey/Jurídico', 'NOROESETE', 'KC286117', 'Lenovo', 'AIO ThinkCentre NEO 50a GEN5', '512 GB', '16 GB', 'Intel Core i5-12450H', 'KENIA SARAHI REYES VALDEZ'],
            // ID 20
            ['Monterrey/Jurídico', 'NOROESETE', 'KC286118', 'Lenovo', 'AIO ThinkCentre NEO 50a GEN5', '512 GB', '16 GB', 'Intel Core i5-12450H', 'MARISOL MARTINEZ'],
            // ID 21
            ['Monterrey/Recepción', 'NOROESETE', 'KC286119', 'Lenovo', 'AIO ThinkCentre NEO 50a GEN5', '512 GB', '16 GB', 'Intel Core i5-12450H', 'AIDE OLASCOAGA'],
            // ID 22
            ['Morelia/Jurídico', 'PMN Suroeste', 'PENDIENTE', 'HP', 'AIO ProOne 240 G10', '512 GB', '16 GB', 'Intel Core i5-1335U', 'NIELSEN LETICIA OSEGUERA LOPEZ'],
            // ID 23
            ['Morelia/Recepción', 'SUROESTE', 'KC278125', 'Lenovo', 'AIO ThinkCentre NEO 50a', '512 GB', '16 GB', 'Intel Core i5-12450H', 'BERTHA MELCHOR'],
            // ID 24
            ['Puebla/Jurídico', 'ORIENTE', 'KC278126', 'Lenovo', 'AIO ThinkCentre NEO 50a GEN5', '512 GB', '16 GB', 'Intel Core i5-12450H', 'ANALLELY ALCALO MUNIZ'],
            // ID 25
            ['Puebla/Recepción', 'ORIENTE', 'KC278127', 'Lenovo', 'AIO ThinkCentre NEO 50a GEN5', '512 GB', '16 GB', 'Intel Core i5-12450H', ''],
            // ID 26
            ['Puebla/Jurídico', 'ORIENTE', 'KC281329', 'Lenovo', 'AIO ThinkCentre NEO 50a GEN5', '512 GB', '16 GB', 'Intel Core i5-12450H', ''],

            // ID 32
            ['Querétaro/Asistente', 'PMN BAJIO', 'KC285908', 'Lenovo', 'AIO ThinkCentre NEO 50a GEN5', '512 GB', '16 GB', 'Intel Core i5-13420H', 'BERENICE LEDESMA MARTINEZ'],
            // ID 33
            ['Querétaro/Jurídico', 'PMN BAJIO', 'KC285982', 'Lenovo', 'AIO ThinkCentre NEO 50a GEN5', '512 GB', '16 GB', 'Intel Core i5-13420H', 'ITZEL FERNANDEZ'],
            // ID 34
            ['Querétaro/Jurídico', 'PMN BAJIO', 'KC285981', 'Lenovo', 'AIO ThinkCentre NEO 50a GEN5', '512 GB', '16 GB', 'Intel Core i5-13420H', ''],
            // ID 35
            ['Tijuana/Jurídico', 'PMN Suroeste', 'KC285846', 'HP', 'AIO ProOne 240 G10', '512 GB', '16 GB', 'Intel Core i5-1335U', 'SAUL ISRAEL RAMIREZ PEREGRINA'],
            // ID 36
            ['Tijuana/Recepción', 'PMN Suroeste', 'KC285869', 'HP', 'AIO ProOne 240 G10', '512 GB', '16 GB', 'Intel Core i5-1335U', 'DARIANA DENICE CAPILLA MORENO'],
            // ID 37
            ['Toluca/Recepción', 'ESTADO DE MÉXICO', 'KC278128', 'Lenovo', 'AIO ThinkCentre NEO 50a', '512 GB', '16 GB', 'Intel Core i5-12450H', 'MARIA RUBI MEJIA RUBALCA'],
            // ID 38
            ['Toluca/Jurídico', 'ESTADO DE MÉXICO', 'KC278129', 'Lenovo', 'AIO ThinkCentre NEO 50a', '512 GB', '16 GB', 'Intel Core i5-12450H', 'ITZIGUERI ORTIZ CARRANZA'],
            // ID 39
            ['Toluca/Jurídico', 'ESTADO DE MÉXICO', 'KC285844', 'HP', 'AIO ProOne 240 G10', '512 GB', '16 GB', 'Intel Core i5-1335U', 'LAURA CITLALLI SEGURA MILLAN'],
            // ID 40
            ['Toluca/Renovaciones', 'ESTADO DE MÉXICO', 'KC285845', 'HP', 'AIO ProOne 240 G10', '512 GB', '16 GB', 'Intel Core i5-1335U', 'FABIOLA GONZALEZ GUESADA'],
            // ID 41
            ['Veracruz/Jurídico', 'Metropolitano', 'KC286014', 'Lenovo', 'AIO ThinkCentre NEO 50a GEN5', '512 GB', '16 GB', 'Intel Core i5-12500H', 'JOSE GUILLERMO CARLOS RODRIGUEZ OLIVARES'],
            // ID 42
            ['Veracruz/Recepción', 'Metropolitano', 'KC286015', 'Lenovo', 'AIO ThinkCentre NEO 50a GEN5', '512 GB', '16 GB', 'Intel Core i5-12500H', 'MARIA DEL CARMEN RAMIREZ GALLARDO'],
            // ID 43
            ['Villahermosa/Jurídico', 'VILLAHERMOSA', 'KC281332', 'Lenovo', 'AIO ThinkCentre NEO 50a', '512 GB', '16 GB', 'Intel Core i5-12450H', ''],
            // ID 44
            ['Villahermosa/Jurídico', 'VILLAHERMOSA', 'KC281330', 'Lenovo', 'AIO ThinkCentre NEO 50a', '512 GB', '16 GB', 'Intel Core i5-12450H', ''],
            // ID 45
            ['Villahermosa/Recepción', 'VILLAHERMOSA', 'KC278115', 'Lenovo', 'AIO ThinkCentre NEO 50a', '512 GB', '16 GB', 'Intel Core i5-12450H', 'VALERIA CRISTINA VIDAL MARTINEZ'],
            // ID 46
            ['WTC / Contabilidad', 'Metropolitano', 'KC278130', 'Lenovo', 'AIO ThinkCentre NEO 50a', '512 GB', '16 GB', 'Intel Core i5-13420H', 'JONATAN MONTERO'],
            // ID 47
            ['WTC / Contabilidad', 'Metropolitano', 'KC278254', 'Lenovo', 'AIO ThinkCentre NEO 50a', '512 GB', '16 GB', 'Intel Core i5-13420H', 'LAURA GARCIA'],
            // ID 48
            ['WTC / Coordinación', 'Metropolitano', 'KC281828', 'Lenovo', 'AIO ThinkCentre NEO 50a', '512 GB', '16 GB', 'Intel Core i5-13420H', 'RICARDO CASTELAN'],
            // ID 49
            ['WTC / Jurídico', 'Metropolitano', 'KC278131', 'Lenovo', 'AIO ThinkCentre NEO 50a', '512 GB', '16 GB', 'Intel Core i5-13420H', 'JESUS SOLIS'],
            // ID 50
            ['WTC / Jurídico', 'Metropolitano', 'KC278253', 'Lenovo', 'AIO ThinkCentre NEO 50a', '512 GB', '16 GB', 'Intel Core i5-13420H', 'ISRAEL CRUZ'],
            // ID 51
            ['WTC / Recepción', 'Metropolitano', 'KC281731', 'Lenovo', 'AIO ThinkCentre NEO 50a', '512 GB', '16 GB', 'Intel Core i5-13420H', 'KARLA JUAREZ'],
            // ID 52
            ['WTC/Administrativo', 'Metropolitano', 'KC285512', 'Lenovo', 'ThinkCentre M90A', '512 GB', '16 GB', 'Intel Core i5-12500H', 'JAQUELIN'],
            // ID 53
            ['WTC/Comisiones', 'Metropolitano', 'KC285842', 'HP', 'AIO ProOne 240 G10', '512 GB', '16 GB', 'Intel Core i5-1335U', 'ERIKA COBO'],
            // ID 54
            ['WTC/Contabilidad', 'Metropolitano', 'KC286164', 'Lenovo', 'ThinkCentre M90A', '512 GB', '16 GB', 'Intel Core i5-12500H', 'KAREN CASTRO'],
            // ID 55
            ['WTC/Contabilidad', 'Metropolitano', 'KC286162', 'Lenovo', 'ThinkCentre M90A', '512 GB', '16 GB', 'Intel Core i5-12500H', 'LUIS REYES'],
            // ID 56
            ['WTC/Contabilidad', 'Metropolitano', 'KC285807', 'Lenovo', 'ThinkCentre M90A', '512 GB', '16 GB', 'Intel Core i5-12500H', 'DZOARA MADARIAGA'],
            // ID 57
            ['WTC/Contabilidad', 'Metropolitano', 'KC285843', 'HP', 'AIO ProOne 240 G10', '512 GB', '16 GB', 'Intel Core i5-1335U', 'ELIZABETH GUTIERREZ'],
            // ID 58
            ['WTC/Jurídico', 'Metropolitano', 'KC285809', 'Lenovo', 'ThinkCentre M90A', '512 GB', '16 GB', 'Intel Core i5-12500H', 'PASANTES DE JURIDICO'],
            // ID 59
            ['WTC/Jurídico', 'Metropolitano', 'KC285808', 'Lenovo', 'ThinkCentre M90A', '512 GB', '16 GB', 'Intel Core i5-12500H', 'GUILLERMO RODRIGUEZ'],
            // ID 60
            ['WTC/Jurídico', 'Metropolitano', 'KC285811', 'Lenovo', 'ThinkCentre M90A', '512 GB', '16 GB', 'Intel Core i5-12500H', ''],
            // ID 61
            ['Zacatecas/Jurídico', 'CENTRO', 'KC285973', 'Lenovo', 'AIO ThinkCentre NEO 50a GEN5', '512 GB', '16 GB', 'Intel Core i5-12500H', 'ANTONIO VARGAS'],
            // ID 62
            ['Zacatecas/Recepción', 'CENTRO', 'KC285974', 'Lenovo', 'AIO ThinkCentre NEO 50a GEN5', '512 GB', '16 GB', 'Intel Core i5-12500H', 'VALERIA BARAJAS'],
            // ID 63
            ['WTC/CAJ', 'Hermosillo', 'KC278118', 'Lenovo', 'AIO ThinkCentre NEO 50a GEN5', '512 GB', '16 GB', 'Intel Core i5-13420H', 'Rosa Lizeth Rodríguez Gómez'],
            // ID 64
            ['WTC/CAJ', 'Hermosillo', 'KC278720', 'Lenovo', 'AIO ThinkCentre NEO 50a GEN5', '512 GB', '16 GB', 'Intel Core i5-13420H', 'Cesar Nájera Mondragón'],
            // ID 65
            ['WTC/CAJ', 'Hermosillo', 'KC278719', 'Lenovo', 'AIO ThinkCentre NEO 50a GEN5', '512 GB', '16 GB', 'Intel Core i5-13420H', 'Alejandra Naiel Avila'],
            // ID 66
            ['WTC/Dirección Comercial', 'Hermosillo', 'KC278722', 'Lenovo', 'AIO ThinkCentre NEO 50a GEN5', '1 TB', '32 GB', 'Intel Core i7-13620H', 'Lic. Gerardo Mares'],
        ];

        foreach ($data as $i => $row) {
            $id = $i + 1;
            $sucursal_area = $row[0];
            $sucursal = explode('/', $sucursal_area)[0];
            $codigo_barras = $row[2];
            $marca = $row[3];
            $modelo = $row[4];
            $nombre = $marca . ' ' . $modelo;
            $asignado_a = !empty($row[8]) ? trim($row[8]) : null;

            Activo::updateOrCreate(
                ['id' => $id], // Forzamos el ID exacto
                [
                    'nombre' => $nombre,
                    'tipo' => 'Computadora',
                    'marca' => $marca,
                    'modelo' => $modelo,
                    'sucursal' => $sucursal,
                    'sucursal_area' => $sucursal_area,
                    'razon_social' => $row[1],
                    'serial' => 'SN-' . str_pad($id, 4, '0', STR_PAD_LEFT),
                    'ssd' => $row[5],
                    'ram' => $row[6],
                    'procesador' => $row[7],
                    'estado' => 'Activo',
                    'fecha_compra' => now()->subDays(rand(30, 365)),
                    'asignado_a' => $asignado_a,
                    'codigo_barras' => $codigo_barras,
                ]
            );
        }
    }
}