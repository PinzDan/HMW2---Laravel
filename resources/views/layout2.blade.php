<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
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