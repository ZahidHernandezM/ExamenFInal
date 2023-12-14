<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


/**
 * @OA\Info(
 *             title="Api Productos",
 *             version="1.0",
 *             description="Listado de endpoints de los productos"
 * )
 *
 * @OA\Server(url="http://127.0.0.1:8000")
 */


class ApiProductController extends Controller
{
    /**
     * Listado de todos los registros de productos
     * @OA\Get (
     *     path="/api/productos",
     *     tags={"Productos"},
     *     @OA\Response(
     *         response=200,
     *         description="Ok",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="rows",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="nombres",
     *                         type="string",
     *                         example="Aderson Felix"
     *                     ),
     *                     @OA\Property(
     *                         property="descripcion",
     *                         type="string",
     *                         example="Jara Lazaro"
     *                     ),
     *                     @OA\Property(
     *                         property="precio_unitario",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="cantidad",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="costo_total",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="created_at",
     *                         type="string",
     *                         example="2023-02-23T00:09:16.000000Z"
     *                     ),
     *                     @OA\Property(
     *                         property="updated_at",
     *                         type="string",
     *                         example="2023-02-23T12:33:45.000000Z"
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */

    public function index()
    {
        $products = Product::with('categories')->get();
        return response()->json($products,200);
    }
    /**
     * @OA\Post (
     *     path="/api/productos",
     *     tags={"Productos"},
     *     summary="Crear un nuevo producto",
     *     description="Crea un nuevo producto con la información proporcionada.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nombre", type="string"),
     *             @OA\Property(property="descripcion", type="string"),
     *             @OA\Property(property="precio_unitario", type="number"),
     *             @OA\Property(property="cantidad", type="integer"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Producto creado con éxito",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Producto creado con éxito"),
     *             @OA\Property(
     *                 property="product",
     *                 type="object",
     *                 @OA\Property(property="id", type="number"),
     *                 @OA\Property(property="nombre", type="string"),
     *                 @OA\Property(property="descripcion", type="string"),
     *                 @OA\Property(property="precio_unitario", type="number"),
     *                 @OA\Property(property="cantidad", type="integer"),
     *                 @OA\Property(property="costo_total", type="number"),
     *                 @OA\Property(property="created_at", type="string"),
     *                 @OA\Property(property="updated_at", type="string"),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Error de validación",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Mensaje de error de validación"),
     *         ),
     *     ),
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'descripcion' => 'nullable|string',
            'precio_unitario' => 'required|numeric',
            'cantidad' => 'required|integer',
            'costo_total' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $costoTotal = $request->input('precio_unitario') * $request->input('cantidad');

        $product = Product::create([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'precio_unitario' => $request->input('precio_unitario'),
            'cantidad' => $request->input('cantidad'),
            'costo_total' => $costoTotal,
        ]);

        return response()->json(['message' => 'Producto creado con éxito', 'product' => $product], 201);
    }

  /**
     * Mostrar la información de un cliente
     * @OA\Get (
     *     path="/api/productos/{id}",
     *     tags={"Productos"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *               @OA\Property(
     *                         property="nombre",
     *                         type="string",
     *                         example="Aderson Felix"
     *                     ),
     *                     @OA\Property(
     *                         property="descripcion",
     *                         type="string",
     *                         example="Jara Lazaro"
     *                     ),
     *                     @OA\Property(
     *                         property="precio_unitario",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="cantidad",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="costo_total",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="created_at",
     *                         type="string",
     *                         example="2023-02-23T00:09:16.000000Z"
     *                     ),
     *                     @OA\Property(
     *                         property="updated_at",
     *                         type="string",
     *                         example="2023-02-23T12:33:45.000000Z"
     *                     )
     *         )
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="PRODUCTO NO ENCONTRADO",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Producto no encontrado"),
     *          )
     *      )
     * )
     */
    public function show($id)
    {

        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        return response()->json($product);
    }

 /**
 * @OA\Put(
 *     path="/api/productos/{id}",
 *     tags={"Productos"},
 *     summary="Actualizar un producto existente",
 *     description="Actualiza un producto existente con la información proporcionada.",
 *     @OA\Parameter(
 *         in="path",
 *         name="id",
 *         required=true,
 *         @OA\Schema(type="integer"),
 *         description="ID del producto a actualizar",
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="nombre", type="string"),
 *             @OA\Property(property="descripcion", type="string"),
 *             @OA\Property(property="precio_unitario", type="number"),
 *             @OA\Property(property="cantidad", type="integer"),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Producto actualizado con éxito",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Producto actualizado con éxito"),
 *             @OA\Property(
 *                 property="product",
 *                 type="object",
 *                 @OA\Property(property="id", type="number"),
 *                 @OA\Property(property="nombre", type="string"),
 *                 @OA\Property(property="descripcion", type="string"),
 *                 @OA\Property(property="precio_unitario", type="number"),
 *                 @OA\Property(property="cantidad", type="integer"),
 *                 @OA\Property(property="costo_total", type="number"),
 *                 @OA\Property(property="created_at", type="string"),
 *                 @OA\Property(property="updated_at", type="string"),
 *             ),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Error de validación",
 *         @OA\JsonContent(
 *             @OA\Property(property="error", type="string", example="Mensaje de error de validación"),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="PRODUCTO NO ENCONTRADO",
 *         @OA\JsonContent(
 *             @OA\Property(property="error", type="string", example="Producto no encontrado"),
 *         ),
 *     ),
 * )
 */
    public function update(Request $request, $id)
    {

        // return response()->json($id);
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'descripcion' => 'nullable|string',
            'precio_unitario' => 'required|numeric',
            'cantidad' => 'required|integer',
            'costo_total' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $costoTotal = $request->input('precio_unitario') * $request->input('cantidad');

        $product = Product::findOrFail($id);

        $product->update([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'precio_unitario' => $request->input('precio_unitario'),
            'cantidad' => $request->input('cantidad'),
            'costo_total' => $costoTotal,
        ]);

        return response()->json(['message' => 'Producto actualizado con éxito', 'product' => $product]);
    }

/**
 * Eliminar un producto
 * @OA\Delete (
 *     path="/api/productos/{id}",
 *     tags={"Productos"},
 *     @OA\Parameter(
 *         in="path",
 *         name="id",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Producto eliminado con éxito")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="PRODUCTO NO ENCONTRADO",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Producto no encontrado")
 *         )
 *     )
 * )
 */
public function destroy($id)
{
    $product = Product::find($id);

    if (!$product) {
        return response()->json(['error' => 'Producto no encontrado'], 404);
    }

    $product->delete();

    return response()->json(['message' => 'Producto eliminado con éxito']);
}

}
