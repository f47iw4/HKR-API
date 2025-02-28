<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductosSeeder extends Seeder
{
    public function run()
    {
        // Leer el archivo JSON
        $json = file_get_contents(database_path('productos.json'));
        $productos = json_decode($json, true);

        // Insertar los productos en la base de datos
        foreach ($productos as $producto) {
            DB::table('productos')->insert([
                // quito el id, es autoincremental 
                'nombre' => $producto['nombre'],
                'descripcion' => $producto['descripcion'],
                'precio' => $producto['precio'],
                'imagen' => json_encode($producto['imagen']),
                'categoria' => $producto['categoria'],
                'material' => $producto['material'],
                'piedras' => json_encode($producto['piedras']),
                'stock' => $producto['stock'],
            ]);
        }
    }
}