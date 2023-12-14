@extends('layouts.admin')

@section('titulo')
    <span>
        Productos
    </span>
    <a class="btn btn-primary btn-circle"  href="{{ route('products.create') }}">
        <i class="fas fa-plus"></i>
    </a>
@endsection
@section('contenido')
    <div class="card">
        <div class="card-body">
            {{-- Tabla de productos --}}
            <table id="dt-products" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Descripcion</th>
                        <th class="text-center">Precio Unitario</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Costo total</th>
                        <th class="text-center">Categoria</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr class="text-center">
                            <td>{{ $product->nombre }}</td>
                            <td>{{ $product->descripcion }}</td>
                            <td>$ {{ $product->precio_unitario }}</td>
                            <td>{{ $product->cantidad }}</td>
                            <td>$ {{ $product->costo_total }}</td>
                            <td>
                                @foreach ($product->categories as $category)
                                    {{ $category->name }}
                                    @if (!$loop->last)
                                        , <!-- Agregar una coma entre las categorías, excepto la última -->
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">
                                    <i class="far fa-edit"></i>
                                </a>
                                <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $product->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <form id="delete-form-{{ $product->id }}" method="POST" action="{{ route('products.destroy', ['product' => $product->id]) }}" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                    <tr class="text-center">
                        <td colspan="6">No hay registros</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="pagination ">
                {{ $products->links() }}
            </div>
            {{-- Fin de la tabla de productos --}}
        </div>
    </div>

    {{-- Fin de los modales de actualizar y eliminar  --}}
@endsection


@push('styles')
    <link rel="stylesheet" href="{{ asset('libs/dataTables/datatables.bootstrap4.min.css') }}">
@endpush
@push('scripts')


<script>
    // Función para mostrar una alerta de confirmación antes de eliminar
    function confirmDelete(productId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Esta acción no se puede deshacer.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminarlo',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                // Envía el formulario para eliminar
                document.getElementById(`delete-form-${productId}`).submit();
            }
        });
    }
</script>
<script>
    // Función para mostrar una alerta de éxito
    function showSuccessAlert(message) {
        Swal.fire({
            title: 'Éxito',
            text: message,
            icon: 'success',
            confirmButtonColor: '#28a745',
        });
    }

    // Verifica si hay un mensaje de éxito y muestra la alerta
    @if(session('success'))
        showSuccessAlert('{{ session('success') }}');
    @endif
</script>
@endpush
