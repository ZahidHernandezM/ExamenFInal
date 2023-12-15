@extends('layouts.admin')

@section('contenido')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Editar Categoria</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('categories.update', ['category' => $category->id]) }}">
                            @csrf
                            @method('PUT') {{-- Esto es necesario para indicar que se usará el método PUT en el formulario --}}

                            <div class="form-group">
                                <label for="name">Nombre:</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $category->name) }}" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Actualizar Categoria</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
