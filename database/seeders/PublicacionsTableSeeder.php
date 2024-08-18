<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Publicacion;

class PublicacionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Genera 10 publicaciones usando la factory
        Publicacion::factory(5)->create();
    }
}
