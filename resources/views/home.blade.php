@extends('layout')


@section('title', 'Home')

@section('content')


<script>currentPage = 'home';</script>
<script src="{{ asset('assets/js/main.js') }}" defer></script>


<div class="contents">
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
        <div id="image-of-week">
            <div class="slideshow">
                <svg class="back" width="64px" height="64px">
                    <image href="{{ asset('assets/icon/arrow_back.svg') }}" width="64px" height="64px"></image>
                </svg>
                <svg class="next" width="64px" height="64px">
                    <image href="{{ asset('assets/icon/arrow_forward.svg') }}" width="64px" height="64px"></image>
                </svg>
                <div class="photo">
                    <a href="">
                        <img src="">
                    </a>
                    <div class="caption overlay"></div>
                </div>
                <div class="photo">
                    <a href="">
                        <img src="">
                    </a>
                    <div class="caption overlay"></div>
                </div>
                <div class="photo slide">
                    <a href="">
                        <img src="">
                    </a>
                    <div class="caption overlay"></div>
                </div>
                <div class="photo slide">
                    <a href="">
                        <img src="">
                    </a>
                    <div class="caption overlay"></div>
                </div>
                <div class="photo slide">
                    <a href="">
                        <img src="">
                    </a>
                    <div class="caption overlay"></div>
                </div>
            </div>
        </div>
        <div class="dots">
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>
    </section>
    </di>
    <!-- dot -->


    <section class="film-section">

        <div class="divider">
            <img src="{{ asset('assets/Logo/logo_noscritta_white.png') }}" alt="Icona Divisore" class="divider-icon">
        </div>

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
                    <image href="{{ asset('assets/icon/arrow_back_24dp_FILL0_wght400_GRAD0_opsz24.svg') }}" width="64"
                        height="64"></image>
                </svg>
                <div class="trailer"></div>
            </div>
        </div>
    </section>
    </section>
    <section class="final-section"></section>
</div>


@endsection