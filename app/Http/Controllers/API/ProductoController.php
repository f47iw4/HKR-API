<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProductoController extends Controller
{
    // Listar todos los productos
    public function index()
    {
        $productos = Producto::all();

        return response()->json($productos, 200, ['Content-Type' => 'application/json;charset=UTF-8'], JSON_UNESCAPED_UNICODE);// Añado por problema con los caracteres utf-8
    }
    // Mostrar un producto específico
    public function show($id) 
{
    $producto = Producto::findOrFail($id);

    return response()->json($producto, 200, ['Content-Type' => 'application/json;charset=UTF-8'], JSON_UNESCAPED_UNICODE);
}

  
    // Actualizar un producto existente
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
    // Eliminar un producto
    public function destroy($id)
{
    $producto = Producto::findOrFail($id);
    $producto->delete();

    $data =[ 
        'message'=>'Producto eliminado exitosamente',
        'status'=>204
    ];

    return response()->json(null, 204);

        // Ordenar si hay sort y order
        $query = Producto::query();
        if ($request->has('sort') && $request->has('order')) {
            $sortColumn = in_array($request->sort, ['precio', 'nombre', 'categoria']) ? $request->sort : 'id';
            $order = ($request->order === 'desc') ? 'desc' : 'asc';
            $query->orderBy($sortColumn, $order);
            
        }
        //filtra por categoria(anillos, piercing...)
        $query = Producto::query();
        if ($request->has('categoria')) {
            $query->where('categoria', $request->categoria);
        }
        //filtra por precio maximo
        $query = Producto::query();
        if ($request->has('precio_max')) {
            $query->where('precio', '<=', $request->precio_max);
        }
        //ordena por precio 
        if ($request->has('sort') && $request->has('order')) {
            $sortColumn = in_array($request->sort, ['precio', 'nombre', 'categoria']) ? $request->sort : 'id';
            $order = ($request->order === 'desc') ? 'desc' : 'asc';
            $query->orderBy($sortColumn, $order);
        }

}
    // Añadir un producto nuevo 
    public function store(Request $request){
    
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

            if ($validator->fails()){
                $data=[
                    'message'=>'Error en la validación',
                    'errors'=>$validator->errors(),
                    'status'=>400
                ];
                return response()->json($data,400);
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

            $data =[
                'productos'=>$producto,
                'status'=>201
            ];
            return response()->json($data,201);
    }

}
