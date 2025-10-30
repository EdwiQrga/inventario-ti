<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    // Mostrar todos los activos
    public function index()
    {
        $assets = Asset::with(['model', 'category'])->get();
        return view('dashboard.assets', compact('assets'));
    }

    // Mostrar formulario para crear
    public function create()
    {
        return view('dashboard.create-asset');
    }

    // Guardar activo nuevo
    public function store(Request $request)
    {
        $request->validate([
            'asset_tag' => 'required|unique:assets',
            'serial' => 'required|unique:assets',
            'model_id' => 'required|exists:device_models,id',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required',
        ]);

        Asset::create($request->all());

        return redirect()->route('assets.index')->with('success', 'Activo agregado correctamente.');
    }
}
