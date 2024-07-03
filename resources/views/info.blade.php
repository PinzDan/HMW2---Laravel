@extends('layout2')

@section('title', 'Info')



@section('content')
<script src="{{ asset('assets/js/info.js') }}" defer></script>
<section class="info">
    <link rel="stylesheet" href="{{ asset('assets/css/info.css') }}" ;>
    <h2>Cosa Offriamo</h2>
    <p>Benvenuti su Odyssey, la tua destinazione principale per tutto ciò che riguarda il mondo del cinema! Che tu sia
        un appassionato cinefilo, un critico in erba o semplicemente alla ricerca del prossimo film da vedere, sei nel
        posto giusto.</p>
    <ul>
        <li><strong>Recensioni Dettagliate</strong>: Leggi recensioni approfondite su una vasta gamma di film, dai
            classici intramontabili alle ultime uscite.</li>
        <li><strong>Votazioni e Commenti</strong>: Esprimi la tua opinione votando i film e lasciando commenti.
            Condividi le tue impressioni e leggi cosa ne pensano gli altri utenti.</li>
        <li><strong>Classifiche e Raccomandazioni</strong>: Scopri i film più votati dalla nostra comunità e ricevi
            consigli personalizzati in base alle tue preferenze di visione.</li>
        <li><strong>Schede Tecniche</strong>: Accedi a informazioni dettagliate sui film, inclusi cast, regia, trama,
            durata, e tanto altro.</li>
        <li><strong>Trailer e Teaser</strong>: Guarda i trailer e i teaser dei film direttamente sul nostro sito per
            farti un'idea prima di guardare un film.</li>
    </ul>
    <h2>Come Funziona</h2>
    <p>
        <strong>Registrati</strong>: Crea un account gratuito per accedere a tutte le funzionalità del sito.
    </p>
    <p>
        <strong>Esplora</strong>: Naviga tra le categorie e le recensioni per trovare i film che ti interessano.
    </p>
    <p>
        <strong>Vota e Commenta</strong>: Dopo aver visto un film, torna sul nostro sito per lasciare la tua valutazione
        e il tuo commento.
    </p>
    <p>
        <strong>Interagisci</strong>: Partecipa alle discussioni nella sezione commenti e scopri nuovi punti di vista.
    </p>
    <h2>La Nostra Comunità</h2>
    <p>Odyssey è più di un semplice sito di recensioni; è una comunità di appassionati di cinema. Crediamo che ogni
        opinione conti e vogliamo che tu faccia parte di questa esperienza condivisa. La tua voce può aiutare altri
        utenti a scoprire nuovi film e a evitare quelli meno interessanti.</p>
    <h2>Contattaci</h2>
    <p>Hai domande o suggerimenti? Siamo qui per ascoltarti! Visita la nostra <a href="#sezione-contatti">sezione
            contatti</a> per inviarci un messaggio. Ci impegniamo a migliorare continuamente e il tuo feedback è
        prezioso per noi.</p>
    <h2>Unisciti a Noi</h2>
    <p>Inizia la tua avventura cinematografica con Odyssey. Registrati oggi e diventa parte della nostra community!</p>

</section>

<section class="sezione-2">
    <h1>Utenti più attivi </h1>
    <div class="podio">

        <!-- posizione 2 -->
        <div class="position ">
            <svg width="64px" height="64px">
                <image href="{{ asset('/assets/icon/silver.svg')}}" width="64px" height="64px"></image>
            </svg>
            <div class="avatar" data-rank="1">
                <img src="" alt="Avatar Utente 3">
            </div>
            <span class="name"></span>
            <span>2°</span>
        </div>

        <!-- posizione 1 -->
        <div class="position ">
            <svg width="64px" height="64px">
                <image href="{{ asset('/assets/icon/crown.svg')}}" width="64px" height="64px"></image>
            </svg>
            <div class="avatar" data-rank="2">
                <img src="" alt="Avatar Utente 3">
            </div>
            <span class="name"></span>
            <span>1°</span>
        </div>

        <!-- posizione 3 -->
        <div class="position">
            <svg width="64px" height="64px">
                <image href="{{ asset('/assets/icon/bronze.svg')}}" width="64px" height="64px"></image>
            </svg>
            <div class="avatar" data-rank="0">
                <img src="" alt="Avatar Utente 3">
            </div>
            <span class="name"></span>
            <span>3°</span>
        </div>
    </div>
    <div class="cerca">
        <h1>Non trovi un film?</h1>
        <h2>Non c'è problema! Prova da qua:</h2>
        <h3>(La funzione prende solo i titoli in inglese)</h3>
        <input type="text" id="cercaFilm" placeholder="Es. Jaws, 2001: A Space Odyssey, The lion king...)"
            autocomplete="off">
        <div class="trovato">
            <div class="main"></div>
            <div class="secondary"></div>
        </div>
        @if(session("admin"))
            <button id="aggiungiFilm">Aggiungi al DB</button>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>

</section>



@endsection