@extends('layouts.admin')

@section('titulo')
    <span>
        Categorias
    </span>
    <a class="btn btn-primary btn-circle"
    href="{{ route('categories.create') }}"
    >
        <i class="fas fa-plus"></i>
    </a>
@endsection
@section('contenido')
    <div class="card">
        <div class="card-body">
            {{-- Tabla de categorias --}}
            <table id="dt-categories" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Id</th>
                        <th class="text-center">Nombre de la categoria</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr class="text-center">
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <a
                                href="{{ route('categories.show', $category->id) }}"
                                class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a
                                href="{{ route('categories.edit', $category->id) }}"
                                class="btn btn-warning btn-sm">
                                    <i class="far fa-edit"></i>
                                </a>
                                <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $category->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <form
                                id="delete-form-{{ $category->id }}"
                                method="POST"
                                action="{{ route('categories.destroy', ['category' => $category->id]) }}"
                                style="display: none;">
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
                {{-- {{ $categories->links() }} --}}
            </div>
            {{-- Fin de la tabla de categoryos --}}
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
    function confirmDelete(categoryId) {
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
                document.getElementById(`delete-form-${categoryId}`).submit();
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
