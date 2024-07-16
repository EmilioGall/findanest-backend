@extends('layouts.admin')

@section('content')
   <div class="container">

      <div class="container mt-5">

         <div class="row justify-content-between align-items-center py-3 border-bottom">

            <div class="col-12 col-sm-10">
   
               <h1 class="fw-1 fs-1 text-primary">House Details</h1>
   
            </div>
   
            <div class="col-12 col-sm-2">
   
               <button type="button"
                       class="btn btn-outline-primary h-75 w-100 d-flex align-items-center justify-content-center">
   
                  <a href="{{ route('admin.house.index') }}">
   
                     <i class="fa-solid fa-angles-left"></i> Go Back
   
                  </a>
   
               </button>
   
            </div>
   
         </div>
   
         <div class="row align-items-stretch g-4 py-5">
   
            {{-- Cover Image --}}
            <div class="col-12 col-sm-5 col-lg-3">
   
               <div class="card card-cover h-100 overflow-hidden rounded-4 shadow-lg"
                    style="background-image: url('{{ $house->image }}');  background-position: center; background-size: contain; background-repeat: no-repeat; min-height: 25vh;">
               </div>
   
            </div>

            {{-- @dd($house) --}}
   
            <div class="col-12 col-sm-7 col-lg-9">
   
               <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg">
   
                  <div class="d-flex flex-column justify-content-between h-100 p-5 pb-3 text-white text-shadow-1">
   
                     <h3 class="mb-4 display-6 lh-1 fw-bold">{{ $house->title }}</h3>
   
                     <div class="d-flex justify-content-between align-items-end mb-4">
   
                        <ul class="d-flex flex-column justify-content-end list-unstyled mb-0">
   
                           <li>
                              <h4 class="fs-3 fw-bold">Indirizzo: <em class="fs-4 fw-lighter">{{ $house->address }}</em></h4>
                           </li>
   
                           <li>
                              <h4 class="fs-3 fw-bold">Stanze: <em class="fs-4 fw-lighter">{{ $house->rooms }}</em>
                              </h4>
                           </li>
   
                           <li>
                              <h4 class="fs-3 fw-bold">Letti: <em class="fs-4 fw-lighter">{{ $house->beds }}</em>
                              </h4>
                           </li>

                           <li>
                              <h4 class="fs-3 fw-bold">Bagni: <em class="fs-4 fw-lighter">{{ $house->bathrooms }}</em>
                              </h4>
                           </li>
   
                        </ul>
   
                        <div>
                           <h4 class="fs-3 fw-bold">Prezzo: <em class="fs-4 fw-lighter">{{ $house->price }} $</em></h4>
                        </div>
   
                     </div>
   
                     <div>
                        <h4 class="fs-3 fw-bold">Descrizione:
                           <em class="fs-4 fw-lighter">{{ $house->description }}</em>
                        </h4>
                     </div>
   
                  </div>
   
               </div>
   
            </div>
   
         </div>

      </div>

   </div>
@endsection
