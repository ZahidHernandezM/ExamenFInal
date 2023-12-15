<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $categories = Category::all();
        return view('categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          // Valida los datos del formulario
        $request->validate([
            'name' => 'required|string',
        ]);


        // Crea un nuevo producto en la base de datos
        $category = Category::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('categories.index')->with('success', 'Producto creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('categories.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
         // Valida los datos del formulario
        $request->validate([
            'name' => 'required|string',
        ]);


        // Actualiza el producto en la base de datos
        $category->update([
            'name' => $request->input('name'),
        ]);

        // Redirecciona a la vista de detalles del producto actualizado
        return redirect()->route('categories.index')->with('success', 'Producto actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
             // Elimina el producto de la base de datos
             $category->delete();
             // Redirecciona a la lista de productos
             return redirect()->route('categories.index');
    }
}
