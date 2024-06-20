@extends('layout')

@section('title', 'Archives')

@section('content')
<script>var currentPage = 'archive';</script>
<link rel="stylesheet" href="../assets/css/archivio.css">


<div id="archive-title">
    <img src="./assets/Logo/logo_noscritta_white.png"></image>
    <h1>Archives</h1>
</div>

<section id="research">
    <div id="input-research">
        <svg width="24" height="24">
            <image href="./assets/icon/search_24dp_FILL0_wght400_GRAD0_opsz24.svg"></image>
        </svg>
        <input type="text" id="research-film" class="archives-button" placeholder="Cerca un film...">

        <div class="menu-ricerca notactive">
            <div class="research-card">
                <img src="">
                <div class="info">
                    <h1></h1>
                    <p></p>
                </div>
            </div>
        </div>
    </div>
    <button value="genere" id="select-genre" class="archives-button">Genere

        <svg width="24" height="24">
            <image href="./assets/icon/movie_24dp_FILL0_wght400_GRAD0_opsz24.svg"></image>
        </svg>

        <div class="menu-genere dont-show ">
            <ul>
                <li><input type="checkbox" value="horror"><label>Horror</label></li>
                <li><input type="checkbox" value="thriller"><label>Thriller</label></li>
                <li><input type="checkbox" value="drammatico"><label>Drammatico</label></li>
                <li><input type="checkbox" value="commedia"><label>Commedia</label></li>
                <li><input type="checkbox" value="animazione"><label>Animazione</label></li>
                <li><input type="checkbox" value="romantico"><label>Romantico</label></li>
            </ul>
        </div>
    </button>


    <button id="filter" class="archives-button">Filtra
        <svg width="24" height="24">
            <image href="./assets/icon/filter_list_24dp_FILL0_wght400_GRAD0_opsz24.svg"></image>
        </svg>

        <div class="filter-menu ">
            <select class="menu-items">
                <option>Ordina per: </option>
                <option value="anno">Anno</option>
                <option value="rating">Rating</option>
                <option value="durata">Durata</option>
            </select>

        </div>
    </button>
</section>


<h1 class="top-of">Top of the week: </h1>
<div class="film-scroll">
    <div class="film-card">
        <div class="info-card">
            <h3></h3>
            <span>Rating: </span>
            <p></p>

        </div>
        <img src="">
    </div>
    <div class="film-card">
        <div class="info-card">
            <h3></h3>
            <span>Rating: </span>
            <p></p>

        </div>
        <img src="">
    </div>
    <div class="film-card">
        <div class="info-card">
            <h3></h3>
            <span>Rating: </span>
            <p></p>

        </div>
        <img src="">
    </div>
    <div class="film-card">
        <div class="info-card">
            <h3></h3>
            <span>Rating: </span>
            <p></p>

        </div>
        <img src="">
    </div>
    <div class="film-card">
        <div class="info-card">
            <h3></h3>
            <span>Rating: </span>
            <p></p>
        </div>
        <img src="">
    </div>
    <div class="film-card">
        <div class="info-card">
            <h3></h3>
            <span>Rating: </span>
            <p></p>

        </div>
        <img src="">
    </div>
    <div class="film-card">
        <div class="info-card">
            <h3></h3>
            <span>Rating: </span>
            <p></p>

        </div>
        <img src="">
    </div>
    <div class="film-card">
        <div class="info-card">
            <h3></h3>
            <span>Rating: </span>
            <p></p>

        </div>
        <img src="">
    </div>
    <div class="film-card">
        <div class="info-card">
            <h3></h3>
            <span>Rating: </span>
            <p></p>

        </div>
        <img src="">
    </div>
    <div class="film-card">
        <div class="info-card">
            <h3></h3>
            <span>Rating: </span>
            <p></p>

        </div>
        <img src="">
    </div>
</div>


</div>



<div id="list-line"><span>Qui trovi la lista con tutti i film presenti! Buon divertimento!</span></div>

<div id="archivio-film">
    <h1 id="notfound"> Nessun film del genere selezionato è stato trovato </h1>
    <div class="film-card-row">
        <div class="film-card"></div>
        <div class="film-card"></div>
        <div class="film-card"></div>
        <div class="film-card"></div>
        <div class="film-card"></div>
    </div>
    <div class="film-card-row">
        <div class="film-card"></div>
        <div class="film-card"></div>
        <div class="film-card"></div>
        <div class="film-card"></div>
        <div class="film-card"></div>
    </div>
    <div class="film-card-row">
        <div class="film-card"></div>
        <div class="film-card"></div>
        <div class="film-card"></div>
        <div class="film-card"></div>
        <div class="film-card"></div>
    </div>
    <div class="film-card-row">
        <div class="film-card"></div>
        <div class="film-card"></div>
        <div class="film-card"></div>
        <div class="film-card"></div>
        <div class="film-card"></div>
    </div>

    <div class="next-page">
        <button id="next" class="archives-button">Next
            <svg width="24" height="24">
                <image href="././assets/icon/arrow_forward_24dp_FILL0_wght400_GRAD0_opsz24.svg"></image>
            </svg>
        </button>

    </div>
</div>
@endsection