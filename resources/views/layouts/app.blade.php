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

    <style>
        *{
            padding: 0;
            margin: 0;
        }

        body{
            width: 100%;
            color: white;
            background: url('./images/backgroundimg.png') repeat-y center center fixed;
            background-size: cover;
            background-attachment: fixed;
            background-color: rgba(0,0,0,.8);
            background-blend-mode: darken;
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
        
        
    </style>
    
    <script>
        document.body.addEventListener('click', (e) => {
        
            let hidingBlock = document.querySelector('#searchBox');
            hidingBlock.style.display = 'none';
            document.getElementById('btnShowSearch').style.display = "";
        });
    </script>
</head>
<body>
    <div id="app">

        <header-comp></header-comp>

        <main class="py-4">
            @yield('content')
        </main>

        <footer-comp></footer-comp>

    </div>
</body>
</html>
