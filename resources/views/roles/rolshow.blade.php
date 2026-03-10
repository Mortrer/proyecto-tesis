@extends('layout.layoutgeneral')

@section('titulo', 'Edital Rol')

@section('cuerpo')
    <div class="container pb-5 pt-3">
        <a href="{{ route('role.index') }}" class="btn btn-outline-primary"><i class="bi bi-arrow-left-square"></i> Regresar</a>
    </div>
    <div class="container text-center col-7">
        <div class="container">
            @if (session('info3'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('info3') }}.</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3>Editar Rol</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('role.update') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="input-group">

                            <div class="input-group mb-3">
                                <span class="input-group-text fw-bolder col-3" id="name">Nombre</span>
                                <input type="text" name="nombre" id="nombre" class="form-control"
                                    placeholder="Nombre" value="{{ $rol->name }}">
                            </div>

                            @foreach ($permisos as $permiso)
                                <label class="list-group-item form-check fw-bolder">
                                    <input type="checkbox" name="permisos[{{ $permiso->name }}]" value="{{ $permiso->id }}"
                                        class="form-check-input" id="permissions_{{ $permiso->id }}"
                                        {{ $permisionAsigned->contains($permiso) ? 'checked' : '' }}>
                                    {{ $permiso->description }}
                                </label>
                                {{-- <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="almacenamiento"
                                        value="{{ $permiso->id }}" name="permisos[{{ $permiso->name }}]"
                                        id="permission_{{ $permiso->id }}"
                                        {{ $permisionAsigned->contains($permiso) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bolder"
                                        for="inlineCheckbox1">{{ $permiso->name }}</label>
                                </div> --}}
                            @endforeach
                            @can('role.update')
                                <div class="container pt-3">
                                    <button type="submit" class="btn btn-outline-primary"><i class="bi bi-save"></i>
                                        Guardar</button>
                                </div>
                            @endcan
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                @if (session('info'))
                    <div class="alert alert-success">
                        {{ session('info') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
