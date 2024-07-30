@extends('layouts.admin')

@php
   use Carbon\Carbon;
@endphp

@section('content')
   <div class="container pt-4 text-custom-secondary">

      {{-- Messages Header --}}
      <div class="row justify-content-between align-items-center border-bottom">

         {{-- Messages Title --}}
         <div class="col-12 col-sm-6">

            <h2 class="fw-1 fs-2 text-main">Dettagli Messaggio</h2>

         </div>

         {{-- Button to Index --}}
         <div class="col-12 col-sm-6 d-flex justify-content-end">

            <a type="button" class="btn btn-outline h-75 w-50 d-flex align-items-center justify-content-center"
               href="{{ route('admin.leads.index', ['house_id' => $houseId]) }}">

               <i class="fa-solid fa-angles-left"></i>
               <span class="ps-1">Torna alla lista messaggi</span>

            </a>

         </div>

      </div>
      {{-- /Messages Header --}}

      <div class="row pt-3">
         <div class="col-8">
            <!-- Casa -->
            <div class="row mb-4 border rounded py-2">
               <div class="col-sm-4 col-md-2 d-flex align-items-center">
                  <h6 class="mb-0 fw-bold">Casa</h6>
               </div>
               <div class="col-sm-8 col-md-6">
                  {{ $house->title }}
               </div>
            </div>


            <!-- Nome -->
            <div class="row mb-4">
               <div class="col-sm-4 col-md-2 d-flex align-items-start">
                  <h6 class="mb-0 fw-bold">Nome</h6>
               </div>
               <div class="col-sm-8 col-md-10">
                  {{ $lead->name }}
               </div>
            </div>

            <!-- E-mail -->
            <div class="row mb-4">
               <div class="col-sm-4 col-md-2 d-flex align-items-start">
                  <h6 class="mb-0 fw-bold">E-Mail</h6>
               </div>
               <div class="col-sm-8 col-md-10">
                  {{ $lead->email }}
               </div>
            </div>

            <!-- Telefono -->
            <div class="row mb-4">
               <div class="col-sm-4 col-md-2 d-flex align-items-start">
                  <h6 class="mb-0 fw-bold">Telefono</h6>
               </div>
               <div class="col-sm-8 col-md-10">
                  {{ $lead->phone_number }}
               </div>
            </div>

            <!-- Messaggio -->
            <div class="row mb-4">
               <div class="col-sm-4 col-md-2 d-flex align-items-start">
                  <h6 class="mb-0 fw-bold">Messaggio</h6>
               </div>
               <div class="col-sm-8 col-md-10">
                  {{ $lead->message }}
               </div>
            </div>
         </div>
      </div>

   </div>

   <style>
      .btn-back {
         height: 50%;
         border-color: {{ env('color_light_purple') }};
         color: {{ env('color_light_purple') }};

         &:hover {
            color: white;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
            background-color: {{ env('color_light_purple') }};
         }
      }

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
