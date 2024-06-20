<!--  session_start() -->

<script src="{{ asset('assets/js/navbar.js') }}" defer></script>
<section id="header">
    <div id="navbar">
        <div id="menu-button">
            <button id="image-button">
            </button>


        </div>
        <div id="logo">
        </div>
    </div>
    <div id="menu-items">
        <a href="{{ route('home') }}">
            <img src="{{ asset('../assets/icon/home_24dp_FILL0_wght400_GRAD0_opsz24.png') }}">
            <span>Home</home>
        </a>
        @if (session()->has('logged'))
            <a href="{{ route('logout') }}">
                <img src="{{ asset('assets/icon/logout.png') }}">
                <span>Log out</span>
            </a>
        @else
            <a href="{{ route('login') }}">
                <img src="{{ asset('assets/icon/Profile.png') }}">
                <span>Effettua il login</span>
            </a>
        @endif
        <a href="Info.php">
            <img src="{{ asset('assets/icon/info.png')}}">
            <span>Info</span>
        </a>
        <a href="{{ route('archive') }}">
            <img src="{{ asset('assets/icon/inventory.png') }}">
            <span>Archivio</span>
        </a>


    </div>
</section>