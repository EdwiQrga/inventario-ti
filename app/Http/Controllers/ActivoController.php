<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activo;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ActivosExport;
use App\Imports\ActivosImport;

class ActivoController extends Controller
{
    /**
     * 📋 Mostrar listado de activos con búsqueda y filtros.
     */
    public function index(Request $request)
    {
        $query = Activo::query()->with('user');

        // 🔍 Búsqueda general
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                  ->orWhere('id', 'like', "%{$search}%")
                  ->orWhere('serial', 'like', "%{$search}%")
                  ->orWhere('codigo_barras', 'like', "%{$search}%")
                  ->orWhere('marca', 'like', "%{$search}%")
                  ->orWhere('modelo', 'like', "%{$search}%")
                  ->orWhere('procesador', 'like', "%{$search}%")
                  ->orWhere('asignado_a', 'like', "%{$search}%")
                  ->orWhere('sucursal_area', 'like', "%{$search}%")
                  ->orWhere('razon_social', 'like', "%{$search}%")
                  ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%{$search}%"));
            });
        }

        // 🎯 Filtros opcionales
        if ($request->filled('tipo'))     $query->where('tipo', $request->tipo);
        if ($request->filled('estado'))   $query->where('estado', $request->estado);
        if ($request->filled('marca'))    $query->where('marca', $request->marca);
        if ($request->filled('modelo'))   $query->where('modelo', $request->modelo);
        if ($request->filled('sucursal')) $query->where('sucursal', $request->sucursal);

        // 📊 Listas para selects (filtros en vista)
        $tiposList      = Activo::distinct()->pluck('tipo')->filter()->sort()->values();
        $marcasList     = Activo::distinct()->pluck('marca')->filter()->sort()->values();
        $modelosList    = Activo::distinct()->pluck('modelo')->filter()->sort()->values();
        $sucursalesList = Activo::distinct()->pluck('sucursal')->filter()->sort()->values();

        // 📑 Paginación
        $activos = $query->latest()->paginate(15);

        return view('activos.index', compact(
            'activos',
            'tiposList',
            'marcasList',
            'modelosList',
            'sucursalesList'
        ))->with('search', $request->search);
    }

    /**
     * 💾 Guardar nuevo activo.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string|max:100',
            'marca' => 'nullable|string|max:100',
            'modelo' => 'nullable|string|max:100',
            'sucursal' => 'required|string|max:100',
            'serial' => 'required|string|max:100|unique:activos,serial',
            'descripcion' => 'nullable|string',
            'ubicacion' => 'nullable|string|max:255',
            'fecha_compra' => 'required|date',
            'fecha_vencimiento' => 'nullable|date|after:fecha_compra',
            'estado' => 'required|in:Activo,En Reparación,Retirado',
            'costo' => 'nullable|numeric|min:0',
            'user_id' => 'nullable|exists:users,id',
            'sucursal_area' => 'nullable|string|max:255',
            'razon_social' => 'nullable|string|max:255',
            'codigo_barras' => 'nullable|string|max:255|unique:activos,codigo_barras',
            'ssd' => 'nullable|string|max:255',
            'ram' => 'nullable|string|max:255',
            'procesador' => 'nullable|string|max:255',
            'asignado_a' => 'nullable|string|max:255',
        ]);

        $activo = Activo::create($validated);

        return redirect()
            ->route('activos.index')
            ->with('success', 'Activo creado exitosamente.')
            ->with('highlight', $activo->id);
    }

    /**
     * ✏️ Mostrar formulario de edición.
     */
    public function edit($id)
    {
        $activo = Activo::findOrFail($id);
        $usuarios = User::all();
        return view('activos.edit', compact('activo', 'usuarios'));
    }

    /**
     * 🔄 Actualizar activo existente.
     */
    public function update(Request $request, $id)
    {
        $activo = Activo::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'sucursal' => 'required|string|max:255',
            'serial' => 'required|string|max:255|unique:activos,serial,' . $id,
            'descripcion' => 'nullable|string',
            'ubicacion' => 'nullable|string',
            'fecha_compra' => 'required|date',
            'fecha_vencimiento' => 'nullable|date|after_or_equal:fecha_compra',
            'estado' => 'required|in:Activo,En Reparación,Retirado',
            'costo' => 'nullable|numeric|min:0',
            'user_id' => 'nullable|exists:users,id',
            'sucursal_area' => 'nullable|string|max:255',
            'razon_social' => 'nullable|string|max:255',
            'codigo_barras' => 'nullable|string|max:255|unique:activos,codigo_barras,' . $id,
            'ssd' => 'nullable|string|max:255',
            'ram' => 'nullable|string|max:255',
            'procesador' => 'nullable|string|max:255',
            'asignado_a' => 'nullable|string|max:255',
        ]);

        $activo->update($validated);

        return redirect()->route('activos.index')->with('success', 'Activo actualizado correctamente.');
    }

    /**
     * 👁️ Mostrar detalle de un activo.
     */
    public function show($id)
    {
        $activo = Activo::with('user')->findOrFail($id);
        return view('activos.show', compact('activo'));
    }

    /**
     * 🗑️ Eliminar un activo.
     */
    public function destroy($id)
    {
        Activo::destroy($id);
        return redirect()->route('activos.index')->with('success', 'Activo eliminado correctamente.');
    }

    /**
     * 📤 Exportar activos a Excel.
     */
    public function exportExcel()
    {
        return Excel::download(new ActivosExport, 'activos_' . now()->format('Y-m-d') . '.xlsx');
    }

    /**
     * 📥 Importar archivo Excel con activos.
     */
    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv|max:10240', // 10 MB máx.
        ]);

        try {
            Excel::import(new ActivosImport, $request->file('file'));
            return redirect()->route('activos.index')->with('success', 'Archivo importado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('activos.index')->with('error', 'Error al importar el archivo: ' . $e->getMessage());
        }
    }
}
