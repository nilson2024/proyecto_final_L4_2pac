<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicacion;
use App\Models\Categoria;

class PublicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publicacions = Publicacion::paginate(10);
        return view('publicacions.index')->with('publicacions', $publicacions);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all(); // Asegúrate de que esta línea esté aquí
        return view('publicacions.formulario', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validación de los datos de entrada
    $request->validate([
        'titulo' => 'required|regex:/[A-Za-z áéíóúñ.]+$/i',
        'contenido' => 'required|max:500',
        'categorias' => 'array', // Se asegura de que las categorías sean un array
        'categorias.*' => 'exists:categorias,id', // Verifica que las categorías existan
    ]);

    // Creación de una nueva publicación
    $nuevaPublicacion = new Publicacion();
    $nuevaPublicacion->titulo = $request->input('titulo');
    $nuevaPublicacion->contenido = $request->input('contenido');
    $nuevaPublicacion->user_id = 1; // Puedes cambiar esto para que sea dinámico
    $nuevaPublicacion->save();

    // Sincronización de las categorías con la tabla pivote publicaciones_categorias
    if ($request->has('categorias')) {
        $nuevaPublicacion->categorias()->sync($request->input('categorias'));
    }

    // Redireccionar a la lista de publicaciones con un mensaje de éxito
    return redirect()->route('publicacions.index')->with('mensaje', 'Publicación creada correctamente');
}


    /**
     * Display the specified resource.
     */
    public function show(Publicacion $publicacion)
    {
        return view('publicacions.show')->with('publicacion', $publicacion);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publicacion $publicacion)
    {
        $categorias = Categoria::all(); // Asegúrate de que esta línea esté aquí
        return view('publicacions.formulario', compact('publicacion', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publicacion $publicacion)
{
    $request->validate([
        'titulo' => 'required|string|max:255',
        'contenido' => 'required',
    ]);

    $publicacion->titulo = $request->input('titulo');
    $publicacion->contenido = $request->input('contenido');
    $publicacion->save();

    $publicacion->categorias()->sync($request->input('categorias', []));

    return redirect()->route('publicacions.index')->with('mensaje', 'Publicación actualizada correctamente.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publicacion $publicacion)
    {
        $publicacion->delete();
        return redirect()->route('publicacions.index')->with('mensaje', 'Publicación eliminada correctamente');
    }
}
