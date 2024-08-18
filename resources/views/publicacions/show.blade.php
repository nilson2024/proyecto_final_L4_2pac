@extends('plantillas.plantilla')

@section('titulo', 'Detalles de la Publicación')

@section('contenido')
    <h1>Detalles de la Publicación</h1>

    <h2>{{ $publicacion->titulo }}</h2>

    <p>{{ $publicacion->contenido }}</p>

    <h4>Categorías:</h4>
    <ul>
        @foreach($publicacion->categorias as $categoria)
            <li>{{ $categoria->nombre }}</li>
        @endforeach
    </ul>
    <hr>
    <h3>Comentarios</h3>

@foreach($publicacion->comentarios as $comentario)
    <div>{{ $comentario->contenido }}</div>
    <form action="{{ route('comentarios.destroy', $comentario->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Eliminar</button>
    </form>
@endforeach
<hr>

<form action="{{ route('comentarios.store', $publicacion->id) }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="contenido" class="form-label">Añadir Comentario</label>
        <textarea class="form-control" id="contenido" name="contenido" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Comentar</button>
</form>
<hr>

    <a href="{{ route('publicacions.edit', $publicacion->id) }}" class="btn btn-warning">Editar</a>

    <form action="{{ route('publicacions.destroy', $publicacion->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Eliminar</button>
    </form>

    <a href="{{ route('publicacions.index') }}" class="btn btn-secondary">Volver a la lista</a>

@endsection
