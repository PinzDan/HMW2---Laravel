# Spiegazione HOME PAGE ( good luck! :joy: ) 

## 1. layout.blade.php

### Struttura HTML e Metadati

```
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="{{ asset('assets/js/main.js') }}" defer></script>
    <script src="{{ asset('assets/js/get_film.js') }}" defer></script>
    <title>@yield('title', 'Home')</title>
    <script>var currentPage = '';</script>
</head>
<body>
```

- DOCTYPE e Linguaggio: <!DOCTYPE html> specifica il tipo di documento HTML5. <html lang="en"> indica che il documento è in lingua inglese.
- Metadati: <meta charset="UTF-8"> specifica l'encoding dei caratteri. <meta name="viewport" content="width=device-width, initial-scale=1.0"> imposta la larghezza della viewport al dispositivo e scala iniziale.
- CSS e JavaScript: I tag <link> e <script> includono rispettivamente i fogli di stile CSS (style.css) e i file JavaScript (main.js e get_film.js) dalla cartella assets.
- Titolo della Pagina: @yield('title', 'Home') definisce il titolo della pagina, con il valore di default "Home" se non è specificato da una pagina figlia.
- Variabile JavaScript: <script>var currentPage = '';</script> inizializza una variabile JavaScript currentPage che sarà usata per determinare la pagina corrente.



```
@include('navbar')

<div class="content">
    @yield('content')
</div>

@include('footer')

```

Inclusione di Navbar e Footer: @include('navbar') e @include('footer') includono le parti comuni come la barra di navigazione e il footer in tutte le pagine.

## Home.Blade.php

```
@extends('layout')

@section('title', 'Home')

@section('content')
```

- Estensione del Layout: @extends('layout') indica che questa pagina estende il layout definito in layout.blade.php.
- Definizione del Titolo: @section('title', 'Home') specifica il titolo della pagina come "Home".
- Contenuto Specifico della Home Page: @section('content') definisce il contenuto specifico della home page che verrà inserito nell'area <div class="content"> nel layout.

```
<img class="frankie" src="{{ asset('assets/Images/frankesinstein.png') }}">
<div class="content">
    <!-- Sezione immagine della settimana -->
    <section id="primary">
        <!-- Logo e testo scorrevole -->
        <div class="logo-gray">
            <img src="{{ asset('assets/Logo/logo_on_left.png') }}">
        </div>
        <!-- Immagini slideshow con titoli e descrizioni -->
        <section id="image-of-week">
            <div class="slideshow">
                <!-- Slide con immagine e descrizione -->
                <div class="photo">
                    <img src="{{ asset('assets/Images/animated/slideshow1.jpg') }}">
                    <div class="caption overlay" data-element-title="Lo Squalo" data-description="...">
                    </div>
                </div>
                <!-- Altre slide simili -->
                ...
            </div>
            <!-- Punti per navigare tra le slide -->
            <div class="dots">
                <span class="dot"></span>
                <span class="dot"></span>
                <!-- Altri punti -->
                ...
            </div>
        </section>
        <!-- Sezione film -->
        <section class="film-section">
            <!-- Contenitori per film -->
            <div id="first-film">
                <!-- Dettagli film a sinistra -->
                <div class="left-container">
                    <!-- Poster, descrizione, trailer -->
                    <div class="left-poster"></div>
                    <div class="description">
                        <h1></h1>
                        <p></p>
                    </div>
                    <div class="trailer"></div>
                    <!-- Freccia per navigazione -->
                    <svg width="64" height="64" class="arrow">
                        <image href="{{ asset('assets/Images/icon/arrow_forward_24dp_FILL0_wght400_GRAD0_opsz24.svg') }}" width="64" height="64"></image>
                    </svg>
                </div>
            </div>
            <!-- Secondo film -->
            <div id="second-film">
                <!-- Dettagli film a destra -->
                <div class="right-container">
                    <!-- Poster, descrizione, trailer -->
                    <div class="right-poster"></div>
                    <div class="description">
                        <h1></h1>
                        <p></p>
                    </div>
                    <div class="trailer"></div>
                    <!-- Freccia per navigazione -->
                    <svg width="64" height="64" class="arrow">
                        <image href="{{ asset('assets/Images/icon/arrow_back_24dp_FILL0_wght400_GRAD0_opsz24.svg') }}" width="64" height="64"></image>
                    </svg>
                </div>
            </div>
        </section>
    </section>
</div>
```
- Immagine di Frankie: Mostra un'immagine di Frankie posizionata con una classe frankie.
- Sezione Primaria (#primary): Contiene il logo e il testo scorrevole, oltre alla sezione dell'immagine della settimana.
- Slideshow (#image-of-week): Mostra una serie di diapositive di film con immagini e descrizioni.
- Sezione Film (film-section): Contiene due sezioni per i dettagli dei film, con poster, descrizioni e trailer.

## main.js
```
console.log("main js avviato");

// Funzione per mostrare le diapositive dei film
function showSlides() {
    let slides = document.getElementsByClassName("photo");
    let dots = document.getElementsByClassName("dot");
    // ... Logica per mostrare le diapositive con un intervallo di tempo ...
}

// Funzione per fetchare i film da un'API
function fetchFilm() {
    fetch('/api/films')
        .then(response => {
            if (!response.ok) {
                throw new Error("Errore " + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            console.log(data);
            // ... Gestione dei film ottenuti dall'API ...
        })
        .catch(error => {
            console.error('Errore fetch', error);
        });
}

// Esecuzione di fetchFilm() al caricamento della pagina
window.onload = fetchFilm;
```
- Gestione delle Diapositive: showSlides() gestisce la rotazione delle diapositive dei film con un intervallo di tempo predefinito.
- Chiamata API e Aggiornamento della Pagina: fetchFilm() fa una chiamata API a /api/films per ottenere i dati dei film e li gestisce nel contesto della home page.
- Funzione fetchFilm()
### dettagli FetchFilms() -> 
```
function fetchFilm() {
    fetch('/api/films')
        .then(response => {
            if (!response.ok) {
                throw new Error("Errore " + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            console.log(data);
            // ... Gestione dei film ottenuti dall'API ...
        })
        .catch(error => {
            console.error('Errore fetch', error);
        });
}

```
- fetch('/api/films'): Questo metodo di fetch invia una richiesta GET all'endpoint specificato (/api/films). La funzione fetch() restituisce una promessa che rappresenta la risposta HTTP a questa richiesta.
- .then(response => { ... }): Il metodo .then() viene utilizzato per gestire la risposta ricevuta dalla richiesta fetch. response è l'oggetto che rappresenta la risposta HTTP restituita dal server.
- if (!response.ok): Questo controllo verifica se la risposta ha uno stato "OK" (status code 200-299). Se la risposta non è OK, viene sollevata un'eccezione con un messaggio di errore che include lo stato della risposta (response.statusText).
- .then(data => { ... }): Se la risposta è OK, il metodo .then() successivo viene utilizzato per estrarre i dati JSON dalla risposta. data contiene i
- .catch(error => { ... }): Questo blocco gestisce eventuali errori che possono verificarsi durante la richiesta o il parsing della risposta JSON. Se si verifica un errore, l'errore viene catturato e stampato nella console per il debug.

### Esecuzione al Caricamento della Pagina

javascript

window.onload = fetchFilm;

Questa istruzione assicura che la funzione fetchFilm() venga eseguita automaticamente quando la pagina HTML è completamente caricata (window.onload). In questo modo, non appena la pagina è pronta, la chiamata API viene eseguita per ottenere i dati dei film.
Conclusione

In sintesi, la funzione fetchFilm() effettua una chiamata GET a /api/films per ottenere i dati dei film, gestisce la risposta e gli eventuali errori con i metodi .then() e .catch(), e stampa i dati ottenuti nella console del browser. Questo approccio consente di integrare dinamicamente i dati ottenuti dall'API nella tua pagina web, migliorando l'esperienza utente con contenuti aggiornati e dinamici.


# Definizione delle Route
```
Route::get('/', function () {
    return view('home');
})->name('home');
```

 Route per la Home Page: Route::get('/', function () { return view('home'); }) definisce la route per la home page, che restituisce la vista home.blade.php quando un utente visita /.

##Funzionamento Globale:

  - Caricamento della Pagina: Quando un utente visita la home page (/), Laravel carica il layout (layout.blade.php) che include stili CSS e script JavaScript.

  - Estensione e Contenuto Dinamico: home.blade.php estende il layout e definisce il contenuto specifico della home page utilizzando direttive Blade per l'inserimento dinamico di dati.

  - Interazione e Dinamicità: main.js gestisce l'interazione client-side come le diapositive dei film e le chiamate API per aggiornare dinamicamente il contenuto della home page.

#### Questo setup permette un'esperienza utente dinamica e reattiva sulla home page, integrando sia lato server (Laravel e Blade) che lato client (JavaScript).

# Gestione api.php per le rotte ed il FIlmController :dizzy_face: : 

## film controller: 

```
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;

Route::get('/films', [FilmController::class, 'index']);

    Route Definition: Qui stai definendo una sola rotta GET all'endpoint /films. Quando un client fa una richiesta GET a /films, Laravel inoltrerà la richiesta al metodo index() del FilmController.

FilmController

Il FilmController gestisce la logica di business associata ai film. Ecco il tuo FilmController:

php

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;

class FilmController extends Controller
{
    public function index()
    {
        try {
            $films = Film::orderBy('title', 'asc')->get();
            return response()->json($films);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Errore durante il recupero dei film'], 500);
        }
    }
}

```
 Namespace e Utilizzo del Modello: Il controller è nel namespace App\Http\Controllers. Utilizza il modello Film per interagire con la tabella films nel database.

    Metodo index(): Questo metodo gestisce la richiesta GET /films.
        Utilizza il modello Film per recuperare tutti i film ordinati per titolo in ordine ascendente (orderBy('title', 'asc')).
        Restituisce una risposta JSON contenente l'elenco dei film recuperati.
        Gestisce gli errori tramite un blocco try-catch, restituendo una risposta JSON di errore con status HTTP 500 se si verifica un'eccezione.

Modello Film

Il modello Film rappresenta un'entità nel database e fornisce un'interfaccia per interagire con i dati della tabella films. Ecco il tuo modello Film:

## Films model: 
```
class Film extends Model
{
    use HasFactory;

    protected $table = 'films';  // Specifica il nome della tabella nel database
    protected $fillable = [
        'title',
        'description',
        'locandina',
        'trailer',
        'anno_di_rilascio',
        'rating',
        'durata',
        'genere'
    ];
}


```
 Utilizzo del Modello: Il modello Film estende Illuminate\Database\Eloquent\Model, che fornisce metodi per interagire con il database utilizzando Eloquent ORM.

  - Proprietà $table: Specifica il nome della tabella nel database associata al modello. Nel tuo caso, films.

  - Proprietà $fillable: Specifica quali campi possono essere riempiti tramite il metodo create() o fill() del modello. Questo aiuta a prevenire l'assegnazione massiva non sicura.

Considerazioni sull'utilizzo del Modello

  - Accesso ai Dati: Utilizzando un modello come Film, Laravel semplifica l'accesso ai dati nel database. Eloquent ORM gestisce molte delle operazioni CRUD (Create, Read, Update, Delete) per te, rendendo il codice più leggibile e manutenibile.

  - Sicurezza: Specificando i campi $fillable, Laravel aiuta a prevenire l'assegnazione massiva non autorizzata, migliorando la sicurezza dell'applicazione.

In conclusione, il modo in cui hai strutturato il tuo codice con un modello Film, un FilmController e definendo le rotte in api.php è conforme alle pratiche consigliate di Laravel. Questo approccio aiuta a mantenere il codice organizzato, facilitando la gestione e l'espansione del progetto in futuro.
