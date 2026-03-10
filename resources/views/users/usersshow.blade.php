@extends('layout.layoutgeneral')

@section('titulo', 'Usuarios')


@section('cuerpo')
    <div class="container pt-4">
        <a href="{{ route('user.index') }}" class="btn btn-outline-primary"><i class="bi bi-arrow-left-square"></i> Regresar</a>
    </div>
    <div class="container text-center py-4 col-9 pt-5">
        <div class="container bg-primary text-white">
            <h3 class="">Usuario</h3>
        </div>
        <form name="formulario" class="pt-4" action="{{ route('user.update', $usuario->id) }}" method="POST">
            @csrf

            {{-- formulario para la actualización de datos de usuario --}}
            <div class="form-group" id="enviar">

                <div class="input-group">

                    {{-- Campo para actualiar o modificar el nombre de usuario --}}
                    <div class="input-group mb-3">
                        <label for="usuario" class="input-group-text col-2 fw-bolder">Usuario</label>
                        <input type="text" name="user" id="usuario" value="{{ $usuario->usuario }}"
                            class="form-control" placeholder="Usuario" readonly>
                        @error('user')
                            <div class="alert alert-danger  alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror
                    </div>

                    {{-- El nombre real del usuario --}}
                    <div class="input-group mb-3">
                        <label for="nombre" class="input-group-text col-2 fw-bolder">Nombre</label>
                        <input type="text" name="nombre" id="nombre" value="{{ $usuario->unombre }}"
                            class="form-control" placeholder="Nombre">
                        @error('nombre')
                            <div class="alert alert-danger  alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror
                    </div>

                    {{-- Apellidos del usuario --}}
                    <div class="input-group mb-3">
                        <label for="last" class="input-group-text col-2 fw-bolder">Apellidos</label>
                        <input type="text" name="apellido" id="last" value="{{ $usuario->apellido }}"
                            class="form-control" placeholder="Apellidos">
                        @error('apellido')
                            <div class="alert alert-danger  alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror
                    </div>

                    {{-- El rol dentro del sistema --}}
                    <div class="input-group mb-3">
                        <label for="usertec" class="input-group-text col-2 fw-bolder">Rol</label>
                        <select class="form-select" id="usertec" name="tecnico">
                            <option selected value="{{ $usuario->roleName }}">{{ $usuario->roleName }}</option>
                            @foreach ($roles as $rol)
                                <option value="{{ $rol->name }}">{{ $rol->name }}</option>
                            @endforeach
                        </select>
                        @error('tecnico')
                            <div class="alert alert-danger  alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror
                    </div>
                </div>

                {{-- Cambio de contraseña --}}

                <div class="input-group mb-3">
                    <label for="password" class="input-group-text col-2 fw-bolder">Contraseña</label>
                    <!--maxlength="5"-->
                        <input type="password" name="password" value="{{ old('password') }}" id="password"
                            class="form-control password-field" placeholder="Contraseña" aria-label="Password"
                            aria-describedby="show-password" value="{{ old('password') }}">
                        <button class="btn btn-outline-primary" type="button" id="show-password" data-bs-toggle="password"
                            data-bs-target="#password"><i class="bi bi-eye-slash"></i><i class="bi bi-eye d-none"></i>
                        </button>

                </div>
                {{-- Confirmación de la contraseña nueva --}}
                <div class="input-group mb-3">
                    <label for="password_confirmation" class="input-group-text col-2 fw-bolder">Confirmar
                        Contraseña</label>
                    <!--maxlength="5"-->
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="form-control password-field" placeholder="Confirmar Contraseña" aria-label="Password"
                            aria-describedby="show-password" value="{{ old('password_confirmation') }}">

                </div>
                @error('password')
                    <div class="alert alert-danger  alert-dismissible fade show" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror

            </div>
            @can('admin.user.update')
                <div class="container text-center">
                    <button type="submit" class="btn btn-outline-primary"><i class="bi bi-save"></i> Guardar</button>
                    <div class="container pt-3">
                        @if (session('info'))
                            <div class="alert alert-success">
                                <strong>
                                    {{ session('info') }}
                                </strong>
                            </div>
                        @endif
                    </div>
                </div>
            @endcan
        </form>
    </div>
@endsection

@section('script')
    <script>
        const togglePassword = document.querySelector('#show-password');
        const passwordFields = document.querySelectorAll('.password-field');
        togglePassword.addEventListener('click', function(e) {
            // toggle the type attribute for each password field
            passwordFields.forEach(function(field) {
                const type = field.getAttribute('type') === 'password' ? 'text' : 'password';
                field.setAttribute('type', type);
            });

            // toggle the eye / eye slash icon
            const eyeIcon = togglePassword.querySelector('.bi-eye');
            const eyeSlashIcon = togglePassword.querySelector('.bi-eye-slash');

            eyeIcon.classList.toggle('d-none');
            eyeSlashIcon.classList.toggle('d-none');
        });
    </script>
@endsection
