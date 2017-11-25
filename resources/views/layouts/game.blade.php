<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/css/bootstrap-slider.min.css" rel="stylesheet">
    
</head>
<body>
    <div>

        <div class="game-pane col-xs-12 col-sm-12 col-md-6 shadow"
        style="z-index: 1; background: url('http://nuevoostendehotel.com.ar/wp-content/uploads/2015/12/Mardelplata-3.jpg')">
            @yield('first_pane')
        </div>

        <div class="game-pane col-xs-12 col-sm-12 col-md-6"
        style="background: #eceff1 ">
        <div class="container">
            <h2>Respuesta</h2>
            @yield('second_pane')
            </div>

        </div>

        @yield('modal')

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/bootstrap-slider.min.js"></script>
    @yield('js')
</body>
</html>
