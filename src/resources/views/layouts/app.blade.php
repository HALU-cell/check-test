<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Serif:wght@100;400&display=swap" rel="stylesheet">
    @yield('css')
    @livewireStyles
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <a href="" class="header__logo">
                FashionablyLate
            </a>
        </div>
        @yield('header')
    </header>

    <main>
        @yield('content')
    </main>
    @livewireScripts
</body>
</html>
