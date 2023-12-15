@extends('layouts.admin')

@section('contenido')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Detalles de la categoria</div>

                    <div class="card-body">
                        <p><strong>Nombre:</strong> {{ $category->name }}</p>
                        {{-- Puedes agregar más detalles según tus necesidades --}}

                        <a href="{{ route('categories.edit', ['category' => $category->id]) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form method="POST" action="{{ route('categories.destroy', ['category' => $category->id]) }}" style="display:inline;">
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
