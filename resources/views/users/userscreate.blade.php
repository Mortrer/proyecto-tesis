@extends('layout.layoutgeneral')

@section('titulo', 'Creación de usuarios')

@section('cuerpo')
    <div class="container text-center py-4 col-8 pt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title">Creación de Usuarios</h4>
            </div>
            <div class="card-body">
                <form name="formulario" class="pt-4" action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <div class="form-group" id="enviar">

                        <div class="input-group mb-3">
                            <label class="input-group-text col-2 fw-bolder" for="usuario">Usuario</label>
                            <!--maxlength="5"-->
                                <input type="text" name="user" id="usuario" value="{{ old('user') }}"
                                    class="form-control" placeholder="Usuario">

                        </div>
                        @error('user')
                            <div class="alert alert-danger  alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror
                        <div class="input-group mb-3">
                            <label class="input-group-text col-2 fw-bolder" for="nombre">Nombre</label>
                            <!--maxlength="5"-->
                                <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}"
                                    class="form-control" placeholder="Nombre">
                        </div>
                        @error('nombre')
                            <div class="alert alert-danger  alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror
                        <div class="input-group mb-3">
                            <label class="input-group-text col-2 fw-bolder" for="last">Apellidos</label>
                            <!--maxlength="5"-->
                                <input type="text" name="apellido" id="last" value="{{ old('apellido') }}"
                                    class="form-control" placeholder="Apellidos">

                        </div>

                        @error('apellido')
                            <div class="alert alert-danger  alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror
                        <div class="input-group mb-3">
                            <label class="input-group-text col-2 fw-bolder" for="usertec">Rol</label>
                            <select class="form-select" id="rol" name="rol">
                                <option selected value="">Seleccionar...</option>
                                @foreach ($roles as $rol)
                                    <option value="{{ $rol->name }}">{{ $rol->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('rol')
                            <div class="alert alert-danger  alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror
                        <div class="input-group mb-3">
                            <label class="input-group-text col-2 fw-bolder" for="password">Contraseña</label>
                            <!--maxlength="5"-->
                                <input type="password" name="password" value="{{ old('password') }}" id="password"
                                    class="form-control password-field" placeholder="Contraseña">
                                <button class="btn btn-outline-primary" type="button" id="show-password"
                                    data-bs-toggle="password" data-bs-target="#password"><i class="bi bi-eye-slash"></i><i
                                        class="bi bi-eye d-none"></i>
                                </button>

                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text col-2.5 fw-bolder" for="password_confirmation">Confirmar
                                Contraseña</label>
                            <!--maxlength="5"-->
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control password-field" placeholder="Confirmar Contraseña">
                        </div>
                        @error('password')
                            <div class="alert alert-danger  alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @enderror
                    </div>
                    @can('admin.user.create')
                        <div class="container text-center">
                            <button type="submit" class="btn btn-outline-primary"><i class="bi bi-person-add"
                                    style="font-size:1rem;"></i> Crear</button>
                        </div>
                    @endcan
                </form>
            </div>
            <div class="card-footer">
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
        </div>


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
