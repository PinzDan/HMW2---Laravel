@extends('layout2')

@section('title', 'Account settings')



@section('content')
<script type="module" src="{{ asset('assets/js/settings.js') }}" defer> </script>
<link rel="stylesheet" href="{{ asset('assets/css/settings.css') }}">

<div class="section-container">
    <input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}">
    <input type="file" id="photo-input" name="photo" accept=".jpg, .jpeg, .png" />
    <div class="image">
        <img class="edit" id="photo-img">

        <svg width="50px" height="50px">
            <image class="edit" href="{{ asset('/assets/icon/edit.svg') }}" width="50px" height="50px">
        </svg>
    </div>
    <form action="post">
        @csrf
        <div class="username">
            <input class="notselected" type="text" disabled>
            <svg width="24px" height="24px">
                <image class="editText" href="{{ asset('/assets/icon/editText.svg') }}" width="24px" height="24px">
            </svg>
        </div>


    </form>
    <div class="email">

    </div>

    <span></span>

    <button id="Elimina" >Elimina Account</button>
</div>

<div class="selected-container">
    <div id="info-account">
        <div class="activity-container">
            <div class="activity">
                @php
                    $activities = Session::get('activities', []);

                @endphp

                <div class="activity">
                    <h2>{{ $activities[0]->description;}} </h2>
                    <p> {{ $activities[0]->details;}} </p>
                    <a href="#" class="btn">Dettagli</a>
                </div>

            </div>
            <div class="activity">

                <div class="activity">
                <h2>{{ $activities[1]->description;}} </h2>
                <p> {{ $activities[1]->details;}} </p>
                    <a href="#" class="btn">Dettagli</a>
                </div>
            </div>
            <div class="activity">
                <div class="activity">
                    <h2>{{ $activities[2]->description;}} </h2>
                    <p> {{ $activities[2]->details;}} </p>
                    <a href="#" class="btn">Dettagli</a>
                </div>
            </div>
            <div class="activity">
                <div class="activity">
                    <h2>{{ $activities[3]->description;}} </h2>
                    <p> {{ $activities[3]->details;}} </p>
                    <a href="#" class="btn">Dettagli</a>
                </div>
            </div>
        

        </div>
        <div class="top3-container">
            <h1>I tuoi preferiti:</h1>
            <div class="top3-item rank1">
                <div class="rank">
                    <svg width="64px" height="64px">
                        <image href="{{ asset('/assets/icon/crown.svg')}}" width="64px" height="64px"></image>
                    </svg>
                </div>
                <div class="content-rank">
                    <h2></h2>
                    <p></p>

                    <svg width="24px" height="24px">
                        <image href="{{ asset('/assets/icon/star.svg')}}" width="24px" height="24px"></image>
                    </svg>
                    <span>


                    </span>
                </div>
            </div>
            <div class="top3-item rank2">
                <div class="rank">
                    <svg width="64px" height="64px">
                        <image href="{{ asset('/assets/icon/silver.svg')}}" width="64px" height="64px"></image>
                    </svg>
                </div>
                <div class="content-rank">
                    <h2></h2>
                    <p></p>

                    <svg width="24px" height="24px">
                        <image href="{{ asset('/assets/icon/star.svg')}}" width="24px" height="24px"></image>
                    </svg>
                    <span>

                    </span>

                </div>
            </div>
            <div class="top3-item rank3">
                <div class="rank">
                    <svg width="64px" height="64px">
                        <image href="{{ asset('/assets/icon/bronze.svg')}}" width="64px" height="64px"></image>
                    </svg>
                </div>
                <div class="content-rank">
                    <h2></h2>
                    <p></p>

                    <svg width="24px" height="24px">
                        <image href="{{ asset('/assets/icon/star.svg')}}" width="24px" height="24px"></image>
                    </svg>
                    <span>


                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection