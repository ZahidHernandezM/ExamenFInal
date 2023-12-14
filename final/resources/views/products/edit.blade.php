@extends('layouts.admin')

@section('contenido')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Editar Producto</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('products.update', ['product' => $product->id]) }}">
                            @csrf
                            @method('PUT') {{-- Esto es necesario para indicar que se usará el método PUT en el formulario --}}

                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre', $product->nombre) }}" required>
                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="descripcion">Descripción:</label>
                                <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="3">{{ old('descripcion', $product->descripcion) }}</textarea>
                                @error('descripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="precio_unitario">Precio Unitario:</label>
                                <input type="number" class="form-control @error('precio_unitario') is-invalid @enderror" id="precio_unitario" name="precio_unitario" value="{{ old('precio_unitario', $product->precio_unitario) }}" required>
                                @error('precio_unitario')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cantidad">Cantidad:</label>
                                <input type="number" class="form-control @error('cantidad') is-invalid @enderror" id="cantidad" name="cantidad" value="{{ old('cantidad', $product->cantidad) }}" required>
                                @error('cantidad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="costo_total">Costo Total:</label>
                                <input type="number" class="form-control" id="costo_total" name="costo_total" value="{{ old('costo_total', $product->costo_total) }}" readonly>
                            </div>

                            <button type="submit" class="btn btn-primary btn-sm">Actualizar Producto</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
