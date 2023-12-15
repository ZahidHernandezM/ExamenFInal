@extends('layouts.admin')

@section('titulo', 'Opciones')

@section('contenido')

    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Productos</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <a class="stretched-link text-success" href="{{route('products.index')}}">
                                Continuar
                                </a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-boxes"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
          <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Categorias</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <a class="stretched-link text-success" href="{{route('categories.index')}}">
                                    Continuar
                                </a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-boxes"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
