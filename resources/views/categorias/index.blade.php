@extends('plantillas.plantilla')

@section('titulo', 'Lista de Categorías')

@section('contenido')
    <h1>Categorías</h1>

    @if (session('mensaje'))
        <div class="alert alert-success">
            {{ session('mensaje') }}
        </div>
    @endif

    <a href="{{ route('categorias.create') }}" class="btn btn-primary mb-3">Crear Nueva Categoría</a>

    @if($categorias->count())
        <table class="table table-dark table-striped mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->id }}</td>
                        <td>{{ $categoria->nombre }}</td>

                        <td class="text-center">
                            <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No hay categorías aún.</p>
    @endif
@endsection