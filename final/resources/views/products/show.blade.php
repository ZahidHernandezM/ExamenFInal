@extends('layouts.admin')

@section('contenido')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Detalles del Producto</div>

                    <div class="card-body">
                        <p><strong>Nombre:</strong> {{ $product->nombre }}</p>
                        <p><strong>Descripción:</strong> {{ $product->descripcion }}</p>
                        <p><strong>Precio Unitario:</strong> ${{ $product->precio_unitario }}</p>
                        <p><strong>Cantidad:</strong> {{ $product->cantidad }}</p>
                        <p><strong>Costo Total:</strong> ${{ $product->costo_total }}</p>

                        {{-- Puedes agregar más detalles según tus necesidades --}}

                        <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form method="POST" action="{{ route('products.destroy', ['product' => $product->id]) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
