<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

   <head>

      <meta charset="utf-8">

      <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <title>{{ config('app.name', 'FindNest') }}</title>

      <!-- Fontawesome 6 cdn -->
      <link rel='stylesheet'
         href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css'
         integrity='sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=='
         crossorigin='anonymous'
         referrerpolicy='no-referrer' />

      <!-- Fav Icon --}}
      <link rel="icon" href="{{ asset('images/logo/findanest_logo_fav_1.png') }}" type="image/png">

      <!-- Fonts -->
      <link rel="dns-prefetch" href="//fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

      <!-- Usando Vite -->
      @vite(['resources/js/app.js'])

   </head>

   <body>

      {{-- NavBar --}}
      <nav class="navbar fixed-top navbar-light navbar-expand-md bg-dark px-3" data-bs-theme="dark">

         {{-- Logo image - Home Link --}}
         <a href="http://127.0.0.1:8000/" class="navbar-brand d-flex justify-content-center">
            <img src="{{ asset('images/logo/findnest_logo_blue_h1.png') }}" style="width: 150px; object-fit: contain"
               alt="Logo Findnest">
         </a>
         {{-- Logo image - Home Link --}}

         {{-- NavBar Button --}}
         <button class="navbar-toggler text-white" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
         </button>
         {{-- NavBar Button --}}

         {{-- NavBar Links --}}
         <div class="navbar-collapse collapse text-white rounded" id="menu">

            <ul class="navbar-nav bg-dark ms-auto my-2 rounded" style="list-style:none;">

               {{-- Home link --}}
               <li class="nav-item mx-3 fw-bold">
                  <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
               </li>
               {{-- Home link --}}

               {{-- Profile link --}}
               <li class="nav-item mx-3">
                  <a href="{{ route('profile.show') }}" class="nav-link">Ciao <span
                        class="fw-bold">{{ Auth::user()->name }}</span>!</a>
               </li>
               {{-- Profile link --}}

               {{-- Messages link --}}
               <li class="nav-item mx-3">
                  <a href="{{ route('admin.leads.index') }}" class="nav-link position-relative"><i
                        class="fa-regular fa-envelope fs-4"></i></a>
               </li>
               {{-- Messages link --}}

               {{-- Menu link --}}
               <li class="nav-item mx-3 dropdown">

                  {{-- Menu button link --}}
                  <a class="nav-link dropdown-toggle"
                     href="#"
                     id="dropdownMenuButton"
                     role="button"
                     data-bs-toggle="dropdown"
                     aria-expanded="false">
                     <i class="fa-solid fa-ellipsis fs-4"></i>
                  </a>
                  {{-- Menu button link --}}

                  {{-- Menu button list --}}
                  <ul class="dropdown-menu dropdown-menu-end mb-3" aria-labelledby="dropdownMenuButton">

                     <li><a class="dropdown-item" href="{{ route('profile.show') }}">Profilo</a></li>

                     <li><a class="dropdown-item" href="{{ route('admin.house.index') }}">Annunci</a>
                     </li>

                     <li>
                        <hr class="dropdown-divider">
                     </li>

                     <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           {{ __('Logout') }}
                        </a>
                        <form id="logout-form"
                           action="{{ route('logout') }}"
                           method="POST"
                           class="d-none">
                           @csrf
                        </form>
                     </li>

                  </ul>
                  {{-- Menu button list --}}

               </li>
               {{-- Menu link --}}

            </ul>

         </div>
         {{-- NavBar Links --}}

      </nav>
      {{-- /NavBar --}}

      {{-- Main Body --}}
      <div class="container-fluid vh-100 main-body">
         
         <div class="row h-100">
            
            {{-- SideBar --}}
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">

               <div class="position-sticky pt-3 custom-sidebar">

                  {{-- SideBar Links List --}}
                  <ul class="nav flex-column">

                     {{-- SideBar Profile Image & Name --}}
                     <li class="nav-item d-flex align-items-center justify-content-center flex-column">
                        <img id="userLogo" src="{{ asset('images/user-avatar.png') }}" alt="Immagine User">
                        {{ Auth::user()->name }}
                     </li>
                     {{-- SideBar Profile Image & Name --}}

                     {{-- SideBar Dashboard Link --}}
                     <li class="nav-item">
                        <a class="nav-link  {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}"
                           href="{{ route('admin.dashboard') }}">
                           <i class="fa-solid fa-tachometer-alt fa-lg fa-fw"></i> Dashboard
                        </a>
                     </li>
                     {{-- SideBar Dashboard Link --}}

                     {{-- SideBar Your House Link --}}
                     <li class="nav-item">
                        <a class="nav-link  {{ Route::currentRouteName() == 'admin.house.index' ? 'active' : '' }}"
                           href="{{ route('admin.house.index') }}">
                           <i class="fa-solid fa-house-laptop fa-lg fa-fw"></i> Le tue case
                        </a>
                     </li>
                     {{-- SideBar Your House Link --}}

                     {{-- SideBar New House Link --}}
                     <li class="nav-item">
                        <a class="nav-link  {{ Route::currentRouteName() == 'admin.house.create' ? 'active' : '' }}"
                           href="{{ route('admin.house.create') }}">
                           <i class="fa-solid fa-circle-plus fa-lg fa-fw"></i> Aggiungi Annuncio
                        </a>
                     </li>
                     {{-- SideBar New House Link --}}

                     {{-- SideBar Sponsorships Link --}}
                     <li class="nav-item">
                        <a class="nav-link  {{ Route::currentRouteName() == 'admin.sponsorships.index' ? 'active' : '' }}"
                           href="{{ route('admin.sponsorships.index') }}">
                           <i class="fa-solid fa-dollar-sign fa-lg fa-fw"></i> Sponsorizzazioni
                        </a>
                     </li>
                     {{-- SideBar Sponsorships Link --}}

                     {{-- SideBar Statistics Link --}}
                     <li class="nav-item">
                        <a class="nav-link  {{ Route::currentRouteName() == 'admin.statistics.index' ? 'active' : '' }}"
                           href="{{ route('admin.statistics.index') }}">
                           <i class="fa-solid fa-chart-simple fa-lg fa-fw"></i> Statistiche
                        </a>
                     </li>
                     {{-- SideBar Statistics Link --}}

                     {{-- SideBar Profile Link --}}
                     <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'profile.show' ? 'active' : '' }}"
                           href="{{ route('profile.show') }}">
                           <i class="fa-solid fa-user fa-lg fa-fw"></i> Profilo
                        </a>
                     </li>
                     {{-- SideBar Profile Link --}}

                     {{-- SideBar Messages Link --}}
                     <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'admin.leads.index' ? 'active' : '' }}"
                           href="{{ route('admin.leads.index') }}">
                           <i class="fa-solid fa-envelope fa-lg fa-fw"></i> Messaggi
                        </a>
                     </li>
                     {{-- SideBar Messages Link --}}

                     {{-- SideBar LogOut Link --}}
                     <li class="nav-item">

                        <a class="nav-link " href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           <i class="fa-solid fa-sign-out-alt fa-lg fa-fw"></i> Logout
                        </a>

                        <form id="logout-form"
                           action="{{ route('logout') }}"
                           method="POST"
                           class="d-none">
                           @csrf
                        </form>

                     </li>
                     {{-- SideBar LogOut Link --}}

                  </ul>
                  {{-- SideBar Links List --}}

               </div>

            </nav>
            {{-- /SideBar --}}

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
               @yield('content')
            </main>

         </div>

      </div>
      {{-- /Main Body --}}

   </body>


   <style>
      .main-body {
         padding-top: 60px;

         .custom-sidebar {
            /* border: 2px solid rgb(230, 133, 230);  */
            border-radius: 0 0 10px 10px;
            padding: 0rem 1rem 0rem;
            height: 85vh;
            overflow-x: hidden;
            /* box-shadow: 0 0 10px rgba(150, 7, 7, 0.47);  */
            /* margin-top: 2rem; */
            background-color: {{ env('color_light_grey') }};
   
            .nav-link {
               border-radius: 5px;
               border-radius: 5px;
               transition: background-color 0.5s ease, color 1s ease, opacity 0.5s ease;
               color: {{ env('color_dark_grey') }};
   
   
   
               &:hover {
                  color: black;
                  opacity: 50%;
                  background-color: {{ env('color_secondary') }};
   
               }
   
               &.active {
                  color: white;
                  width: 120%;
                  background-color: {{ env('color_secondary') }};
               }
   
            }
   
         }

      }


      .navbar {
         z-index: 1;
         box-shadow: 0px 0px 10px grey;
         height: 60px;

         .nav-item {

            a {
               transition: color 1s ease;
               color: {{ env('color_light_grey') }};

               &:hover {
                  color: {{ env('color_primary') }};

               }
            }


         }

         .navbar-brand img {
            /* width: 120px; */
            /* height: 50px; */
            object-fit: cover;
            margin-left: 15px;
         }

      }

      .nav {

         .nav-item {
            margin-top: 1rem;
            font-size: 1.1rem;
         }
      }

      #userLogo {
         width: 120px;
         height: 120px;
         object-fit: cover;
         border-radius: 50%;
         margin-bottom: 20px;
         box-shadow: 0px 5px 15px grey;
         background-color: white;
      }
   </style>

</html>
