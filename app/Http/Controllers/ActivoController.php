<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activo;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ActivosExport;

class ActivoController extends Controller
{
    public function index(Request $request)
    {
        $query = Activo::with('user');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nombre', 'like', "%$search%")
                  ->orWhere('tipo', 'like', "%$search%")
                  ->orWhere('marca', 'like', "%$search%")
                  ->orWhere('modelo', 'like', "%$search%")
                  ->orWhere('serial', 'like', "%$search%");
        }

        $activos = $query->paginate(10);
        return view('activos.index', compact('activos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'sucursal' => 'required|string|max:255',
            'serial' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'ubicacion' => 'nullable|string',
            'fecha_compra' => 'required|date',
            'fecha_vencimiento' => 'nullable|date',
            'estado' => 'required|string',
            'costo' => 'nullable|numeric',
            'user_id' => 'nullable|integer|exists:users,id',
        ]);

        Activo::create($validated);
        return redirect()->route('activos.index')->with('success', 'Activo creado correctamente.');
    }

    public function edit($id)
    {
        $activo = Activo::findOrFail($id);
        $usuarios = User::all();
        return view('activos.edit', compact('activo', 'usuarios'));
    }

    public function update(Request $request, $id)
    {
        $activo = Activo::findOrFail($id);

        $activo->update($request->all());
        return redirect()->route('activos.index')->with('success', 'Activo actualizado correctamente.');
    }

    public function show($id)
    {
        $activo = Activo::with('user')->findOrFail($id);
        return view('activos.show', compact('activo'));
    }

    public function destroy($id)
    {
        Activo::destroy($id);
        return redirect()->route('activos.index')->with('success', 'Activo eliminado correctamente.');
    }

    public function exportExcel()
    {
        return Excel::download(new ActivosExport, 'activos.xlsx');
    }
}
