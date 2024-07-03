<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="{{ asset('assets/js/get_film.js') }}" defer></script>
    <title>@yield('title', 'Home')</title>
    <script>let currentPage = '';</script>
</head>

<body>
    @include('navbar')


    <img class="frankie" src="{{ asset('assets/Images/frankesinstein.png') }}">
    @yield('content')


    @include('footer')
</body>

</html>