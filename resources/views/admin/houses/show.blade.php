@extends('layouts.admin')

@section('content')
   <div class="container pt-4">

      {{-- Show Header --}}
      <div class="row justify-content-between align-items-center border-bottom">

         {{-- Show Title --}}
         <div class="col-12 col-sm-10">

            <h2 class="fw-1 fs-2 text-main">Dettagli Casa</h2>

         </div>

         {{-- Button to Index --}}
         <div class="col-12 col-sm-2 d-flex justify-content-end">

            <a type="button" class="btn btn-outline h-75 w-50 d-flex align-items-center justify-content-center"
               href="{{ route('admin.house.index', ['page' => $curPage, 'per_page' => $perPage]) }}">

               <i class="fa-solid fa-angles-left"></i>

            </a>

         </div>

      </div>

      <div class="row align-items-stretch g-4 pt-3 pb-2">

         {{-- Cover Image --}}
         <div class="col col-sm-5 col-lg-6">

            <div class="h-100 overflow-hidden shadow-lg"
               style=" background-position: center; background-size: cover; background-repeat: no-repeat; min-height: ;">
               <img class="h-100"
                  src="{{ substr($house->image, 0, 8) == 'https://' ? $house->image : asset('images/house_images/' . $house->image) }}"
                  alt="">
            </div>

         </div>

         <div class="col-12 col-sm-7 col-lg-6">

            <div class="card card-cover h-100 overflow-hidden bg-back shadow-lg">

               <div class="d-flex flex-column justify-content-between h-100 p-5 pb-3 text-shadow-1 text-custom-secondary">

                  {{-- House Name --}}
                  <h3 class="mb-4 display-6 lh-1">{{ $house->title }}</h3>

                  {{-- Services List --}}
                  <div>

                     <h4 class="fs-4">Servizi offerti:</h4>

                     <ul class="d-flex flex-wrap gap-2 p-0">

                        @foreach ($house->services as $service)
                           <li class="text-custom-secondary fs-6 fw-medium badge border badge-outline rounded-pill">
                              <em>{{ $service->service_name }}</em>
                           </li>
                        @endforeach


                     </ul>

                  </div>
                  {{-- Services List --}}

                  <div class="align-items-end mb-4">

                     {{-- House Info --}}
                     <ul class="d-flex flex-column justify-content-end list-unstyled mb-0">

                        {{-- House Address --}}
                        <li>
                           <h4 class="fs-4">Indirizzo: <em class="fs-5 fw-lighter">{{ $house->address }}</em>
                           </h4>
                        </li>

                        {{-- House Dimensions --}}
                        <li>
                           <h4 class="fs-4">Dimensione: <em class="fs-5 fw-lighter">{{ $house->sqm }} m²</em></h4>
                        </li>

                        {{-- House Rooms --}}
                        <li>
                           <h4 class="fs-4">Stanze: <em class="fs-5 fw-lighter">{{ $house->rooms }}</em></h4>
                        </li>

                        {{-- House Beds --}}
                        <li>
                           <h4 class="fs-4">Letti: <em class="fs-5 fw-lighter">{{ $house->beds }}</em></h4>
                        </li>

                        {{-- House Bathrooms --}}
                        <li class="d-flex justify-content-between">
                           <h4 class="fs-4">Bagni: <em class="fs-5 fw-lighter">{{ $house->bathrooms }}</em>
                           </h4>
                           {{-- House Price --}}
                           <h4 class="fs-4">Prezzo: <em
                                 class="fs-5 fw-lighter">{{ strpos($house->price, '.') !== false ? str_replace('.', ',', $house->price) : $house->price . ',00' }}
                                 €/notte</td></em>
                           </h4>
                        </li>

                     </ul>

                  </div>

               </div>

            </div>

         </div>

         {{-- House Description --}}
         <div class="m-3">

            <h4 class="fs-3 text-custom-secondary">Descrizione: <em class="fs-4 fw-lighter">{{ $house->description }}</em>
            </h4>

         </div>

      </div>

      {{-- Button to Add --}}
      <div class=" mb-5">

         <a type="button" class="btn btn-outline-warning"
            href="{{ route('admin.house.edit', ['house' => $house->slug, 'curPage' => $curPage, 'perPage' => $perPage]) }}">

            <i class="fa-solid fa-pen"></i> Modifica casa

         </a>

      </div>

   </div>

   <style>
      .text-custom-secondary {

         color: {{ env('color_dark_grey') }};
      }

      .btn-outline-warning:hover {

         color: white;
      }

      .text-main {
         color: {{ env('color_secondary') }};
      }

      .bg-back {
         background-color: {{ env('color_light_grey') }};
         border-color: {{ env('color_light_grey') }};

      }

      .badge-outline {
         box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2) !important;
         border-color: {{ env('color_secondary') }} !important;
         color: {{ env('color_secondary') }} !important;

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
   </style>
@endsection
