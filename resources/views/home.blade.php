@extends('layout')





@section('title', 'Home')

@section('content')


<script>var currentPage = 'home';</script>
<script src="{{ asset('assets/js/main.js') }}" defer></script>


<img class="frankie" src="{{ asset('assets/Images/frankesinstein.png') }}">

<div class="content">
    <section id="primary">
        <div class="logo-gray">
            <img src="{{ asset('assets/Logo/logo_on_left.png') }}">
        </div>
        <!-- Image of the week -->
        <div class="title-week">
            <div class="scroll-text">
                <img src="{{ asset('assets/icon/flame.png') }}">
                <span> ~ Puoi trovare i Best of the week nel riquadro sottostante! ~</span>
                <img src="{{ asset('assets/Images/icon/icons8-telegram-96.png') }}">
                <span> Iscriviti al nostro canale telegram ~ </span>
            </div>
        </div>
        <section id="image-of-week">
            <div class="slideshow">
                <div class="photo">
                    <img src="{{ asset('assets/Images/animated/slideshow1.jpg') }}">
                    <div class="caption overlay" data-element-title="Lo Squalo"
                        data-description="Lo Squalo, diretto da Steven Spielberg nel 1975, è un film thriller che ha segnato un punto di svolta nell'industria cinematografica, diventando il primo vero blockbuster. Il film segue lo sforzo di un gruppo di persone per catturare uno squalo che minaccia una comunità costiera, portando tensione e terrore nelle acque profonde.">
                    </div>
                </div>
                <div class="photo">
                    <img src="{{ asset('assets/Images/animated/slideshow2.jpg') }}">
                    <div class="caption overlay" data-element-title="Colazione da Tiffany"
                        data-description="Colazione da Tiffany, diretto da Blake Edwards nel 1961, è una commedia
                            romantica iconica che ha catturato l'immaginazione di milioni di spettatori. Il film segue
                            la giovane e eccentrica Holly Golightly, interpretata da Audrey Hepburn, mentre naviga tra
                            l'amore, l'amicizia e l'identità nella vivace New York degli
                            anni '60. Con la sua colonna sonora memorabile e lo stile glamour senza tempo, Colazione da Tiffany è diventato un classico del cinema.">
                    </div>
                </div>
                <div class="photo slide">
                    <img src="{{ asset('assets/Images/animated/slideshow3.jpg') }}">
                    <div class="caption overlay" data-element-title="Steamboat Willie" data-description="Steamboat Willie, uscito nel 1928, è stato il primo cortometraggio d'
                            animazione sonoro di Walt Disney con Mickey Mouse come protagonista. Questo corto è stato un
                            punto di svolta nell'industria dell'animazione, introducendo il sonoro sincronizzato con le
                            immagini e portando Mickey Mouse alla fama mondiale."></div>
                </div>
                <div class="photo slide">
                    <img src="{{ asset('assets/Images/animated/slideshow4.jpg') }}">
                    <div class="caption overlay" data-element-title="Alien"
                        data-description="Alien, diretto da Ridley Scott nel 1979, è un classico del genere horror e fantascienza. Il film segue l'equipaggio della nave spaziale Nostromo mentre viene attaccato da un alieno letale. Con una combinazione di suspense, atmosfera claustrofobica e creature iconiche, Alien ha influenzato generazioni di film di fantascienza e horror.">
                    </div>
                </div>
                <div class="photo slide">
                    <img src="{{ asset('assets/Images/animated/slideshow5.jpg') }}">
                    <div class="caption overlay" data-element-title="Ghost in the Shell"
                        data-description="Ghost in the Shell, diretto da Mamoru Oshii nel 1995, è un film d'animazione giapponese che esplora temi complessi legati all'identità umana, alla tecnologia e alla coscienza. Ambientato in un futuro distopico, il film segue il cyborg Motoko Kusanagi mentre cerca di fermare un pericoloso hacker informatico. Con la sua narrativa sofisticata e la sua animazione mozzafiato,Ghost in the Shell ha guadagnato un seguito culturale globale.">
                    </div>
                </div>
            </div>
            <!-- dot -->
            <div class="dots">
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
        </section>
        <section class="film-section">
            <!-- Primo film -->
            <div id="first-film">
                <div class="left-container">
                    <div class="left-poster"></div>
                    <div class="description">
                        <h1></h1>
                        <p></p>
                    </div>
                    <div class="trailer"></div>
                    <svg width="64" height="64" class="arrow">
                        <image href="{{ asset('assets/icon/arrow_forward_24dp_FILL0_wght400_GRAD0_opsz24.svg') }}"
                            width="64" height="64"></image>
                    </svg>
                </div>
            </div>
            <!-- Secondo film -->
            <div id="second-film">
                <div class="right-container">
                    <div class="right-poster"></div>
                    <div class="description" data-element="0">
                        <h1></h1>
                        <p></p>
                    </div>
                    <svg width="64" height="64" class="arrow">
                        <image href="{{ asset('assets/icon/arrow_back_24dp_FILL0_wght400_GRAD0_opsz24.svg') }}"
                            width="64" height="64"></image>
                    </svg>
                    <div class="trailer"></div>
                </div>
            </div>
        </section>
    </section>
    <section class="final-section"></section>
</div>


@endsection