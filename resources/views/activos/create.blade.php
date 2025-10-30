@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <h2>➕ Nuevo Activo</h2>
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  @if (session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif
  <form method="POST" action="{{ route('activos.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="asset_tag" class="form-label">Asset Tag</label>
      <input type="text" name="asset_tag" id="asset_tag" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="serial" class="form-label">Serial</label>
      <input type="text" name="serial" id="serial" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="model_id" class="form-label">Model</label>
      <select name="model_id" id="model_id" class="form-control">
        <option value="">Selecciona un modelo</option>
        @foreach ($models as $model)
          <option value="{{ $model->id }}">{{ $model->name }}</option>
        @endforeach
      </select>
    </div>
    <div class="mb-3">
      <label for="category_id" class="form-label">Category</label>
      <select name="category_id" id="category_id" class="form-control">
        <option value="">Selecciona una categoría</option>
        @foreach ($categories as $category)
          <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
      </select>
    </div>
    <div class="mb-3">
      <label for="status" class="form-label">Status</label>
      <select name="status" id="status" class="form-control" required>
        <option value="Deployed">Deployed</option>
        <option value="Ready to Deploy">Ready to Deploy</option>
        <option value="Pending">Pending</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="assigned_to" class="form-label">Checked Out To</label>
      <input type="text" name="assigned_to" id="assigned_to" class="form-control">
    </div>
    <div class="mb-3">
      <label for="image" class="form-label">Imagen</label>
      <input type="file" name="image" id="image" class="form-control">
    </div>
    <button type="submit" name="save" class="btn btn-success">Guardar</button>
    <a href="{{ route('activos.index') }}" class="btn btn-secondary">Cancelar</a>
  </form>
</div>
@endsection