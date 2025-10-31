@extends('layouts.admin')

@section('title', 'Agregar categoría')

@section('content')
<section class="container py-5">
  <h2>Agregar nueva categoría</h2>
  <form action="{{ route('categories.store') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label for="name" class="form-label">Nombre</label>
      <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <button type="submit" class="btn btn-turquesa">Guardar</button>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Volver</a>
  </form>
</section>
@endsection
