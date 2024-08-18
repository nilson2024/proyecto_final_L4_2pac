<?php

namespace Database\Factories;

use App\Models\Publicacion;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PublicacionFactory extends Factory
{
    protected $model = Publicacion::class;

    public function definition()
    {
        return [
            'titulo' => $this->faker->sentence(),
            'contenido' => $this->faker->paragraph(),
            'user_id' => User::factory(), // Asocia la publicación a un usuario
        ];
    }
}
