@extends('layout2')


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

                <div>
                    <img src = {{ $locandina }}>
                    <div id = 'reward'>
                        <h2>Premi</h2>
                    </div>
                </div>
               
                <div class="details">
                   
                        <h1>{{ $title }}</h1>
                    
                    <div class="star">

                    </div>
                    <div class="vote-now">
                        <svg width="32" height="32" class="arrow">
                            <image href="{{ asset('assets/icon/arrowtop.svg') }}" width="32" height="32">
                            </image>
                        </svg>
                        <span>Vote now!</span>
                    </div>
                    
                        <p>{{$trama}}</p>
                    
                    <div class=" trailer-container">
                        @php
                            echo $trailer;
                        @endphp
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

                <p>{{ $cast }}...</p>

            </div>

        </div>
    </div>
</section>

<div class="commenti">
    <div class="container-commenti">
    </div>




    <form class="commenta" method="POST" action="{{ route('send-comment') }}">
        @csrf
        <input type="hidden" name="film_id" value="{{ $id;}} ">
        <textarea id="commento" name="commento" placeholder="{{ $placeholder; }}" {{ $disabled }}></textarea>
        <input type="submit" value="commenta">
    </form>
</div>

@endsection