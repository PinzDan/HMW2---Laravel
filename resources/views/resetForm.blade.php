<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reset Password</title>
    <link rel="stylesheet" href="{{ asset('assets/css/reset.css') }}" ;>
</head>

<body>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <button type="submit">Invia Email di Ripristino</button>
    </form>


</body>

</html>