@extends('layouts.admin')

@section('content')
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         {{ __('Your Profile') }}
      </h2>
   </x-slot>

   <div class="container pt-4 text-custom-secondary">

      <div>

         <div class="p-6">

            {{-- Profile Header --}}
            <div class="row justify-content-between align-items-center border-bottom">

               {{-- Profile Title --}}
               <div class="col-12 col-sm-10">

                  <h2 class="fw-1 fs-2 text-main">Il tuo profilo</h2>

               </div>

               {{-- Button to Index --}}
               <div class="col-12 col-sm-2 d-flex justify-content-end">

                  <a type="button" class="btn btn-outline h-75 w-50 d-flex align-items-center justify-content-center"
                     href="{{ route('admin.house.index') }}">

                     <i class="fa-solid fa-angles-left"></i>

                  </a>

               </div>

            </div>
            {{-- /Profile Header --}}

            <div class="pt-3">

               <p class="fs-5"><span class="fw-bold">Nome:</span> {{ $user->name }}</p>
   
               <p class="fs-5"><span class="fw-bold">Cognome:</span> {{ $user->surname }}</p>
   
               <p class="fs-5"><span class="fw-bold">Data di nascita:</span>
   
                  {{ $user->date_of_birth ? $user->date_of_birth->format('d/m/Y') : '' }}</p>
   
               <p class="fs-5"><span class="fw-bold">Email:</span> {{ $user->email }}</p>

            </div>

         </div>

      </div>

   </div>

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
   </style>
@endsection
