<?php

namespace App\Http\Controllers;

use App\Models\Impresora;
use Illuminate\Http\Request;

class ImpresoraController extends Controller
{
    public function index(Request $request)
    {
        $impresoras = Impresora::when($request->search, function ($q, $search) {
                $q->where('numero_serial', 'like', "%$search%")
                  ->orWhere('direccion_ip', 'like', "%$search%")
                  ->orWhere('sucursal', 'like', "%$search%")
                  ->orWhere('modelo', 'like', "%$search%");
            })
            ->paginate(20);

        return view('impresora.index', compact('impresoras'));
    }

public function store(Request $request)
{
    $request->validate([
        'proveedor'       => 'required|string|max:255',
        'sucursal'        => 'required|string|max:255',
        'nombre_fiscal'   => 'required|string|max:255',
        'marca'           => 'required|string|max:100',
        'modelo'          => 'required|string|max:255',
        'numero_serial'   => 'required|string|unique:impresoras,numero_serial|max:100',
        'direccion_ip'    => 'nullable|ip',
        'estatus'         => 'required|in:Rentada,Comprada,En reparación,Dada de baja',
    ]);

    Impresora::create($request->all());

    return response()->json(['message' => 'Impresora guardada correctamente']);
}
    public function edit(Impresora $impresora)
    {
        return response()->json($impresora);
    }

    public function update(Request $request, Impresora $impresora)
    {
        $request->validate([
            'numero_serial' => 'required|unique:impresoras,numero_serial,' . $impresora->id,
            'direccion_ip'  => 'nullable|ip',
        ]);

        $impresora->update($request->all());

        return response()->json(['message' => '¡Actualizada!']);
    }

    public function destroy(Impresora $impresora)
    {
        $impresora->delete();
        return response()->json(['message' => '¡Eliminada!']);
    }
}