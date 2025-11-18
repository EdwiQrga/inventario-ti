<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activo;
use Illuminate\Support\Facades\Log;

class ActivoSeeder extends Seeder
{
    public function run()
    {
        Activo::truncate(); // Limpia la tabla

        $data = [
            // === 1-30 ===
            ["Aguascalientes/Jurídico", "ZACATECAS", "KC285976", "Lenovo", "AIO ThinkCentre NEO 50a GEN5", "512 GB", "16 GB", "Intel Core i5-12500H", "MARIANA TORRES"],
            ["Aguascalientes/Recepción", "ZACATECAS", "KC285976", "Lenovo", "AIO ThinkCentre NEO 50a GEN5", "512 GB", "16 GB", "Intel Core i5-12500H", "YESSIKA ALVARADO"],
            ["Chihuahua/Recepción", "NORTE", "KC265985", "Lenovo", "AIO ThinkCentre NEO 50a", "512 GB", "16 GB", "Intel Core i5-12450H", "SANDY YANETT SALES PALOMERA"],
            ["Chihuahua/Jurídico", "PMN Norte", "KC286873", "HP", "AIO ProOne 240 G10", "512 GB", "16 GB", "Intel Core i5-1335u", "GRICELDA HERNANDEZ ROMO"],
            ["Chihuahua/Jurídico", "NORTE", "KC285986", "Lenovo", "AIO ThinkCentre NEO 50a", "512 GB", "16 GB", "Intel Core i5-12450H", "CLAUDIA KARINA SANDOVAL SOTO"],
            ["Chihuahua/Renovaciones", "PMN Norte", "KC288872", "HP", "AIO ProOne 240 G10", "512 GB", "16 GB", "Intel Core i5-1335u", null],
            ["Durango/Recepción", "DURANGO", "KC265988", "Lenovo", "AIO ThinkCentre NEO 50a", "512 GB", "16 GB", "Intel Core i5-12450H", "ZEFORA FUENTES"],
            ["Jalisco/Jurídico", "Corporativo PMN Occidente", "KC254189", "Lenovo", "AIO ThinkCentre NEO 50a GEN5", "512 GB", "16 GB", "Intel Core i5-13420H", "CRISTIAN ALEXANDER TADEO ROBLEDO"],
            ["Jalisco/Jurídico", "Corporativo PMN Occidente", "KC254187", "Lenovo", "AIO ThinkCentre NEO 50a GEN5", "513 GB", "17 GB", "Intel Core i5-13420H", "FRANCISCO JOSE ROBLES MARTINEZ"],
            ["Jalisco/Jurídico", "Corporativo PMN Occidente", "KC254188", "Lenovo", "AIO ThinkCentre NEO 50a GEN7", "514 GB", "18 GB", "Intel Core i5-13420H", "JUAN MANUEL TUFIÑO GONZALEZ"],
            ["Jalisco/Gerencia", "OCCIDENTE", "KC257805", "Lenovo", "AIO ThinkCentre NEO 50a", "512 GB", "16 GB", "Intel Core i5-12450H", "FERNANDO LOPEZ"],
            ["Jalisco/Recepción", "OCCIDENTE", "KC257806", "Lenovo", "AIO ThinkCentre NEO 50a", "512 GB", "16 GB", "Intel Core i5-12450H", "MONICS PINEDA OCAMPO"],
            ["León/Recepción", "ESTADO DE MÉXICO", "KC281827", "Lenovo", "AIO ThinkCentre NEO 50a", "512 GB", "16 GB", "Intel Core i5-13420H", "LUZ XIMENA MORAN ESPINOZA"],
            ["Mérida/Jurídico", "RIVERA MAYA", "KC281333", "Lenovo", "AIO ThinkCentre NEO 50a", "512 GB", "16 GB", "Intel Core i5-12450H", "ROBERTO CANUL"],
            ["Mérida/Recepción", "RIVERA MAYA", "KC281331", "Lenovo", "AIO ThinkCentre NEO 50a", "512 GB", "16 GB", "Intel Core i5-12450H", "GUADALUPE ISABEL MEDINA MIZET"],
            ["Monterrey/Jurídico", "Corporativo PMN Occidente", "KC285504", "Lenovo", "AIO ThinkCentre NEO 50a GEN7", "514 GB", "18 GB", "Intel Core i5-13420H", "ANA PAOLA CANO BARRÓN"],
            ["Monterrey/Renovaciones", "Corporativo PMN Occidente", "KC285505", "Lenovo", "AIO ThinkCentre NEO 50a GEN7", "514 GB", "18 GB", "Intel Core i5-13420H", "EVELYN MARIEL HERNANDEZ MONSIVÁIS"],
            ["Monterrey/Renovaciones", "Corporativo PMN Occidente", "KC285506", "Lenovo", "AIO ThinkCentre NEO 50a GEN7", "514 GB", "18 GB", "Intel Core i5-13420H", "NORMA LETICIA PRUNEDA OCHOA"],
            ["Monterrey/Jurídico", "NOROESTE", "KC286117", "Lenovo", "AIO ThinkCentre NEO 50a GEN5", "512 GB", "16 GB", "Intel Core i5-12450H", null],
            ["Monterrey/Jurídico", "NOROESTE", "KC286047", "Lenovo", "AIO ThinkCentre NEO 50a GEN5", "512 GB", "16 GB", "Intel Core i5-12450H", null],
            ["Monterrey/Jurídico", "NOROESTE", "KC286118", "Lenovo", "AIO ThinkCentre NEO 50a GEN5", "512 GB", "16 GB", "Intel Core i5-12450H", null],
            ["Monterrey/Jurídico", "NOROESTE", "KC286116", "Lenovo", "AIO ThinkCentre NEO 50a GEN5", "512 GB", "16 GB", "Intel Core i5-12450H", null],
            ["Monterrey/Recepción", "NOROESTE", "KC286119", "Lenovo", "AIO ThinkCentre NEO 50a GEN5", "512 GB", "16 GB", "Intel Core i5-12450H", "DULCE MARIANA MOTA VAZQUEZ"],
            ["Monterrey/Recepción", "NOROESTE", "KC286046", "Lenovo", "AIO ThinkCentre NEO 50a GEN5", "512 GB", "16 GB", "Intel Core i5-12450H", "KENIA SARAHI REYES VALDEZ"],
            ["Morelia/Jurídico", "PMN Suroeste", "PENDIENTE", "HP", "AIO ProOne 240 G10", "512 GB", "16 GB", "Intel Core i5-1335u", "MARISELA MARTINEZ"],
            ["Morelia/Jurídico", "PMN Suroeste", "PENDIENTE", "HP", "AIO ProOne 240 G10", "512 GB", "16 GB", "Intel Core i5-1335u", "AIDE OLASCOAGA"],
            ["Morelia/Recepción", "SUROESTE", "KC278125", "Lenovo", "AIO ThinkCentre NEO 50a", "512 GB", "16 GB", "Intel Core i5-12450H", "NIELSEN LETICIA OSEGUERA LOPEZ"],
            ["Morelia/Ventas", "PMN Suroeste", "KC286870", "HP", "AIO ProOne 240 G10", "512 GB", "16 GB", "Intel Core i5-1335u", "BERTHA MELCHOR"],
            ["Puebla/Jurídico", "ORIENTE", "KC278126", "Lenovo", "AIO ThinkCentre NEO 50a GEN5", "512 GB", "16 GB", "Intel Core i5-12450H", null],
            ["Puebla/Recepción", "ORIENTE", "KC278127", "Lenovo", "AIO ThinkCentre NEO 50a GEN5", "512 GB", "16 GB", "Intel Core i5-12450H", "ANNIELLY ACALCO MUÑIZ"],
            ["Puebla/Jurídico", "ORIENTE", "KC281329", "Lenovo", "AIO ThinkCentre NEO 50a GEN5", "512 GB", "16 GB", "Intel Core i5-12450H", null],
            // === 31-66 ===
            ["Querétaro/Asistente", "PMN BAJIO", "KC285908", "Lenovo", "AIO ThinkCentre NEO 50a GEN5", "512 GB", "16 GB", "Intel Core i5-13420H", "BERENICE LEDESMA MARTINEZ"],
            ["Querétaro/Jurídico", "PMN BAJIO", "KC285982", "Lenovo", "AIO ThinkCentre NEO 50a GEN5", "512 GB", "16 GB", "Intel Core i5-13420H", "ITZEL FERNANDEZ"],
            ["Querétaro/Jurídico", "PMN BAJIO", "KC285981", "Lenovo", "AIO ThinkCentre NEO 50a GEN5", "512 GB", "16 GB", "Intel Core i5-13420H", null],
            ["Tijuana/Jurídico", "PMN Suroeste", "KC286846", "HP", "AIO ProOne 240 G10", "512 GB", "16 GB", "Intel Core i5-1335u", "SAUL ISRAEL RAMIREZ PEREGRINA"],
            ["Tijuana/Recepción", "PMN Suroeste", "KC286869", "HP", "AIO ProOne 240 G10", "512 GB", "16 GB", "Intel Core i5-1335u", "DARIANA DENICE CAPILLA MORENO"],
            ["Toluca/Recepción", "ESTADO DE MÉXICO", "KC278128", "Lenovo", "AIO ThinkCentre NEO 50a", "512 GB", "16 GB", "Intel Core i5-12450H", "MARIA RUBI MEJIA RUBALCA"],
            ["Toluca/Jurídico", "ESTADO DE MÉXICO", "KC278129", "Lenovo", "AIO ThinkCentre NEO 50a", "512 GB", "16 GB", "Intel Core i5-12450H", "ITZIGUERI ORTIZ CARRANZA"],
            ["Toluca/Jurídico", "ESTADO DE MÉXICO", "KC286844", "HP", "AIO ProOne 240 G10", "512 GB", "16 GB", "Intel Core i5-1335u", "LAURA CITLALLI SEGURA MILLAN"],
            ["Toluca/Renovaciones", "ESTADO DE MÉXICO", "KC286845", "HP", "AIO ProOne 240 G10", "512 GB", "16 GB", "Intel Core i5-1335u", "FABIOLA GONZALEZ GUESADA"],
            ["Veracruz/Jurídico", "Metropolitano", "KC286014", "Lenovo", "AIO ThinkCentre NEO 50a GEN5", "512 GB", "16 GB", "Intel Core i5-12500H", "JOSE GUILLERMO CARLOS RODRIGUEZ OLIVARES"],
            ["Veracruz/Recepción", "Metropolitano", "KC286015", "Lenovo", "AIO ThinkCentre NEO 50a GEN5", "512 GB", "16 GB", "Intel Core i5-12500H", "MARIA DEL CARMEN RAMIREZ GALLARDO"],
            ["Villahermosa/Jurídico", "VILLAHERMOSA", "KC281332", "Lenovo", "AIO ThinkCentre NEO 50a", "512 GB", "16 GB", "Intel Core i5-12450H", null],
            ["Villahermosa/Jurídico", "VILLAHERMOSA", "KC281330", "Lenovo", "AIO ThinkCentre NEO 50a", "512 GB", "16 GB", "Intel Core i5-12450H", null],
            ["Villahermosa/Recepción", "VILLAHERMOSA", "KC278115", "Lenovo", "AIO ThinkCentre NEO 50a", "512 GB", "16 GB", "Intel Core i5-12450H", "VALERIA CRISTINA VIDAL MARTINEZ"],
            ["WTC/Contabilidad", "Metropolitano", "KC278130", "Lenovo", "AIO ThinkCentre NEO 50a", "512 GB", "16 GB", "Intel Core i5-13420H", "JONATAN MONTERO"],
            ["WTC/Contabilidad", "Metropolitano", "KC278254", "Lenovo", "AIO ThinkCentre NEO 50a", "512 GB", "16 GB", "Intel Core i5-13420H", "LAURA GARCIA"],
            ["WTC/Contabilidad", "Metropolitano", "KC281828", "Lenovo", "AIO ThinkCentre NEO 50a", "512 GB", "16 GB", "Intel Core i5-13420H", "RICARDO CASTELAN"],
            ["WTC/Jurídico", "Metropolitano", "KC278131", "Lenovo", "AIO ThinkCentre NEO 50a", "512 GB", "16 GB", "Intel Core i5-13420H", "JESUS SOLIS"],
            ["WTC/Jurídico", "Metropolitano", "KC278253", "Lenovo", "AIO ThinkCentre NEO 50a", "513 GB", "16 GB", "Intel Core i5-13420H", "ISRAEL CRUZ"],
            ["WTC/Recepción", "Metropolitano", "KC281731", "Lenovo", "AIO ThinkCentre NEO 50a", "512 GB", "16 GB", "Intel Core i5-13420H", "KARLA JUAREZ"],
            ["WTC/Administrativo", "Metropolitano", "KC286512", "Lenovo", "Thinkcentre M90A", "512 GB", "16 GB", "Intel Core i5-12500H", "JAQUELIN"],
            ["WTC/Comisiones", "Metropolitano", "KC286842", "HP", "AIO ProOne 240 G10", "512 GB", "16 GB", "Intel Core i5-1335u", "ERIKA COBO"],
            ["WTC/Contabilidad", "Metropolitano", "KC286164", "Lenovo", "Thinkcentre M90A", "512 GB", "16 GB", "Intel Core i5-12500H", "KAREN CASTRO"],
            ["WTC/Contabilidad", "Metropolitano", "KC286162", "Lenovo", "Thinkcentre M90A", "512 GB", "16 GB", "Intel Core i5-12500H", "LUIS REYES"],
            ["WTC/Contabilidad", "Metropolitano", "KC286507", "Lenovo", "Thinkcentre M90A", "512 GB", "16 GB", "Intel Core i5-12500H", "DZOARA MADARIAGA"],
            ["WTC/Contabilidad", "Metropolitano", "KC286843", "HP", "AIO ProOne 240 G10", "512 GB", "16 GB", "Intel Core i5-1335u", "ELIZABETH GUTIERREZ"],
            ["WTC/Jurídico", "Metropolitano", "KC286509", "Lenovo", "Thinkcentre M90A", "512 GB", "16 GB", "Intel Core i5-12500H", "PASANTES DE JURIDICO"],
            ["WTC/Jurídico", "Metropolitano", "KC286508", "Lenovo", "Thinkcentre M90A", "512 GB", "16 GB", "Intel Core i5-12500H", "GUILLERMO RODRIGUEZ"],
            ["WTC/Jurídico", "Metropolitano", "KC286511", "Lenovo", "Thinkcentre M90A", "512 GB", "16 GB", "Intel Core i5-12500H", null],
            ["Zacatecas/Jurídico", "CENTRO", "KC285973", "Lenovo", "AIO ThinkCentre NEO 50a GEN5", "512 GB", "16 GB", "Intel Core i5-12500H", "ANTONIO VARGAS"],
            ["Zacatecas/Recepción", "CENTRO", "KC285974", "Lenovo", "AIO ThinkCentre NEO 50a GEN5", "512 GB", "16 GB", "Intel Core i5-12500H", "VALERIA BARAJAS"],
            ["WTC/CAJ", "Hermosillo", "KC278718", "Lenovo", "AIO ThinkCentre NEO 50a GEN5", "512 GB", "16 GB", "Intel Core i5-13420H", "Rosa Lizeth Rodríguez Gómez"],
            ["WTC/CAJ", "Hermosillo", "KC278720", "Lenovo", "AIO ThinkCentre NEO 50a GEN5", "512 GB", "16 GB", "Intel Core i5-13420H", "Cesar Natera Mondragon"],
            ["WTC/CAJ", "Hermosillo", "KC278719", "Lenovo", "AIO ThinkCentre NEO 50a GEN5", "512 GB", "16 GB", "Intel Core i5-13420H", "Alejandra Naiel Avila"],
            ["WTC/Dirección Comercial", "Hermosillo", "KC278722", "Lenovo", "AIO ThinkCentre NEO 50a GEN5", "1 TB", "32 GB", "Intel Core i7-13620H", "Lic. Gerardo Mares"],
        ];

        foreach ($data as $index => $item) {
            try {
                Activo::create([
                    'sucursal_area' => $item[0],
                    'razon_social' => $item[1],
                    'codigo_barras' => $item[2],
                    'marca' => $item[3],
                    'modelo' => $item[4],
                    'sd' => $item[5],
                    'ram' => $item[6],
                    'procesador' => $item[7],
                    'asignado' => $item[8],
                    'estado' => 'Activo',
                ]);
            } catch (\Exception $e) {
                Log::error("❌ Error en registro #{$index}: " . $e->getMessage());
            }
        }
    }
}
