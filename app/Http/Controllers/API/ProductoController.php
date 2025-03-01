<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use OpenApi\Annotations as OA;
/**
 * @OA\Info(
 *     title="API de Productos",
 *     version="1.0.0",
 *     description="API para manejar productos en el catálogo",
 *     @OA\Contact(
 *         name="Tu Nombre",
 *         email="tu_email@dominio.com",
 *         url="http://tusitio.com"
 *     ),
 *     @OA\License(
 *         name="MIT",
 *         url="https://opensource.org/licenses/MIT"
 *     )
 * )
 */
class ProductoController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/productos",
     *     summary="Listar todos los productos",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de productos",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Producto")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $productos = Producto::all();
        return response()->json($productos, 200, ['Content-Type' => 'application/json;charset=UTF-8'], JSON_UNESCAPED_UNICODE);
    }

    /**
     * @OA\Get(
     *     path="/api/productos/{id}",
     *     summary="Mostrar un producto específico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Producto encontrado",
     *         @OA\JsonContent(ref="#/components/schemas/Producto")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Producto no encontrado"
     *     )
     * )
     */
    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return response()->json($producto, 200, ['Content-Type' => 'application/json;charset=UTF-8'], JSON_UNESCAPED_UNICODE);
    }

    /**
     * @OA\Put(
     *     path="/api/productos/{id}",
     *     summary="Actualizar un producto existente",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Producto")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Producto actualizado",
     *         @OA\JsonContent(ref="#/components/schemas/Producto")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Error en la validación"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Producto no encontrado"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'nombre' => 'filled|string|max:255',
            'descripcion' => 'filled|string',
            'precio' => 'filled|numeric',
            'imagen' => 'filled|string', 
            'categoria' => 'filled|string',
            'material' => 'filled|string',
            'piedras' => 'filled|string',
            'stock' => 'filled|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        // Buscar el producto
        $producto = Producto::find($id);
        if (!$producto) {
            return response()->json([
                'message' => 'Producto no encontrado',
                'status' => 404
            ], 404);
        }

        // Actualizar solo los campos enviados en la petición
        $producto->fill($request->only([
            'nombre', 'descripcion', 'precio', 'imagen', 
            'categoria', 'material', 'piedras', 'stock'
        ]));
        
        if (!$producto->isDirty()) {
            return response()->json([
                'message' => 'No se realizaron cambios en el producto',
                'status' => 200
            ], 200);
        }

        $producto->save();

        return response()->json([
            'message' => 'Producto actualizado exitosamente',
            'producto' => $producto,
            'status' => 200
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/productos/{id}",
     *     summary="Eliminar un producto",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Producto eliminado"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Producto no encontrado"
     *     )
     * )
     */
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return response()->json(null, 204);
    }

    /**
     * @OA\Post(
     *     path="/api/productos",
     *     summary="Añadir un nuevo producto",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Producto")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Producto creado",
     *         @OA\JsonContent(ref="#/components/schemas/Producto")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Error en la validación"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validator =  Validator::make($request->all(),[
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric',
            'imagen' => 'required|string|unique:productos', //añade idempotencia
            'categoria' => 'required|string',
            'material' => 'required|string',
            'piedras' => 'required|string',
            'stock' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $producto = Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'imagen' => $request->imagen,
            'categoria' => $request->categoria,
            'material' => $request->material,
            'piedras' => $request->piedras,
            'stock' => $request->stock
        ]);

        return response()->json([
            'producto' => $producto,
            'status' => 201
        ], 201);
    }
}
