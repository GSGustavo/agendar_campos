<html lang="pt-br" class="transition-all duration-100">

<head>
    <meta charSet="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Agendar Campos</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@4.4.0/fonts/remixicon.min.css" />

    {{-- @yield('css') --}}
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    @inertiaHead
    <link rel="stylesheet" href="https://unpkg.com/@vuepic/vue-datepicker@latest/dist/main.css">
</head>

<body>
    @inertia
</body>
{{-- <script src="{{ asset('js/libs/jquery/main.js') }}"></script>
<script src="{{ asset('js/libs/jquerymask/main.js') }}"></script> --}}
{{-- @yield('js') --}}
{{-- <script src="https://unpkg.com/vue@latest"></script>
<script src="https://unpkg.com/@vuepic/vue-datepicker@latest"></script> --}}

</html>
