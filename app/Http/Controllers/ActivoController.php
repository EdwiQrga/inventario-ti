<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activo;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ActivosExport;

class ActivoController extends Controller
{
    /**
     * 📋 Listado de activos con búsqueda y filtros
     */
    public function index(Request $request)
    {
        $query = Activo::query()->with('user');

        // =============================
        // 🔎 BÚSQUEDA GENERAL
        // =============================
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
                    ->orWhereHas('user', fn ($u) =>
                        $u->where('name', 'like', "%{$search}%")
                    );
            });
        }

        // =============================
        // 🎯 FILTROS
        // =============================
        if ($request->filled('tipo'))     $query->where('tipo', $request->tipo);
        if ($request->filled('estado'))   $query->where('estado', $request->estado);
        if ($request->filled('marca'))    $query->where('marca', $request->marca);
        if ($request->filled('modelo'))   $query->where('modelo', $request->modelo);
        if ($request->filled('sucursal')) $query->where('sucursal', $request->sucursal);

        // Listas para filtros dinámicos
        $tiposList      = Activo::distinct()->pluck('tipo')->filter()->sort()->values();
        $marcasList     = Activo::distinct()->pluck('marca')->filter()->sort()->values();
        $modelosList    = Activo::distinct()->pluck('modelo')->filter()->sort()->values();
        $sucursalesList = Activo::distinct()->pluck('sucursal')->filter()->sort()->values();

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
     * 📄 Formulario crear
     */
    public function create()
    {
        $usuarios = User::orderBy('name')->get();
        return view('activos.create', compact('usuarios'));
    }

    /**
     * 💾 Guardar nuevo activo (Modal AJAX o Form normal)
     */
    public function store(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {

            $validated = $request->validate([
                'sucursal_area' => 'required|string|max:255',
                'razon_social'  => 'required|string|max:255',
                'codigo_barras' => 'required|string|max:100|unique:activos,codigo_barras',
                'marca'         => 'required|string|max:100',
                'modelo'        => 'required|string|max:100',
                'sd'            => 'required|string|max:50',
                'ram'           => 'required|string|max:50',
                'procesador'    => 'required|string|max:150',
                'asignado'      => 'nullable|string|max:255',
                'estado'        => 'required|in:Activo,En Reparación,Obsoleto',
            ]);

            $activo = Activo::create([
                'nombre'         => $validated['marca'] . ' ' . $validated['modelo'],
                'tipo'           => 'Equipo de Cómputo',
                'marca'          => $validated['marca'],
                'modelo'         => $validated['modelo'],
                'sucursal'       => $validated['sucursal_area'],
                'sucursal_area'  => $validated['sucursal_area'],
                'razon_social'   => $validated['razon_social'],
                'serial'         => $validated['codigo_barras'],
                'codigo_barras'  => $validated['codigo_barras'],
                'sd'             => $validated['sd'],
                'ram'            => $validated['ram'],
                'procesador'     => $validated['procesador'],
                'asignado_a'     => $validated['asignado'] ?? null,
                'estado'         => $validated['estado'],
                'fecha_compra'   => now()->format('Y-m-d'),
            ]);

            return response()->json([
                'success' => true,
                'activo'  => $activo,
                'message' => '¡Activo creado exitosamente!'
            ]);
        }
    }

    /**
     * 🔍 Ver detalle
     */
    public function show($id)
    {
        $activo = Activo::with('user')->findOrFail($id);
        return view('activos.show', compact('activo'));
    }

    /**
     * ✏️ Formulario editar
     */
    public function edit($id)
    {
        $activo = Activo::findOrFail($id);
        return view('activos.edit', compact('activo'));
    }

    /**
     * 🔄 Actualización AJAX
     */
public function update(Request $request, $id)
{
    $activo = Activo::findOrFail($id);

    $request->validate([
        'sucursal_area' => 'required|string|max:255',
        'razon_social'  => 'required|string|max:255',
        'codigo_barras' => 'required|string|max:100|unique:activos,codigo_barras,' . $id,
        'marca'         => 'required|string|max:100',
        'modelo'        => 'required|string|max:100',
        'sd'            => 'required|string|max:50',
        'ram'           => 'required|string|max:50',
        'procesador'    => 'required|string|max:150',
        'asignado'      => 'nullable|string|max:255',
        'estado'        => 'required|in:Activo,En reparación,Obsoleto,En Almacén',
        'notas'         => 'nullable|string',
    ]);

    $activo->update([
        'sucursal_area' => $request->sucursal_area,
        'razon_social'  => $request->razon_social,
        'codigo_barras' => $request->codigo_barras,
        'marca'         => $request->marca,
        'modelo'        => $request->modelo,
        'sd'            => $request->sd,
        'ram'           => $request->ram,
        'procesador'    => $request->procesador,
        'asignado_a'    => $request->asignado ?? null,
        'estado'        => $request->estado,
        'notas'         => $request->notas,
    ]);

    return response()->json([
        'success' => true,
        'message' => '¡Activo actualizado correctamente!'
    ]);
}
    /**
     * 🗑️ Eliminar
     */
    public function destroy($id)
    {
        Activo::destroy($id);

        return redirect()
            ->route('activos.index')
            ->with('success', 'Activo eliminado correctamente');
    }
}
