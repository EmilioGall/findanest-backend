@extends('layouts.admin')

@section('content')
   <div class="container mt-5">

      <div class="container my-5">

         {{-- Show Header --}}
         <div class="row justify-content-between align-items-center py-3 border-bottom">

            {{-- Show Title --}}
            <div class="col-12 col-sm-10">

               <h1 class="fw-1 fs-1 text-main">Dettagli Casa</h1>

            </div>

            {{-- Button to Index --}}
            <div class="col-12 col-sm-2">

               <button type="button" class="btn btn-outline h-75 w-100 d-flex align-items-center justify-content-center">

                  <a href="{{ route('admin.house.index') }}">

                     <i class="fa-solid fa-angles-left"></i> Torna indietro

                  </a>

               </button>

            </div>

         </div>

         <div class="row align-items-stretch g-4 py-5">

            {{-- Cover Image --}}
            <div class="col-12 col-sm-5 col-lg-3">

               <div class="h-100 overflow-hidden shadow-lg"
                  style="background-image: url('{{ $house->image }}'); background-position: center; background-size: cover; background-repeat: no-repeat; min-height: 25vh;">
               </div>

            </div>

            <div class="col-12 col-sm-7 col-lg-9">

               <div class="card card-cover h-100 overflow-hidden bg-back shadow-lg">

                  <div class="d-flex flex-column justify-content-between h-100 p-5 pb-3 text-shadow-1">

                     {{-- House Name --}}
                     <h3 class="mb-4 display-6 lh-1">{{ $house->title }}</h3>

                     <div class="d-flex justify-content-between align-items-end mb-4">

                        {{-- House Info --}}
                        <ul class="d-flex flex-column justify-content-end list-unstyled mb-0">

                           {{-- House Address --}}
                           <li>
                              <h4 class="fs-3">Indirizzo: <em class="fs-4 fw-lighter">{{ $house->address }}</em>
                              </h4>
                           </li>

                           {{-- House Rooms --}}
                           <li>
                              <h4 class="fs-3">Stanze: <em class="fs-4 fw-lighter">{{ $house->rooms }}</em></h4>
                           </li>

                           {{-- House Beds --}}
                           <li>
                              <h4 class="fs-3">Letti: <em class="fs-4 fw-lighter">{{ $house->beds }}</em></h4>
                           </li>

                           {{-- House Bathrooms --}}
                           <li>
                              <h4 class="fs-3">Bagni: <em class="fs-4 fw-lighter">{{ $house->bathrooms }}</em>
                              </h4>
                           </li>

                        </ul>

                        {{-- House Price --}}
                        <div>

                           <h4 class="fs-3">Prezzo: <em class="fs-4 fw-lighter">{{ $house->price }} €/notte</em>
                           </h4>

                        </div>

                     </div>

                  </div>

               </div>

            </div>

            {{-- House Description --}}
            <div>

               <h4 class="fs-3">Descrizione: <em class="fs-4 fw-lighter">{{ $house->description }} Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit, odit distinctio. Unde, voluptatum. Quam molestiae accusamus non voluptatibus suscipit, corporis reprehenderit repudiandae veritatis assumenda inventore, quas illo placeat, modi quae.</em>
               </h4>

            </div>

         </div>

      </div>

   </div>


   <style>
      .text-main {
         color: {{ env('color_light_blue') }};
      }

      .bg-back {
         background-color: {{ env('color_light_grey') }};
         border-color: {{ env('color_light_grey') }};

      }

      .btn-outline {
         height: 50%;
         border-color: {{ env('color_light_blue') }};
         color: {{ env('color_light_blue') }};

         &:hover {
            color: white;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
            background-color: {{ env('color_light_blue') }};
         }
      }

      img {
         max-width: 300px;
         object-fit: contain;
      }
   </style>
@endsection
