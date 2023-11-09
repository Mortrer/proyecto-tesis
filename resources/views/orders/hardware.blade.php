@extends('layout.layoutgeneral')
{{-- <script>
    Contenido.style.display = "";
    Contenido.style.display = "none";
    if (window.history.replaceState) { // verificamos disponibilidad
        window.history.replaceState(null, null, window.location.href);
    }
</script> --}}
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

@section('titulo', 'Hardware')

@section('cuerpo')
    <div class="container text-center py-4 col-8 pt-5">
        {{-- {{$dpi}} --}}
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="text-center">Hardware</h4>
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <form action="{{ route('hardware.create') }}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <label class="input-group-text col-2 fw-bolder">CUI (DPI)</label>
                            <input type="text" name="cliente" id="client" class="form-control" value="{{ $dpi }}" readonly>
                            <label for="" class="input-group-text col-2 fw-bolder">NIT</label>
                            <input type="text" name="nit" id="nit" class="form-control" value="{{ $nit }}" readonly>
                        </div>
                        @error('cliente')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror
                        <div class="input-group mb-3">
                            <label class="input-group-text col-2 fw-bolder">Serial</label>
                            <input type="text" name="serial" id="serial" class="form-control" placeholder="Serial" value="{{ old('serial') }}">
                        </div>
                        @error('serial')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror
                        <!-- marca -->
                        <div class="input-group mb-3">
                            <label class="input-group-text col-2 fw-bolder">Marca</label>
                            <input type="text" name="marca" id="marca" class="form-control" placeholder="Marca" value="{{ old('marca') }}">
                        </div>
                        @error('marca')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror
                        <div class="input-group mb-3 pb-4">
                            <label class="input-group-text col-2 fw-bolder">Modelo</label>
                            <input type="text" name="modelo" id="modelo" class="form-control" placeholder="Modelo" value="{{ old('modelo') }}">
                        </div>
                        @error('modelo')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror

                        <div class="input-group mb-3 pb-2">
                            <label for="" class="input-group-text col-3 fw-bolder">Tipo de Dispositivo</label>
                            <input type="text" name="tipo" id="tipo" class="form-control" placeholder="Tipo de dispositivo: Celular, laptop, etc." value="{{ old('tipo') }}">
                        </div>
                        @error('tipo')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror
                        <!-- detalles del hardware -->
                        <div class="input-group mb-3 pt-1">
                            <span class="input-group-text col-3 fw-bolder">Observaciones</span>
                            <textarea class="form-control" aria-label="With textarea" name="detalles" id="detalles"
                                placeholder="Descripción detallada del hardware, por cada actualizacón en la entrada agregar una ','">{{ old('detalles') }}</textarea>
                        </div>
                        @error('detalles')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror
                        @can('order.hardware.create')
                            <div class="text-center">
                                <button type="submit" class="btn btn-outline-primary"><i class="bi bi-save"></i> Registrar</button>
                            </div>
                        @endcan
                    </form>
                </blockquote>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('load', function() {
            var hardware = document.getElementById('serial');
            hardware.addEventListener('keyup', function() {
                if ((hardware.value.length) >= 1) {
                    var parametro = {
                        serial: hardware.value
                    }
                    axios.get("{{ route('hardware.busqueda') }}", {
                            params: parametro
                        })
                        .then(response => {
                            if (response.data.length === "") {
                                document.getElementById("marca").value = '';
                                document.getElementById("modelo").value = '';
                                document.getElementById("tipo").value = '';
                                document.getElementById("detalles").value = '';
                            } else {
                                Object.keys(response.data).forEach(function(key) {
                                    document.getElementById("marca").value = response.data[key].marca;
                                    document.getElementById("modelo").value = response.data[key].modelo;
                                    document.getElementById("tipo").value = response.data[key].tipo;
                                    document.getElementById("detalles").value = response.data[key].h_detalles;
                                });
                            }
                        })
                }
            })
        })
    </script>
@endsection
