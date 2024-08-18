<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::paginate(10);
        return view('categorias.index')->with('categorias', $categorias);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categorias.formulario');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los datos de entrada
        $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre',
        ]);

        // Creación de una nueva categoría
        $nuevaCategoria = new Categoria();
        $nuevaCategoria->nombre = $request->input('nombre');
        $nuevaCategoria->save();

        // Redireccionar a la lista de categorías con un mensaje de éxito
        return redirect()->route('categorias.index')->with('mensaje', 'Categoría creada correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categorias.formulario')->with('categoria', $categoria);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validación de los datos de entrada
        $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre,' . $id,
        ]);

        // Actualización de la categoría existente
        $categoria = Categoria::findOrFail($id);
        $categoria->nombre = $request->input('nombre');
        $categoria->save();

        // Redireccionar a la lista de categorías con un mensaje de éxito
        return redirect()->route('categorias.index')->with('mensaje', 'Categoría actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return redirect()->route('categorias.index')->with('mensaje', 'Categoría eliminada correctamente');
    }
}
