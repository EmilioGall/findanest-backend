@extends('layouts.app')

@section('content')
   {{-- Hero Section --}}
   <div class="wrapper">
      <header class="hero-section">
         <div class="container">
            <div class="row align-items-center py-4 g-5">
               <div class="col-12 col-md-6">
                  <div class="text-center text-md-start">

                     <h1 class="display-md-2 display-4 fw-bold text-light pb-2">
                        <span class="text-main">Affitta </span>
                        con Facilità Guadagna senza Pensieri
                     </h1>

                     <p class=" lead text-light text-wrap">
                        Offri il tuo nido accogliente ai viaggiatori in cerca di un'esperienza unica: pubblica il tuo
                        annuncio e trasforma la tua casa in una destinazione da sogno, con la nostra piattaforma di
                        prenotazione semplice e veloce!
                     </p>

                  </div>
               </div>
            </div>
         </div>
      </header>
   </div>
   {{-- Hero Section --}}

   <style>
      .text-main {
         color: {{ env('color_light_green') }};
      }

      body {
         overflow-y: hidden;
      }

      img {
         max-width: 100%;
         object-fit: cover;
      }

      .hero-section {
         margin-top: 45px;
         height: 700px;
      }

      .text-color {
         color: {{ env('color_light_purple') }};
      }

      .wrapper {
         position: relative;
         background-repeat: no-repeat;
         background-size: cover;
         background-image: url({{ asset('images/sky2.jpg') }});
      }

   </style>
@endsection
