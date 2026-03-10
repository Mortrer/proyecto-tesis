@extends('layout.layoutgeneral')

@section('titulo', 'Cliente')

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

@section('cuerpo')
    <div class="container text-center py-4 col-8 pt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title">Datos del Cliente</h4>
            </div>
            <div class="card-body">

                <form action="{{ route('cliente.store') }}" method="POST">
                    @csrf
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session('error') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="input-group mb-3">
                        <span class="input-group-text col-3 fw-bolder">Número de DPI</span>
                        <input type="text" name="cui" id="cui" class="form-control" value="{{ old('cui') }}"
                            placeholder="Número de CUI (DPI)">
                        {{-- <button type="button" id="vdpi" class="btn btn-outline-primary">Validar DPI</button> --}}
                    </div>
                    @error('cui')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror
                    {{-- Numero de nit --}}
                    <div class="input-group mb-3">
                        <span class="input-group-text col-3 fw-bolder">Número de NIT</span>
                        <input type="text" name="nit" id="nit" class="form-control" value="{{ old('nit') }}"
                            placeholder="Número de NIT">
                        {{-- <button type="button" id="vnit" class="btn btn-outline-primary">Validar NIT</button> --}}
                    </div>
                    @error('nit')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror
                    <!-- Nombres y apellidos -->
                    <div class="input-group mb-3">
                        <span class="input-group-text col-3 fw-bolder">Nombres</span>
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombres"
                            value="{{ old('nombre') }}">
                    </div>
                    @error('nombre')
                        <div class="alert alert-danger  alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror
                    <div class="input-group mb-3">
                        <span class="input-group-text col-3 fw-bolder">Apellidos</span>
                        <input type="text" name="apellido" id="apellidos" class="form-control" placeholder="Apellidos"
                            value="{{ old('apellido') }}">
                    </div>
                    @error('apellido')
                        <div class="alert alert-danger  alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror
                    {{-- Numero de correo --}}
                    <div class="input-group mb-3">
                        <span class="input-group-text col-3 fw-bolder">Correo Electrónico</span>
                        <input type="email" name="correo" id="correo" class="form-control"
                            value="{{ old('correo') }}" placeholder="Correo electrónico">
                    </div>
                    @error('correo')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror
                    <!-- Celular -->
                    <div class="input-group mb-3">
                        <span class="input-group-text col-3 fw-bolder">Número de celular</span>
                        <input type="text" name="celular" id="ncelular" class="form-control"
                            placeholder="No. celular o télefono" value="{{ old('celular') }}">
                    </div>
                    @error('celular')
                        <div class="alert alert-danger  alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror
                    @can('order.cliente.create')
                        <div class="text-center">
                            <button type="submit" class="btn btn-outline-primary" id="envio"><i class="bi bi-save"></i>
                                Registrar</button>
                            <button type="button" class="btn btn-outline-primary" id="limpiar"><i
                                    class="bi bi-eraser"></i>
                                Limpiar Campos</button>
                        </div>
                    @endcan
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        window.addEventListener('load', function() {
            var cliente = document.getElementById('cui');
            var nitInput = document.getElementById('nit');
            var envioButton = document.getElementById('envio');



            cliente.addEventListener('keyup', () => {
                if ((cliente.value.length) >= 13) {
                    var parametro = {
                        cui: cliente.value
                    }
                    axios.get("{{ route('customer.busqueda') }}", {
                            params: parametro
                        })
                        .then(response => {
                            if (response.data == "") {
                                // document.getElementById("nit").value = '';
                                document.getElementById("correo").value = '';
                                document.getElementById("nombre").value = '';
                                document.getElementById("apellidos").value = '';
                                document.getElementById("ncelular").value = '';
                                envioButton.innerHTML = '<i class="bi bi-save"></i> Registrar';
                            }
                            Object.keys(response.data).forEach(function(key) {
                                // document.getElementById("nit").value = response.data[key].nit;
                                document.getElementById("nombre").value = response.data[key]
                                    .nombre;
                                document.getElementById("correo").value = response.data[key]
                                    .correo;
                                document.getElementById("apellidos").value = response.data[key]
                                    .apellidos;
                                document.getElementById("ncelular").value = response.data[key]
                                    .ncelular;
                                envioButton.innerHTML =
                                    '<i class="bi bi-arrow-right-square"></i> Siguiente';
                            });
                        })
                }
            })

            nitInput.addEventListener('keyup', () => {
                if ((nitInput.value.length) >= 8) {
                    var parametro = {
                        nit: nitInput.value
                    }
                    axios.get("{{ route('customer.busqueda') }}", {
                            params: parametro
                        })
                        .then(response => {
                            if (response.data == "") {
                                document.getElementById("correo").value = '';
                                document.getElementById("nombre").value = '';
                                document.getElementById("apellidos").value = '';
                                document.getElementById("ncelular").value = '';
                                envioButton.innerHTML = '<i class="bi bi-save"></i> Registrar';
                            }
                            Object.keys(response.data).forEach(function(key) {
                                // document.getElementById("cui").value = response.data[key].cui;
                                document.getElementById("nombre").value = response.data[key]
                                    .nombre;
                                document.getElementById("correo").value = response.data[key]
                                    .correo;
                                document.getElementById("apellidos").value = response.data[key]
                                    .apellidos;
                                document.getElementById("ncelular").value = response.data[key]
                                    .ncelular;
                                envioButton.innerHTML =
                                    '<i class="bi bi-arrow-right-square"></i> Siguiente';
                            });
                        })
                }
            })



            document.getElementById('limpiar').addEventListener('click', function() {
                document.getElementById('nit').value = ''; // Limpiar campo de nombre
                document.getElementById('cui').value = ''; // Limpiar campo de apellido
                document.getElementById('nombre').value = ''; // Limpiar campo de apellido
                document.getElementById('apellidos').value = ''; // Limpiar campo de apellido
                document.getElementById('ncelular').value = ''; // Limpiar campo de apellido
                document.getElementById('correo').value = ''; // Limpiar campo de apellido
            });
        })
    </script>
@endsection
