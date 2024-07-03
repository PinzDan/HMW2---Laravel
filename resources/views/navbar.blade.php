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
            <svg width="50px" height="50px">
                <image href="{{ asset('../assets/icon/home_24dp_FILL0_wght400_GRAD0_opsz24.svg')}}" width="50px"
                    height="50px"></image>
            </svg>
            <span>Home</home>
        </a>
        <a href="{{ route('info') }}">
            <svg width="50px" height="50px">
                <image href="{{ asset('assets/icon/info.svg')}}" width="50px" height="50px"></image>
            </svg>
            <span>Info</span>
        </a>
        <a href="{{ route('archive') }}">
            <svg width="50px" height="50px">
                <image href="{{ asset('assets/icon/inventory.svg')}}" width="50px" height="50px"></image>
            </svg>
            <span>Archivio</span>
        </a>
        @if (session()->has('logged'))
            <a href="{{ route('setting') }}">
                <svg width="50px" height="50px">
                    <image href="{{ asset('../assets/icon/manage_accounts_24dp_FILL0_wght400_GRAD0_opsz24.svg')}}"
                        width="50px" height="50px"></image>
                </svg>
                <span>Impostazioni account</span>
            </a>
            <a href="{{ route('logout') }}">
                <svg width="50px" height="50px">
                    <image href="{{ asset('assets/icon/logout.svg')}}" width="50px" height="50px"></image>
                </svg>
                <span>Log out</span>
            </a>
        @else
            <a href="{{ route('login') }}">
                <svg width="50px" height="50px">
                    <image href="{{ asset('assets/icon/Profile.png')}}" width="50px" height="50px"></image>
                </svg>
                <span>Effettua il login</span>
            </a>
        @endif


    </div>
</section>