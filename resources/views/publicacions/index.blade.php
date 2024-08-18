@extends('plantillas.plantilla')

@section('titulo', 'Lista de Publicaciones')

@section('contenido')
    <h1>Lista de Publicaciones</h1>

    <a href="{{ route('publicacions.create') }}" class="btn btn-primary mb-3">Agregar Nueva Publicación</a>

    @if(session('mensaje'))
        <div class="alert alert-success">
            {{ session('mensaje') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Categorías</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($publicacions as $publicacion)
                <tr>
                    <td>{{ $publicacion->id }}</td>
                    <td>{{ $publicacion->titulo }}</td>
                    <td>
                        @foreach($publicacion->categorias as $categoria)
                            <span class="badge bg-info text-dark">{{ $categoria->nombre }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('publicacions.show', $publicacion->id) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('publicacions.edit', $publicacion->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('publicacions.destroy', $publicacion->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $publicacions->links('pagination::bootstrap-4') }}
@endsection
