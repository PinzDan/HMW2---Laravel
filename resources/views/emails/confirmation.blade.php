<!DOCTYPE html>
<html>

<head>
    <title>Conferma la tua registrazione</title>
</head>

<body>
    <h1>Ciao, {{ $user->username }}!</h1>
    <p>Grazie per esserti registrato. Per favore, clicca sul link seguente per confermare la tua registrazione:</p>
    <p><a href="{{ url('api/verify/' . $confirmationCode . "/" . $user->username) }}">Conferma la tua email</a></p>
    <p>O copia e incolla questo URL nel tuo browser: {{ url('verify/' . $confirmationCode) . "/" . $user->username }}
    </p>
</body>

</html>