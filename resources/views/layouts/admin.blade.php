<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fontawesome 6 cdn -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css'
        integrity='sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=='
        crossorigin='anonymous' referrerpolicy='no-referrer' />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">
        <div class="navbar navbar-light bg-light navbar-expand-md px-3">
            <a href="#" class="navbar-brand">
                <img src="{{ asset('images/logo.png') }}" alt="">
            </a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="menu">
                <ul class="navbar-nav ms-auto" style="list-style:none;">

                    {{-- home --}}
                    <li class="nav-item mx-3">
                        <a href="#" class="nav-link">Home</a>
                    </li>

                    <li class="nav-item mx-3">
                        <a href="#" class="nav-link">Nome Utente Dinamico</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link position-relative"><i class="fa-solid fa-comment-dots fs-3"></i></a>
                    </li>
                    <li class="nav-item mx-3 dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuButton" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-ellipsis fs-4"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="#">Profilo</a></li>
                            <li><a class="dropdown-item" href="#">Annunci</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>              
                </ul>
            </div>
        </div>





          {{-- old --}}
        {{-- <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-2 shadow">

            <div class="row justify-content-between"> --}}

                {{-- Logo --}}
                {{-- <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/">
                    <i class="fa-solid fa-network-wired"></i>
                    Find-A-Nest
                </a>
                
                <button class="navbar-toggler position-absolute d-md-none collapsed" type="button"
                    data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

            </div>

            <div class="navbar-nav">

                
                
                <div class="nav-item text-nowrap ms-2">

                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>


                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    
                </div>

            </div>

        </header> --}}





        <div class="container-fluid vh-100">
            <div class="row h-100">              
                {{-- navbar --}}
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                    <div class="position-sticky pt-3 custom-sidebar">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link  {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}"
                                   href="{{ route('admin.dashboard') }}">
                                    <i class="fa-solid fa-tachometer-alt fa-lg fa-fw"></i> Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link  {{ Route::currentRouteName() == 'admin.house.index' ? 'active' : '' }}"
                                   href="{{ route('admin.house.index') }}">
                                    <i class="fa-solid fa-house-laptop fa-lg fa-fw"></i> I tuoi Annunci
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link  {{ Route::currentRouteName() == 'admin.house.create' ? 'active' : '' }}"
                                   href="{{ route('admin.house.create') }}">
                                    <i class="fa-solid fa-circle-plus fa-lg fa-fw"></i> Aggiungi Annuncio
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="#">
                                    <i class="fa-solid fa-user fa-lg fa-fw"></i> Profilo
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="#">
                                    <i class="fa-solid fa-cog fa-lg fa-fw"></i> Impostazioni
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-sign-out-alt fa-lg fa-fw"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </nav>
                
                
                

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    @yield('content')
                </main>
            </div>
        </div>

    </div>
</body>
<style>
.custom-sidebar {
    background-color: white;
    /* border: 2px solid rgb(230, 133, 230);  */
    border-radius: 15px; 
    padding: 15px; 
    height: 60vh; 
    /* box-shadow: 0 0 10px rgba(150, 7, 7, 0.47);  */
    margin-top: 2rem;
}

.custom-sidebar .nav-link {
    color: black; 
}

.custom-sidebar .nav-link:hover {
    background-color: rgba(128, 0, 128, 0.1); 
    border-radius: 15px;
}

.custom-sidebar .nav-link.active {
    color: white; 
    background-color: #5D6D7E ; 
    border-radius: 15px; 
}
.navbar-brand img {
    width: 120px; 
    /* height: 50px; */
    object-fit: cover; 
    margin-left: 15px;
}
.nav{
   .nav-item{
    margin-top: 2rem;
    font-size: 1.3rem;
} 
}

</style>

</html>
