<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentario;
use App\Models\Publicacion;

class ComentarioController extends Controller
{
    public function store(Request $request, $publicacionId)
    {
        $request->validate([
            'contenido' => 'required',
        ]);

        $comentario = new Comentario();
        $comentario->contenido = $request->input('contenido');
        $comentario->publicacion_id = $publicacionId;
        $comentario->save();

        return redirect()->route('publicacions.show', $publicacionId)->with('mensaje', 'Comentario añadido');
    }

    public function destroy($id)
    {
        $comentario = Comentario::findOrFail($id);
        $publicacionId = $comentario->publicacion_id;
        $comentario->delete();

        return redirect()->route('publicacions.show', $publicacionId)->with('mensaje', 'Comentario eliminado');
    }
}

