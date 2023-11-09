@extends('layout.layoutgeneral')

@section('titulo', 'Creación de Rol para usuario')


@section('cuerpo')
    <div class="container pb-4 pt-3">
        <a href="{{ route('role.index') }}" class="btn btn-outline-primary"><i class="bi bi-arrow-left-square"></i> Regresar</a>
    </div>
    <div class="container col-7">
        <div class="container">
            @if (session('info'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('info') }}.</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('info2'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session('info2') }}.</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        <div class="card">
            <div class="card-header text-center bg-primary text-white">
                <h3 class="">Creación de Rol</h3>
            </div>
            <div class="card-body">
                <form name="formulario" action="{{ route('rol.store') }}" method="POST">
                    @csrf
                    <div class="form-group" id="envi">
                        <div class="input-group">
                            <div class="input-group mb-3">
                                <span class="input-group-text col-3 fw-bolder" id="name">Nombre</span>
                                <!--maxlength="5"-->
                                    <input type="text" name="name" id="nombre" class="form-control"
                                        placeholder="Nombre">
                            </div>
                            @foreach ($permisos as $permiso)
                                <label class="list-group-item form-check fw-bolder">
                                    <input type="checkbox" name="permisos[{{ $permiso->name }}]" value="{{ $permiso->id }}"
                                        class="form-check-input">
                                    {{ $permiso->description }}
                                </label>
                                {{-- <div class="form-check form-check-inline d-flex flex-row">
                                    <input class="form-check-input" type="checkbox" id="permiso"
                                        value="{{ $permiso->id }}" name="permisos[{{ $permiso->name }}]">
                                    <label class="form-check-label fw-bolder"
                                        for="inlineCheckbox1">{{ $permiso->name }}</label>
                                </div> --}}
                            @endforeach
                        </div>
                        <br>
                    </div>
                    @can('role.create')
                        <div class="container text-center pt-3">
                            <button type="submit" class="btn btn-outline-primary"><i class="bi bi-plus-circle"></i> Crear</button>
                        </div>
                    @endcan
                </form>
            </div>
        </div>
    </div>
@endsection
