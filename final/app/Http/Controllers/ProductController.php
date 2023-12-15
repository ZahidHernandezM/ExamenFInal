<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

use RealRashid\SweetAlert\Facades\Alert as FacadesAlert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::with('categories')->paginate(5);
        return view('products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Este método procesará la creación de un nuevo producto

        // Valida los datos del formulario
        $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'nullable|string',
            'precio_unitario' => 'required|numeric',
            'cantidad' => 'required|integer',
            'costo_total' => 'nullable|numeric', // No es necesario validarlo aquí
        ]);

         // Calcula el costo total multiplicando el precio unitario por la cantidad
         $costoTotal = $request->input('precio_unitario') * $request->input('cantidad');

        // Crea un nuevo producto en la base de datos
        $product = Product::create([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'precio_unitario' => $request->input('precio_unitario'),
            'cantidad' => $request->input('cantidad'),
            'costo_total' => $costoTotal, // Establece el costo total calculado
        ]);

        return redirect()->route('products.index')->with('success', 'Producto creado con éxito.');
    }


    public function show(Product $product)
    {
        return view('products.show', ['product' => $product]);
    }

    public function edit(Product $product)
    {
        return view('products.edit', ['product' => $product]);
    }

    public function update(Request $request, Product $product)
    {
        // Valida los datos del formulario
        $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'nullable|string',
            'precio_unitario' => 'required|numeric',
            'cantidad' => 'required|integer',
            'costo_total' => 'nullable|numeric', // No es necesario validarlo aquí
        ]);

        // Calcula el costo total multiplicando el precio unitario por la cantidad
        $costoTotal = $request->input('precio_unitario') * $request->input('cantidad');

        // Actualiza el producto en la base de datos
        $product->update([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'precio_unitario' => $request->input('precio_unitario'),
            'cantidad' => $request->input('cantidad'),
            'costo_total' => $costoTotal, // Establece el costo total calculado
        ]);

        // Redirecciona a la vista de detalles del producto actualizado
        return redirect()->route('products.index')->with('success', 'Producto actualizado con éxito.');
    }

    public function destroy(Product $product)
    {
        // Elimina el producto de la base de datos
        $product->delete();

        // Redirecciona a la lista de productos
        return redirect()->route('products.index');
    }
}
