<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Verificato</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
        }

        h1 {
            font-size: 3em;
            color: #333;
        }
    </style>
</head>

<body>
    <h1>Account Verificato</h1>
    <img src="{{ asset('assets/icon/load.gif') }}">
    <p>Verrai reindirizzato alla home page tra <strong id="countdown">5</strong> secondi...</p>
    <script>
        // Funzione per aggiornare il conto alla rovescia
        function countdown() {
            const countdownElement = document.getElementById('countdown');
            let seconds = parseInt(countdownElement.textContent);

            if (seconds > 0) {
                seconds--;
                countdownElement.textContent = seconds;
                setTimeout(countdown, 1000); // Ripeti ogni secondo
            } else {
                // Quando il conto alla rovescia è completato, reindirizza alla home
                window.location.href = "{{ route('home') }}";
            }
        }

        // Avvia il conto alla rovescia dopo che il documento è completamente caricato
        document.addEventListener('DOMContentLoaded', function () {
            countdown();
        });
    </script>
</body>

</html>