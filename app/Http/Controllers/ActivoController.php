<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activo;
use App\Models\Alerta;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ActivosExport;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ActivoController extends Controller
{
    /**
     * 📋 Listado de activos con búsqueda y filtros
     */
    public function index(Request $request)
    {
        $query = Activo::query();

        // =============================
        // 🔎 BÚSQUEDA GENERAL
        // =============================
        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                    ->orWhere('codigo_barras', 'like', "%{$search}%")
                    ->orWhere('marca', 'like', "%{$search}%")
                    ->orWhere('modelo', 'like', "%{$search}%")
                    ->orWhere('asignado', 'like', "%{$search}%")
                    ->orWhere('sucursal_area', 'like', "%{$search}%")
                    ->orWhere('razon_social', 'like', "%{$search}%")
                    ->orWhere('procesador', 'like', "%{$search}%");
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
        if ($request->filled('sucursal_area')) $query->where('sucursal_area', $request->sucursal_area);

        // Contar alertas pendientes
        $query->withCount(['alertas' => function($q) {
            $q->where('estado', '!=', 'resuelta');
        }]);

        // Listas para filtros dinámicos
        $tiposList      = Activo::distinct()->pluck('tipo')->filter()->sort()->values();
        $marcasList     = Activo::distinct()->pluck('marca')->filter()->sort()->values();
        $modelosList    = Activo::distinct()->pluck('modelo')->filter()->sort()->values();
        $sucursalesList = Activo::distinct()->pluck('sucursal')->filter()->sort()->values();
        $sucursalesAreaList = Activo::distinct()->pluck('sucursal_area')->filter()->sort()->values();

        $activos = $query->latest()->paginate(15);

        return view('activos.index', compact(
            'activos',
            'tiposList',
            'marcasList',
            'modelosList',
            'sucursalesList',
            'sucursalesAreaList'
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
            Log::info('Datos recibidos en store:', $request->all());

            try {
                $validated = $request->validate([
                    'sucursal_area' => 'required|string|max:255',
                    'razon_social'  => 'required|string|max:255',
                    'codigo_barras' => 'nullable|string|max:100|unique:activos,codigo_barras',
                    'marca'         => 'required|string|max:100',
                    'modelo'        => 'required|string|max:100',
                    'sd'            => 'nullable|string|max:50',
                    'ram'           => 'nullable|string|max:50',
                    'procesador'    => 'nullable|string|max:150',
                    'asignado'      => 'nullable|string|max:255',
                    'estado'        => 'required|in:Activo,En Reparación,Obsoleto,Óptimo',
                    
                    // NUEVOS CAMPOS (opcionales)
                    'fecha_adquisicion' => 'nullable|date',
                    'fecha_vencimiento_garantia' => 'nullable|date',
                    'proveedor_garantia' => 'nullable|string|max:255',
                    'ultimo_mantenimiento' => 'nullable|date',
                    'proximo_mantenimiento' => 'nullable|date',
                    'frecuencia_mantenimiento_meses' => 'nullable|integer|min:1|max:24',
                    'estado_operativo' => 'nullable|in:optimo,degradado,critico,Óptimo',
                    'fecha_fin_vida_util' => 'nullable|date',
                    'vida_util_anos' => 'nullable|integer|min:1|max:10',
                    'observaciones' => 'nullable|string',
                ]);

                // Generar código de barras automático si no viene
                $codigoBarras = $validated['codigo_barras'] ?? 'ACT-' . uniqid();

                // Crear el activo con TODOS los campos existentes
                $activoData = [
                    'sucursal_area' => $validated['sucursal_area'],
                    'razon_social'  => $validated['razon_social'],
                    'codigo_barras' => $codigoBarras,
                    'marca'         => $validated['marca'],
                    'modelo'        => $validated['modelo'],
                    'sd'            => $validated['sd'] ?? 'No especificado',
                    'ram'           => $validated['ram'] ?? 'No especificado',
                    'procesador'    => $validated['procesador'] ?? 'No especificado',
                    'asignado'      => $validated['asignado'] ?? null,
                    'estado'        => $validated['estado'],
                    'tipo'          => 'Equipo de Cómputo',
                    'sucursal'      => $validated['sucursal_area'],
                    
                    // NUEVOS CAMPOS
                    'fecha_adquisicion' => $validated['fecha_adquisicion'] ?? null,
                    'fecha_vencimiento_garantia' => $validated['fecha_vencimiento_garantia'] ?? null,
                    'proveedor_garantia' => $validated['proveedor_garantia'] ?? null,
                    'ultimo_mantenimiento' => $validated['ultimo_mantenimiento'] ?? null,
                    'proximo_mantenimiento' => $validated['proximo_mantenimiento'] ?? null,
                    'frecuencia_mantenimiento_meses' => $validated['frecuencia_mantenimiento_meses'] ?? 6,
                    'estado_operativo' => $validated['estado_operativo'] ?? 'optimo',
                    'fecha_fin_vida_util' => $validated['fecha_fin_vida_util'] ?? null,
                    'vida_util_anos' => $validated['vida_util_anos'] ?? 5,
                    'observaciones' => $validated['observaciones'] ?? null,
                ];

                $activo = Activo::create($activoData);

                // 🔔 GENERAR ALERTAS AUTOMÁTICAMENTE
                $alertasGeneradas = $this->generarAlertas($activo);
                Log::info('Alertas generadas: ' . count($alertasGeneradas));

                Log::info('Activo creado exitosamente ID: ' . $activo->id);

                return response()->json([
                    'success' => true,
                    'activo'  => $activo,
                    'alertas_generadas' => count($alertasGeneradas),
                    'message' => '¡Activo creado exitosamente!'
                ]);

            } catch (\Illuminate\Validation\ValidationException $e) {
                Log::error('Error de validación: ' . json_encode($e->errors()));
                return response()->json([
                    'success' => false,
                    'message' => 'Error de validación',
                    'errors' => $e->errors()
                ], 422);
            } catch (\Exception $e) {
                Log::error('Error general en store: ' . $e->getMessage());
                Log::error('Trace: ' . $e->getTraceAsString());
                return response()->json([
                    'success' => false,
                    'message' => 'Error interno del servidor: ' . $e->getMessage()
                ], 500);
            }
        }
    }

    /**
     * 🔍 Ver detalle
     */
    public function show($id)
    {
        $activo = Activo::with(['alertas' => function($q) {
            $q->where('estado', '!=', 'resuelta')->orderBy('fecha_vencimiento', 'asc');
        }])->withCount(['alertas' => function($q) {
            $q->where('estado', '!=', 'resuelta');
        }])->findOrFail($id);
        
        return view('activos.show', compact('activo'));
    }

    /**
     * ✏️ Formulario editar
     */
    public function edit($id)
    {
        $activo = Activo::findOrFail($id);
        $usuarios = User::orderBy('name')->get();
        return view('activos.edit', compact('activo', 'usuarios'));
    }

    /**
     * 🔄 Actualización AJAX
     */
    public function update(Request $request, $id)
    {
        $activo = Activo::findOrFail($id);

        try {
            $validated = $request->validate([
                'sucursal_area' => 'required|string|max:255',
                'razon_social'  => 'required|string|max:255',
                'codigo_barras' => 'required|string|max:100|unique:activos,codigo_barras,' . $id,
                'marca'         => 'required|string|max:100',
                'modelo'        => 'required|string|max:100',
                'sd'            => 'nullable|string|max:50',
                'ram'           => 'nullable|string|max:50',
                'procesador'    => 'nullable|string|max:150',
                'asignado'      => 'nullable|string|max:255',
                'estado'        => 'required|in:Activo,En Reparación,Obsoleto,En Almacén,Óptimo',
                // Nuevos campos
                'fecha_adquisicion' => 'nullable|date',
                'fecha_vencimiento_garantia' => 'nullable|date',
                'proveedor_garantia' => 'nullable|string|max:255',
                'ultimo_mantenimiento' => 'nullable|date',
                'proximo_mantenimiento' => 'nullable|date',
                'frecuencia_mantenimiento_meses' => 'nullable|integer|min:1|max:24',
                'estado_operativo' => 'nullable|in:optimo,degradado,critico,Óptimo',
                'fecha_fin_vida_util' => 'nullable|date',
                'vida_util_anos' => 'nullable|integer|min:1|max:10',
                'observaciones' => 'nullable|string',
            ]);

            $activo->update([
                'sucursal_area' => $validated['sucursal_area'],
                'razon_social'  => $validated['razon_social'],
                'codigo_barras' => $validated['codigo_barras'],
                'marca'         => $validated['marca'],
                'modelo'        => $validated['modelo'],
                'sd'            => $validated['sd'] ?? 'No especificado',
                'ram'           => $validated['ram'] ?? 'No especificado',
                'procesador'    => $validated['procesador'] ?? 'No especificado',
                'asignado'      => $validated['asignado'] ?? null,
                'estado'        => $validated['estado'],
                // Nuevos campos
                'fecha_adquisicion' => $validated['fecha_adquisicion'] ?? null,
                'fecha_vencimiento_garantia' => $validated['fecha_vencimiento_garantia'] ?? null,
                'proveedor_garantia' => $validated['proveedor_garantia'] ?? null,
                'ultimo_mantenimiento' => $validated['ultimo_mantenimiento'] ?? null,
                'proximo_mantenimiento' => $validated['proximo_mantenimiento'] ?? null,
                'frecuencia_mantenimiento_meses' => $validated['frecuencia_mantenimiento_meses'] ?? 6,
                'estado_operativo' => $validated['estado_operativo'] ?? 'optimo',
                'fecha_fin_vida_util' => $validated['fecha_fin_vida_util'] ?? null,
                'vida_util_anos' => $validated['vida_util_anos'] ?? 5,
                'observaciones' => $validated['observaciones'] ?? null,
            ]);

            // 🔔 GENERAR ALERTAS DESPUÉS DE ACTUALIZAR
            $alertasGeneradas = $this->generarAlertas($activo);
            Log::info('Alertas generadas después de actualizar: ' . count($alertasGeneradas));

            return response()->json([
                'success' => true,
                'alertas_generadas' => count($alertasGeneradas),
                'message' => '¡Activo actualizado correctamente!'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Error de validación en update: ' . json_encode($e->errors()));
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Error general en update: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error interno del servidor: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * 🔔 Generar alertas automáticas para un activo
     */
    public function generarAlertas(Activo $activo)
    {
        $alertasGeneradas = [];

        try {
            // Alerta de próximo mantenimiento
            if ($activo->proximo_mantenimiento) {
                $fechaMantenimiento = Carbon::parse($activo->proximo_mantenimiento);
                $hoy = Carbon::now();
                
                if ($fechaMantenimiento->diffInDays($hoy) <= 30) {
                    $alerta = Alerta::create([
                        'activo_id' => $activo->id,
                        'tipo' => 'mantenimiento',
                        'titulo' => 'Mantenimiento próximo para ' . $activo->marca . ' ' . $activo->modelo,
                        'descripcion' => 'El mantenimiento programado está próximo para el ' . $activo->proximo_mantenimiento,
                        'fecha_alerta' => now(),
                        'fecha_vencimiento' => $activo->proximo_mantenimiento,
                        'prioridad' => $fechaMantenimiento->diffInDays($hoy) <= 7 ? 'alta' : 'media',
                        'estado' => 'pendiente'
                    ]);
                    $alertasGeneradas[] = $alerta;
                    Log::info("Alerta de mantenimiento creada para activo ID: {$activo->id}");
                }
            }

            // Alerta de vencimiento de garantía
            if ($activo->fecha_vencimiento_garantia) {
                $fechaGarantia = Carbon::parse($activo->fecha_vencimiento_garantia);
                $hoy = Carbon::now();
                
                if ($fechaGarantia->diffInDays($hoy) <= 60) {
                    $alerta = Alerta::create([
                        'activo_id' => $activo->id,
                        'tipo' => 'garantia',
                        'titulo' => 'Garantía próxima a vencer - ' . $activo->proveedor_garantia,
                        'descripcion' => 'La garantía con ' . $activo->proveedor_garantia . ' vence el ' . $activo->fecha_vencimiento_garantia,
                        'fecha_alerta' => now(),
                        'fecha_vencimiento' => $activo->fecha_vencimiento_garantia,
                        'prioridad' => $fechaGarantia->diffInDays($hoy) <= 30 ? 'alta' : 'media',
                        'estado' => 'pendiente'
                    ]);
                    $alertasGeneradas[] = $alerta;
                    Log::info("Alerta de garantía creada para activo ID: {$activo->id}");
                }
            }

            // Alerta de fin de vida útil
            if ($activo->fecha_fin_vida_util) {
                $fechaVidaUtil = Carbon::parse($activo->fecha_fin_vida_util);
                $hoy = Carbon::now();
                
                if ($fechaVidaUtil->diffInDays($hoy) <= 90) {
                    $alerta = Alerta::create([
                        'activo_id' => $activo->id,
                        'tipo' => 'vida_util',
                        'titulo' => 'Fin de vida útil próximo',
                        'descripcion' => 'El activo alcanzará el fin de su vida útil el ' . $activo->fecha_fin_vida_util,
                        'fecha_alerta' => now(),
                        'fecha_vencimiento' => $activo->fecha_fin_vida_util,
                        'prioridad' => 'media',
                        'estado' => 'pendiente'
                    ]);
                    $alertasGeneradas[] = $alerta;
                    Log::info("Alerta de vida útil creada para activo ID: {$activo->id}");
                }
            }

        } catch (\Exception $e) {
            Log::error('Error al generar alertas para activo ID ' . $activo->id . ': ' . $e->getMessage());
        }

        return $alertasGeneradas;
    }

    /**
     * 📊 Generar reportes de activos
     */
    public function reportes()
    {
        $totalActivos = Activo::count();
        $activosPorEstado = Activo::groupBy('estado')
            ->selectRaw('estado, count(*) as total')
            ->get();
        $activosPorMarca = Activo::groupBy('marca')
            ->selectRaw('marca, count(*) as total')
            ->orderBy('total', 'desc')
            ->get();
        $proximosMantenimientos = Activo::where('proximo_mantenimiento', '>=', now())
            ->where('proximo_mantenimiento', '<=', now()->addDays(30))
            ->orderBy('proximo_mantenimiento', 'asc')
            ->get();

        return view('activos.reportes', compact(
            'totalActivos',
            'activosPorEstado',
            'activosPorMarca',
            'proximosMantenimientos'
        ));
    }

    /**
     * 📈 Dashboard con estadísticas
     */
    public function dashboard()
    {
        $totalActivos = Activo::count();
        $activosActivos = Activo::where('estado', 'Activo')->count();
        $activosEnReparacion = Activo::where('estado', 'En Reparación')->count();
        $alertasPendientes = Alerta::where('estado', 'pendiente')->count();
        $proximasAlertas = Alerta::with('activo')
            ->where('estado', 'pendiente')
            ->where('fecha_vencimiento', '<=', now()->addDays(7))
            ->orderBy('fecha_vencimiento', 'asc')
            ->limit(10)
            ->get();

        return view('activos.dashboard', compact(
            'totalActivos',
            'activosActivos',
            'activosEnReparacion',
            'alertasPendientes',
            'proximasAlertas'
        ));
    }

    /**
     * 🗑️ Eliminar
     */
    public function destroy($id)
    {
        try {
            $activo = Activo::findOrFail($id);
            $activo->delete();

            Log::info('Activo eliminado ID: ' . $id);

            return redirect()
                ->route('activos.index')
                ->with('success', 'Activo eliminado correctamente');

        } catch (\Exception $e) {
            Log::error('Error al eliminar activo: ' . $e->getMessage());
            return redirect()
                ->route('activos.index')
                ->with('error', 'Error al eliminar el activo');
        }
    }

    /**
     * 📤 Exportar activos a Excel
     */
    public function exportarExcel()
    {
        return Excel::download(new ActivosExport, 'activos_' . date('Y-m-d') . '.xlsx');
    }

    /**
     * 🔄 Verificar y generar alertas para todos los activos
     */
    public function verificarTodasAlertas()
    {
        $activos = Activo::whereNotNull('proximo_mantenimiento')
            ->orWhereNotNull('fecha_vencimiento_garantia')
            ->orWhereNotNull('fecha_fin_vida_util')
            ->get();

        $totalAlertas = 0;

        foreach ($activos as $activo) {
            $alertas = $this->generarAlertas($activo);
            $totalAlertas += count($alertas);
        }

        return response()->json([
            'success' => true,
            'message' => "Generadas {$totalAlertas} alertas para todos los activos."
        ]);
    }
}