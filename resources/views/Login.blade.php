@extends('layout2')



@section('title', 'Login')

@section('content')


<script src="{{ asset('assets/js/LogSing.js') }}" defer></script>
<div id="main-container-login">

    <div id="signup-container">

        <div class="button-form">
            <button id="login-btn" class="clicked" onclick="changeForm('login')"> Log In</button>
            <button id="signup-btn" onclick="changeForm('signup')">Sign Up</button>
        </div>

        <form method="POST" action="{{ route('login')}}" class="login-form">
            @csrf
            <label for="Username">Username: </label>
            <input name="username" id="Username" type="text" placeholder="Es. MarioRossi123" required>


            <label for="pwd">password: </label>
            <input class="pwd" name="pwd" type="password" required>


            <input type="submit" id="sign-submit" value="Log In">
        </form>


        <form method="POST" action="{{ route('register')}}" class="signup-form hidden">
            @csrf
            <label for="Username">Username: </label>
            <input id="Username" name="username" type="text" placeholder="Es. MarioRossi123" required>


            <label for="mail">E-mail: </label>
            <input id="mail" name="mail" type="email" placeholder="Es. MarioRossi123@hotmail.it" required>



            <label for="pwd">password: </label>
            <input class="pwd" name="password" type="password" required>

            <label for="pwd_confirm">Confirm password: </label>
            <input id="pwd_confirm" name="password_confirmation" type="password" required>

            <input type="submit" id="sign-submit" value="Sign Up">

        </form>

        <a href="{{ route('google.login') }}" id="google">
            <svg width="48" height="48">
                <image href="{{ asset('assets/icon/icons8-google.svg') }}"></image>
            </svg>
        </a>
        <svg width="24" height="24" class="eyes">
            <image id="visible" href="{{ asset('assets/icon/visibility_24dp_FILL0_wght400_GRAD0_opsz24.png') }}"
                width="24" height="24">
            </image>
        </svg>

    </div>

    <div class="paragrafo-login">
        <img src="{{ asset('assets/Logo/logo_noscritta_white.png') }}">
        <p>2001: Odissea nello spazio è un film epico di fantascienza diretto da Stanley Kubrick,
            che esplora temi di evoluzione umana, intelligenza artificiale e viaggi spaziali.
            La storia inizia con un gruppo di scimmie nel deserto africano che scoprono un monolite nero,
            un misterioso artefatto che segna un salto evolutivo.<br>

            Ispirati da questa scena iconica, abbiamo progettato il nostro logo con una scimmia che indossa un casco
            spaziale, rappresentando l'inizio del film. Il casco e la navicella spaziale richiamano le sezioni
            successive del
            film, dove l'umanità si avventura nello spazio profondo, guidata dall'enigmatico monolite verso nuovi
            orizzonti di conoscenza e scoperta.
        </p>
    </div>
</div>
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif


@endsection