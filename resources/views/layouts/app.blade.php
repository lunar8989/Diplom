<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="robots" content="none">

    <title>Дай лапу</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.15/lodash.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://use.fontawesome.com/8a5c976de3.js"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Swiper -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.min.css">
    <script src="https://unpkg.com/swiper/js/swiper.js"></script>
    <script src="https://unpkg.com/swiper/js/swiper.min.js"></script>
    
    <!-- maps -->
    <script src="https://api-maps.yandex.ru/2.1/?apikey=81851459-6c5c-4319-b440-ac23aa0f8004&lang=ru_RU" type="text/javascript"> </script>
    
    
    <style>
        *{
            padding: 0;
            margin: 0;
        }

        .py-4{
            min-height: 84.6vh;
        }

        .page-item.active .page-link {
            background-color: #FF6200 !important;
            color: white !important;
        }

        .page-link {
            color: #FF6200 !important;
        }

        .dropdown-toggle{
            height: 50px !important;
        }

        .bootstrap-select{
            padding: 0 !important;
        }

        .btn-lg{
            padding: 6px 12px;
        }

        .btn-warning{
            background: yellow;
            border: 1px solid black;
            border-radius: 10px;
            width: 100%;
            padding: 0 !important;
        }

        .dropdown-menu{
            min-width: 20rem;
        }
        
        
    </style>
</head>
<body>
    <div id="app">

        <keep-alive>
            <header-comp></header-comp>
        </keep-alive>
        

        <main class="py-4">
            @yield('content')
        </main>

        
        <footer-comp></footer-comp>
        
    </div>
</body>
</html>
