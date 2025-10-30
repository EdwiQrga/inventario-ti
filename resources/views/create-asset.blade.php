@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Agregar nuevo activo</h2>

    <form action="{{ route('assets.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Etiqueta (Asset Tag)</label>
            <input type="text" name="asset_tag" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Serial</label>
            <input type="text" name="serial" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">ID Modelo</label>
            <input type="number" name="model_id" class="form-control" required>
            <small class="text-muted">Por ahora, coloca manualmente el ID del modelo (puedes mejorarlo luego con un select).</small>
        </div>

        <div class="mb-3">
            <label class="form-label">ID Categoría</label>
            <input type="number" name="category_id" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Estado</label>
            <select name="status" class="form-select" required>
                <option value="Deployed">Deployed</option>
                <option value="Ready to Deploy">Ready to Deploy</option>
                <option value="Maintenance">Maintenance</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Asignado a</label>
            <input type="text" name="assigned_to" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Guardar Activo</button>
    </form>
</div>
@endsection
