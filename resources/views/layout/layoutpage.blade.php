<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{ mix('js/app.js') }}"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/multi.css') }}" rel="stylesheet">
    <link href="{{ asset('css/stepbar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navega.css') }}" rel="stylesheet">
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script> --}}
    <!--fin script -->
    <title>@yield('titulo')</title>
</head>

<body>
    <div class="main-container d-flex">
        <div id="app" class="col-12">
            <nav id="navbar">
                <ul>
                    <li><a href="" class="active">Consulta</a></li>
                    <li><a href="">Contact Me</a></li>
                </ul>
            </nav>
            <div class="contenido text-center col-12 overflow-auto" style="max-height: 700px; max-width: 100%">
                @yield('cuerpo')

            </div>

        </div>
    </div>
    </div>
    @yield('script')
</body>

</html>
