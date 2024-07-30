@extends('layouts.admin')

@section('content')

   <body id="dashboard_id">

      {{-- Menu Grid --}}
      <div class="container pt-4 text-custom-secondary">

         {{-- Dashboard Overview Header --}}
         <div class="row justify-content-between align-items-center border-bottom">

            {{-- Dashboard Overview Title --}}
            <div class="col-12 col-sm-10">

               <h2 class="fw-1 fs-2 text-main">Panoramica</h2>

            </div>

         </div>
         {{-- /Dashboard Overview Header --}}

         {{-- General Statistics --}}
         <div class="row pt-3 pb-4">
            <div class="col-md-4">
               <div class="h-100 d-flex align-items-center justify-content-center border rounded stats-top">
                  <i class="fas fa-house me-3"></i>
                  <span class="fs-5">Case inserite: <strong class="ms-2">{{ $totalHouses }}</strong></span>
               </div>
            </div>
            <div class="col-md-4">
               <div class="h-100 d-flex align-items-center justify-content-center border rounded stats-top">
                  <i class="fas fa-dollar-sign me-3"></i>
                  <span class="fs-5">Sponsorizzazioni attive: <strong
                        class="ms-2">{{ $activeSponsorships }}</strong></span>
               </div>
            </div>
            <div class="col-md-4">
               <div class="h-100 d-flex align-items-center justify-content-center border rounded stats-top">
                  <i class="fas fa-envelope me-3"></i>
                  <span class="fs-5">Messaggi ricevuti: <strong class="ms-2">{{ $totalMessages }}</strong></span>
               </div>
            </div>
         </div>
         {{-- /General Statistics --}}

         {{-- Dashboard Navigator Header --}}
         <div class="row justify-content-between align-items-center border-bottom">

            {{-- Dashboard Navigator Title --}}
            <div class="col-12 col-sm-10">

               <h2 class="fw-1 fs-2 text-main">Pulsanti di navigazione</h2>

            </div>

         </div>
         {{-- /Dashboard Navigator Header --}}

         {{-- Nav Buttons --}}
         <div class="row g-3 pt-3 pb-4">

            {{-- YourHouses Button --}}
            <div class="col-md-4">
               <a class="w-100" href="{{ route('admin.house.index') }}">
                  <div class="card rounded-3">
                     <div class="card-body">
                        <i class="fas fa-home card-icon"></i>
                        <div class="card-text">Le tue case</div>
                     </div>
                  </div>
               </a>
            </div>
            {{-- YourHouses Button --}}

            {{-- Statistics Button --}}
            <div class="col-md-4">
               <a class="w-100" href="{{ route('admin.statistics.index') }}">
                  <div class="card rounded-3">
                     <div class="card-body">
                        <i class="fas fa-chart-simple card-icon"></i>
                        <div class="card-text">Statistiche</div>
                     </div>
                  </div>
               </a>
            </div>
            {{-- Statistics Button --}}

            {{-- Profile Button --}}
            <div class="col-md-4">
               <a class="w-100" href="{{ route('profile.show') }}">
                  <div class="card rounded-3">
                     <div class="card-body">
                        <i class="fas fa-user card-icon"></i>
                        <div class="card-text">Utente</div>
                     </div>
                  </div>
               </a>
            </div>
            {{-- Profile Button --}}

            {{-- Messages Button --}}
            <div class="col-md-4">
               <a class="w-100" href="{{ route('admin.leads.index') }}">
                  <div class="card rounded-3">
                     <div class="card-body">
                        <i class="fas fa-envelope card-icon"></i>
                        <div class="card-text">Messaggi</div>
                     </div>
                  </div>
               </a>
            </div>
            {{-- Messages Button --}}

            {{-- Sponsorships Button --}}
            <div class="col-md-4">
               <a class="w-100" href="{{ route('admin.sponsorships.index') }}">
                  <div class="card rounded-3">
                     <div class="card-body">
                        <i class="fas fa-dollar-sign card-icon"></i>
                        <div class="card-text">Sponsorizzazioni</div>
                     </div>
                  </div>
               </a>
            </div>
            {{-- Sponsorships Button --}}

            {{-- Logout Button --}}
            <div class="col-md-4">
               <a class="nav-link" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                  <div class="card rounded-3">
                     <div class="card-body">
                        <i class="fas fa-power-off card-icon"></i>
                        <div class="card-text">Logout</div>
                     </div>
                  </div>
               </a>
            </div>
            {{-- Logout Button --}}

         </div>
         {{-- /Nav Buttons --}}

      </div>
      {{-- Menu Grid --}}

   </body>

   <style>
      .text-main {
         color: {{ env('color_secondary') }};
      }

      .text-custom-secondary {

         color: {{ env('color_dark_grey') }};
      }

      .btn-outline {
         height: 50%;
         border-color: {{ env('color_secondary') }};
         color: {{ env('color_secondary') }};

         &:hover {
            color: white;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
            background-color: {{ env('color_secondary') }};
         }
      }

      .btn-full {
         color: white;
         box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);

         background-color: {{ env('color_secondary') }};

         &:hover {
            box-shadow: none;
            border-color: {{ env('color_secondary') }};
            color: {{ env('color_secondary') }};

         }
      }

      .stats-top {
         padding: 1em;
         color: {{ env('color_dark_grey') }};
         border-color: {{ env('color_secondary') }} !important;

         i {
            color: {{ env('color_secondary') }};
            font-size: 2rem;
         }

         strong {
            color: {{ env('color_dark_grey') }};
            font-size: 1.7rem;
         }

      }


      .card {
         height: 250px;
         border-radius: 15px;
         display: flex;
         justify-content: center;
         align-items: center;
         transition: background .9s ease, color 1s ease, transform .6s ease, box-shadow .6s ease;
         border-color: {{ env('color_secondary') }} !important;
         color: {{ env('color_dark_grey') }};

         &:hover {

            background: radial-gradient(circle, {{ env('color_secondary') }} 5%, {{ env('color_light_grey') }} 100%);
            color: #333;
            transform: scale(1.05);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
         }
      }


      .card-icon {
         font-size: 70px;
         text-align: center;
         margin-bottom: 10px;
      }

      .card-text {
         text-align: center;
         margin-top: 10px;
         font-size: 20px;
      }

      .card-body {
         display: flex;
         flex-direction: column;
         justify-content: center;
         align-items: center;
         height: 100%;
      }

      a {
         text-decoration: none;
         color: inherit;
      }
   </style>
@endsection
