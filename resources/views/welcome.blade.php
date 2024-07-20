@extends('layouts.app')

@section('content')
   <div class="jumbotron p-5 mb-4 rounded-3">

      <div class="container py-3">
         <div class="row align-items-center py-4 g-5">
            <div class="col-12 col-md-6">
              <div class="text-center text-md-start">
                <h1 class="display-md-2 display-4 fw-bold text-dark pb-2">
                  <span class="text-primary">Affitta con facilità </span>guadagna senza pensieri!
                </h1>
                <p class="lead">
                  Benvenuto nel tuo nuovo nido accogliente, il luogo ideale per
               trasformare ogni soggiorno in un'esperienza unica e indimenticabile. Con le nostre soluzioni per affitti
               brevi, troverai il massimo del comfort e della comodità, che tu sia in viaggio per lavoro o per piacere.
               Scopri la nostra ampia gamma di opzioni e lasciati coccolare dalla nostra ospitalità.
                </p>
                <button
                  class="btn btn-primary px-5 py-3 mt-3 fs-5 fw-medium"
                  type="button"
                >
                  Pubblica Il Tuo Primo Annuncio
                </button>
              </div>
            </div>
            <div class="col-12 col-md-6">
               <img src="{{ asset('images/jumbo.jpg') }}"  alt="logo findanest">
            </div>
          </div>

         <div class="logo text-center">

           

            
               
         </div>

      </div>

   </div>
@endsection
