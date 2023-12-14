@extends('layouts.admin')

@section('contenido')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Crear Producto</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('products.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="descripcion">Descripción:</label>
                                <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="3">{{ old('descripcion') }}</textarea>
                                @error('descripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="precio_unitario">Precio Unitario:</label>
                                <input type="number" class="form-control @error('precio_unitario') is-invalid @enderror" id="precio_unitario" name="precio_unitario" value="{{ old('precio_unitario') }}" required>
                                @error('precio_unitario')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cantidad">Cantidad:</label>
                                <input type="number" class="form-control @error('cantidad') is-invalid @enderror" id="cantidad" name="cantidad" value="{{ old('cantidad') }}" required>
                                @error('cantidad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="costo_total">Costo Total:</label>
                                <input type="number" class="form-control" id="costo_total" name="costo_total" value="{{ old('costo_total') }}" readonly>
                                @error('costo_total')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-sm">Guardar Producto</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
