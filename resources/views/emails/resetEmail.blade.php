<!DOCTYPE html>
<html>

<head>
    <title>Conferma la tua registrazione</title>
</head>

<body>
    <h1>Ciao, {{ $user->username }}!</h1>
    <p>Ecco il link per reimpostare la password:</p>
    <p><a href="{{ url('resetpwd/' . $user->id) }}">Reset password</a></p>
    </p>
</body>

</html>