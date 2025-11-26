<?php

namespace App\Http\Controllers;

use App\Models\Alerta;
use App\Models\Activo;
use Illuminate\Http\Request;

class AlertaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        $alertas = Alerta::with('activo')
            ->when($search, function($query, $search) {
                return $query->where('titulo', 'like', "%{$search}%")
                           ->orWhere('descripcion', 'like', "%{$search}%")
                           ->orWhere('prioridad', 'like', "%{$search}%")
                           ->orWhere('tipo', 'like', "%{$search}%")
                           ->orWhereHas('activo', function($q) use ($search) {
                               $q->where('nombre', 'like', "%{$search}%");
                           });
            })
            ->orderByRaw("FIELD(prioridad, 'Crítica', 'Moderada', 'Información')")
            ->orderBy('fecha_vencimiento', 'asc')
            ->paginate(10);

        return view('alertas.index', compact('alertas'));
    }

    public function create()
    {
        $activos = Activo::all();
        return view('alertas.create', compact('activos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string|max:500',
            'activo_id' => 'nullable|exists:activos,id',
            'tipo' => 'required|string|max:100',
            'fecha_alerta' => 'required|date',
            'fecha_vencimiento' => 'required|date|after_or_equal:fecha_alerta',
            'prioridad' => 'required|in:Crítica,Moderada,Información',
        ]);

        Alerta::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'activo_id' => $request->activo_id,
            'tipo' => $request->tipo,
            'fecha_alerta' => $request->fecha_alerta,
            'fecha_vencimiento' => $request->fecha_vencimiento,
            'prioridad' => $request->prioridad,
            'estado' => 'Nueva',
        ]);

        return redirect()->route('alertas.index')
            ->with('success', 'Alerta creada exitosamente.');
    }

    public function show(Alerta $alerta)
    {
        return view('alertas.show', compact('alerta'));
    }

    public function edit(Alerta $alerta)
    {
        $activos = Activo::all();
        return view('alertas.edit', compact('alerta', 'activos'));
    }

    public function update(Request $request, Alerta $alerta)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string|max:500',
            'activo_id' => 'nullable|exists:activos,id',
            'tipo' => 'required|string|max:100',
            'fecha_alerta' => 'required|date',
            'fecha_vencimiento' => 'required|date|after_or_equal:fecha_alerta',
            'prioridad' => 'required|in:Crítica,Moderada,Información',
            'estado' => 'required|in:Nueva,En Proceso,Resuelta',
        ]);

        $alerta->update($request->all());

        return redirect()->route('alertas.index')
            ->with('success', 'Alerta actualizada exitosamente.');
    }

    public function destroy(Alerta $alerta)
    {
        $alerta->delete();

        return redirect()->route('alertas.index')
            ->with('success', 'Alerta eliminada exitosamente.');
    }
}