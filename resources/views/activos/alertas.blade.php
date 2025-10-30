@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Alertas Preventivas</h1>
        @if($alertas->isEmpty())
            <div class="alert alert-info">No hay alertas actualmente.</div>
        @else
            <ul class="list-group">
                @foreach($alertas as $alerta)
                    <li class="list-group-item {{ $alerta->isVencido() ? 'list-group-item-danger' : 'list-group-item-warning' }}">
                        <strong>{{ $alerta->nombre }}</strong> ({{ $alerta->sucursal }}): 
                        {{ $alerta->isVencido() ? 'Vencido' : 'Próximo a vencer en ' . $alerta->fecha_vencimiento->diffForHumans() }}
                        <a href="{{ route('activos.show', $alerta) }}" class="btn btn-info btn-sm float-end">Ver Detalles</a>
                    </li>
                @endforeach
            </ul>
        @endif
        <a href="{{ route('activos.index') }}" class="btn btn-secondary mt-3">Volver</a>
    </div>
@endsection