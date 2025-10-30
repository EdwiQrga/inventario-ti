@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">Detalles del Activo</h2>
        <div class="card">
            <div class="card-body">
                <p class="card-text"><strong>Nombre:</strong> {{ $activo->nombre }}</p>
                <p class="card-text"><strong>Tipo:</strong> {{ $activo->tipo }}</p>
                <p class="card-text"><strong>Sucursal:</strong> {{ $activo->sucursal }}</p>
                <p class="card-text"><strong>Serial:</strong> {{ $activo->serial }}</p>
                <p class="card-text"><strong>Descripción:</strong> {{ $activo->descripcion ?? 'N/A' }}</p>
                <p class="card-text"><strong>Ubicación:</strong> {{ $activo->ubicacion ?? 'N/A' }}</p>
                <p class="card-text"><strong>Fecha de Compra:</strong> {{ $activo->fecha_compra->format('d/m/Y') }}</p>
                <p class="card-text"><strong>Fecha de Vencimiento:</strong> {{ $activo->fecha_vencimiento ? $activo->fecha_vencimiento->format('d/m/Y') : 'N/A' }}</p>
                <p class="card-text"><strong>Estado:</strong> <span class="badge {{ $activo->estado == 'activo' ? 'bg-success' : ($activo->estado == 'mantenimiento' ? 'bg-warning' : 'bg-danger') }}">{{ $activo->estado }}</span></p>
                <p class="card-text"><strong>Costo:</strong> {{ $activo->costo ? '$' . number_format($activo->costo, 2) : 'N/A' }}</p>
                <a href="{{ route('activos.index') }}" class="btn btn-primary">Volver a la Lista</a>
            </div>
        </div>
    </div>
@endsection