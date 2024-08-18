@extends('plantillas.plantilla')

@section('titulo', isset($categoria) ? 'Editar Categoría' : 'Agregar Nueva Categoría')

@section('contenido')
    <h1>{{ isset($categoria) ? 'Editar Categoría' : 'Agregar Nueva Categoría' }}</h1>

    <form action="{{ isset($categoria) ? route('categorias.update', $categoria->id) : route('categorias.store') }}" method="POST">
        @csrf
        @if(isset($categoria))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $categoria->nombre ?? '') }}" required>
            @error('nombre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($categoria) ? 'Actualizar' : 'Guardar' }}</button>
    </form>
@endsection

