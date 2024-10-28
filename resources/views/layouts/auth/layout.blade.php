<html lang="pt-br">

<head>
    <meta charSet="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@4.4.0/fonts/remixicon.min.css" />





    <link href="{{ asset('vendor/bladewind/css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('vendor/bladewind/js/helpers.js') }}"></script>
    <script src="//unpkg.com/alpinejs" defer></script>



    @yield('css')
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

</head>

<body class="h-max">
    @yield('content')
    @include('components.floatbar')
</body>
<script src="{{asset('js/libs/jquery/main.js')}}"></script>
<script src="{{asset('js/libs/jquerymask/main.js')}}"></script>
@yield('js')


</html>
