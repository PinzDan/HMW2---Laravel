<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reset Password</title>
    <link rel="stylesheet" href="{{ asset('assets/css/reset.css') }}" ;>
</head>

<body>
    <form method="POST" action="{{ route('updatePassword') }}">
        @csrf
        <div>
            <input type="text" name="id" hidden value="{{ $id}} ">
            <label for="Password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>

        <button type="submit">Invia</button>
    </form>


</body>

</html>