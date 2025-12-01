<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description" content="Aplikasi pengelolaan zakat dan distribusi oleh Baznas Kabupaten Cirebon" />
    
    <link href="{{ url('../solatec/assets/images/favicon/favicon.ico') }}" rel="icon">

    <title>Baznas Kabupaten Cirebon - Pengelolaan Zakat dan distribusi</title>

    {{-- STYLE BAWAAN --}}
    @include('includes.frontend.style')

    {{-- WAJIB: LOAD VITE (CSS & JS) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
