@extends('layout')


@section('title', 'film')
@section('content')

@if (!session()->has('logged'))
    @php    $disabled = "disabled";
        $placeholder = "Effettua il login per poter commentare"; 
    @endphp
@else
    @php    $disabled = "";
        $placeholder = "scrivi un commento..."; 
    @endphp
@endif

<link href="{{ asset('../assets/css/selected_film.css') }}" rel="stylesheet">
<script type="module" src="{{ asset('/assets/js/selected_film.js') }}" defer></script>

<section id="main">
    <div class="main-container">
        <div class="film">
            <div class="first-row">
                @php
                    echo "<div>";
                    echo "<img src='$locandina'>";
                    echo "<div id='reward'>";
                    echo "<h2>Premi</h2>";
                    echo "</div>";
                    echo "</div>";
                @endphp


                <div class="details">
                    @php
                        echo "<h1>$title</h1>";
                    @endphp
                    <div class="star">

                    </div>
                    <div class="vote-now">
                        <svg width="32" height="32" class="arrow">
                            <image href="{{ asset('assets/icon/arrowtop.svg') }}" width="32" height="32">
                            </image>
                        </svg>
                        <span>Vote now!</span>
                    </div>
                    @php
                        echo "<p>$trama</p>";
                    @endphp
                    <div class=" trailer-container">
                        @php echo $trailer; @endphp

                    </div>



                </div>

            </div>

        </div>
        <div class="componenti">

            <h1 class="title-section">Regista</h1>
            <div class="regista">

                <div class="regista-photo">
                    <img src="">
                </div>

                <div class="generalita">
                    <h1 id="regista-nome">nome cognome</h1>
                    <p id="regista-biografia">biografia</p>
                </div>
            </div>
            <h2>Cast</h2>
            <div class="cast">

                <p>{{ request()->input('cast') }}...</p>

            </div>

        </div>
    </div>
</section>

<div class="commenti">
    <div class="container-commenti">
    </div>




    <form class="commenta" method="POST" action="{{ route('send-comment') }}">
        @csrf
        <input type="hidden" name="film_id" value="@php echo $id; @endphp ">
        <textarea id="commento" name="commento" placeholder=" @php echo $placeholder; @endphp " @php echo $disabled;
            @endphp></textarea>
        <input type="submit" value="commenta">
    </form>
</div>

@endsection