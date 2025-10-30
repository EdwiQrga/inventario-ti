<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Asset;
use App\Models\DeviceModel;
use App\Models\Category;

class AssetSeeder extends Seeder
{
    public function run()
    {
        // Crear categorías y modelos
        $laptops = Category::firstOrCreate(['name' => 'Laptops']);
        $desktops = Category::firstOrCreate(['name' => 'Desktops']);
        $printers = Category::firstOrCreate(['name' => 'Printers']);

        $macbook = DeviceModel::firstOrCreate(['name' => 'Macbook Pro 13"']);
        $dell = DeviceModel::firstOrCreate(['name' => 'Dell XPS 13']);
        $hp = DeviceModel::firstOrCreate(['name' => 'HP LaserJet']);

        // Crear activos con valores únicos
        Asset::create([
            'asset_tag' => '1226079034',
            'serial' => '8f8708bb-1101-3827-a0a1-8d653d6c08b4',
            'model_id' => $macbook->id,
            'category_id' => $laptops->id,
            'status' => 'Deployed',
            'assigned_to' => 'Joany Johns',
            'image' => 'default.png',
        ]);

        Asset::create([
            'asset_tag' => '1486879526',
            'serial' => '49cd0487-0994-33dd-b867-b9357a98892',
            'model_id' => $dell->id,
            'category_id' => $desktops->id,
            'status' => 'Ready to Deploy',
            'assigned_to' => null,
            'image' => 'default.png',
        ]);
    }
}
