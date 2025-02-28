<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Producto",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="nombre", type="string", example="Anillo corazón"),
 *     @OA\Property(property="descripcion", type="string", example="Anillo con corazón troquelado. Plata con baño de oro"),
 *     @OA\Property(property="precio", type="number", format="float", example=249.99),
 *     @OA\Property(property="imagen", type="string", example="img/productos/J05917-02-1.jpg"),
 *     @OA\Property(property="categoria", type="string", example="anillos"),
 *     @OA\Property(property="material", type="string", example="Plata"),
 *     @OA\Property(property="piedras", type="string", example="topacio,rodolita"),
 *     @OA\Property(property="stock", type="integer", example=10),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2023-10-10T12:00:00.000000Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2023-10-10T12:00:00.000000Z")
 * )
 */

class Producto extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $table= 'productos';
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'imagen',     
        'categoria',
        'material',
        'piedras',      
        'stock',
    ];

    /**
     * Van aqui los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        // Al final no es necesario convertir 'imagen' y 'piedras' a arrays
        // Se podrían convertir a otros tipos, pero no es necesario en este caso
    ];
}