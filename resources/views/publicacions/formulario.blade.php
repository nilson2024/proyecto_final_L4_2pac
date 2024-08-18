@extends('plantillas.plantilla')

@section('titulo', isset($publicacion) ? 'Editar Publicación' : 'Agregar Nueva Publicación')

@section('contenido')
    <h1>{{ isset($publicacion) ? 'Editar Publicación' : 'Agregar Nueva Publicación' }}</h1>

    <form action="{{ isset($publicacion) ? route('publicacions.update', $publicacion->id) : route('publicacions.store') }}" method="POST">
        @csrf
        @if(isset($publicacion))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="{{ old('titulo', $publicacion->titulo ?? '') }}" required>
            @error('titulo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="contenido" class="form-label">Contenido</label>
            <textarea class="form-control" id="contenido" name="contenido" required>{{ old('contenido', $publicacion->contenido ?? '') }}</textarea>
            @error('contenido')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="categorias" class="form-label">Categorías</label>
            <select multiple class="form-control" id="categorias" name="categorias[]">
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ in_array($categoria->id, old('categorias', isset($publicacion) ? $publicacion->categorias->pluck('id')->toArray() : [])) ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
            @error('categorias')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            {{ isset($publicacion) ? 'Actualizar' : 'Guardar' }}
        </button>
    </form>
@endsection

