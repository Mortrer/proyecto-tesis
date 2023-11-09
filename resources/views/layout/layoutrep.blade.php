<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('js/app.js') }}">
    <script language="javascript" type="text/javascript">
        function limitText(limitField, limitNum) {
            function maxLengthCheck(object) {
                if (object.value.length > object.maxLength)
                    object.value = object.value.slice(0, object.maxLength)
            }
        }
    </script>
    <title>@yield('titulor')</title>
</head>

<body>
    @include('nav.headernav')
    @yield('cuerpor')
</body>

</html>
