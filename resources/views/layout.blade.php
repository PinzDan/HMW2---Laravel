<!DOCTYPE html>
<html lang="en">


@php
    $user_id = session('user_id');
    $google_id = session('google_loggedin');
@endphp

<script>
    let logged = @json($user_id !== null || $google_id !== null);
</script>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="{{ asset('assets/js/get_film.js') }}" defer></script>
    <title>@yield('title', 'Home')</title>
    <script>var currentPage = '';</script>
</head>

<body>
    @include('navbar')

    <div class="content">
        @yield('content')
    </div>

    @include('footer')
</body>

</html>