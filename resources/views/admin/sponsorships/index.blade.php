@extends('layouts.admin')

@php
   use Carbon\Carbon;
@endphp

@section('content')
   <div class="container pt-4 text-custom-secondary">

      {{-- Sponsorships Header --}}
      <div class="row justify-content-between align-items-center border-bottom">

         {{-- Sponsorships Title --}}
         <div class="col-12 col-sm-10">

            <h2 class="fw-1 fs-2 text-main">Sponsorizza i tuoi annunci</h2>

         </div>

         {{-- Button to Index --}}
         <div class="col-12 col-sm-2 d-flex justify-content-end">

            <a type="button" class="btn btn-outline h-75 w-50 d-flex align-items-center justify-content-center"
               href="{{ route('admin.house.index') }}">

               <i class="fa-solid fa-angles-left"></i>

            </a>

         </div>

      </div>
      {{-- /Sponsorships Header --}}

      <form method="GET" action="{{ route('admin.sponsorships.index') }}" class="pb-4 pt-3">
         <div class="col-4">
            <div class="mb-3">
               <label for="house_id" class="form-label"><small>Seleziona la casa da sponsorizzare</small></label>
               <select class="form-select"
                  id="house_id"
                  name="house_id"
                  onchange="this.form.submit()">
                  <option value="">Tutte le case</option>
                  @foreach ($houses as $house)
                     <option value="{{ $house->id }}"
                        {{ $selectedHouse && $selectedHouse->id == $house->id ? 'selected' : '' }}>
                        {{ $house->title }}
                     </option>
                  @endforeach
               </select>
            </div>
         </div>
      </form>

      @if ($selectedHouse)

         {{-- Details card --}}
         <h4 class="pb-2">Situazione</h4>

         <div class="row">

            <!-- Card per i dettagli della casa -->
            <div class="col-md-8 h-100">

               <div class="card card-premium">

                  <div class="card-header fw-bold style-full-header">

                     <i class="fa-solid fa-house fa-lg fa-fw me-2"></i>

                     <span class="ms-1">Dettagli dell'annuncio</span>

                  </div>

                  <div class="card-body">

                     <p><span class="fw-bold text-evident">{{ $selectedHouse->title }}</span> </p>

                     <p><span class="fw-bold">Indirizzo:</span> {{ $selectedHouse->address }}</p>

                     <p><span class="fw-bold">Descrizione:</span> {{ $selectedHouse->description }}</p>

                  </div>

               </div>

            </div>

            <!-- Card per le sponsorizzazioni attive -->
            <div class="col-md-4">

               <div class="card h-100">

                  <div class="card-header">

                     <i class="fa-solid fa-dollar-sign fa-lg fa-fw"></i>

                     <span class="ms-1">Sponsorizzazioni attive</span>

                  </div>

                  <div class="card-body">

                     @if ($activeSponsorships->isEmpty())
                        Nessuna sponsorizzazione attiva
                     @else
                        <ol class="list-group list-group-numbered">
                           @foreach ($activeSponsorships as $sponsorship)
                              <li class="list-group-item border-0">
                                 <span class="fw-bold">{{ $sponsorship->type_name }}</span>
                                 di <span
                                    class="fw-bold">{{ number_format(explode(':', $sponsorship->type_duration)[0] / 24) }}gg</span>
                                 valida fino al
                                 {{ Carbon::parse($sponsorship->pivot->expire_date)->format('d/m/Y') }}
                              </li>
                           @endforeach
                        </ol>
                     @endif

                  </div>

               </div>

            </div>

         </div>

         <!-- Sponsorship cards -->
         <section>

            <h4 class="pt-5 pb-2">Aggiungi un pacchetto di sponsorizzazione</h4>

            <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">

               <div class="col h-100">

                  <div class="card mb-4 rounded-3 shadow-sm h-100">

                     <div class="card-header py-3">

                        <h4 class="my-0 fw-normal">
                           <i class="fa-solid fa-star text-evident"></i>
                           <span class="ms-1">Essential</span>
                        </h4>

                     </div>

                     <div class="card-body">

                        <h1 class="card-title pricing-card-title">2,99 €<small class="text-body-secondary fw-light">/1gg</small></h1>

                        <ul class="list-unstyled mt-3 mb-4">

                           <li>24h di sponsorizzazione</li>
                           <li>Pagamento sicuro con Carta di Credito</li>
                           <li class="fs-5 text-evident pt-2">
                              <i class="fa-brands fa-paypal"></i>
                              <i class="fa-brands fa-cc-visa"></i>
                              <i class="fa-brands fa-cc-mastercard"></i>
                              <i class="fa-brands fa-cc-amex"></i>
                              <i class="fa-brands fa-apple-pay"></i>
                              <i class="fa-brands fa-google-pay"></i>
                           </li>

                        </ul>

                        <form action="{{ route('admin.sponsorships.payment.form') }}" method="get">

                           <input type="hidden" name="house_id" value="{{ $selectedHouse->id }}">
                           <input type="hidden" name="sponsorship_id" value="1">
                           <input type="hidden" name="type" value="essential">
                           <input type="hidden" name="price" value="2.99">
                           <input type="hidden" name="duration" value="24">

                           <button type="submit" class="w-100 btn btn-lg style-outline">Acquista ora</button>

                        </form>

                     </div>

                  </div>

               </div>

               <div class="col h-100">

                  <div class="card mb-4 rounded-3 shadow-sm h-100">

                     <div class="card-header py-3">

                        <h4 class="my-0 fw-normal">
                           <i class="fa-solid fa-star text-evident"></i>
                           <i class="fa-solid fa-star text-evident"></i>
                           <span class="ms-1">Regular</span>
                        </h4>

                     </div>

                     <div class="card-body">

                        <h1 class="card-title pricing-card-title">5,99 €<small class="text-body-secondary fw-light">/3gg</small></h1>

                        <ul class="list-unstyled mt-3 mb-4">

                           <li>72h di sponsorizzazione</li>
                           <li>Pagamento con Carta di Credito</li>
                           <li class="fs-5 text-evident pt-2">
                              <i class="fa-brands fa-paypal"></i>
                              <i class="fa-brands fa-cc-visa"></i>
                              <i class="fa-brands fa-cc-mastercard"></i>
                              <i class="fa-brands fa-cc-amex"></i>
                              <i class="fa-brands fa-apple-pay"></i>
                              <i class="fa-brands fa-google-pay"></i>
                           </li>

                        </ul>

                        <form action="{{ route('admin.sponsorships.payment.form') }}" method="get">

                           <input type="hidden" name="house_id" value="{{ $selectedHouse->id }}">
                           <input type="hidden" name="sponsorship_id" value="2">
                           <input type="hidden" name="type" value="regular">
                           <input type="hidden" name="price" value="5.99">
                           <input type="hidden" name="duration" value="72">

                           <button type="submit" class="w-100 btn btn-lg style-outline">Acquista ora</button>

                        </form>

                     </div>

                  </div>

               </div>

               <div class="col h-100">

                  <div class="card mb-4 rounded-3 shadow-sm card-premium h-100">

                     <div class="card-header card-header-premium">

                        <h4 class="my-0 fw-normal">
                           <i class="fa-solid fa-star text-white"></i>
                           <i class="fa-solid fa-star text-white"></i>
                           <i class="fa-solid fa-star text-white"></i>
                           <span class="ms-1">Premium</span>
                        </h4>

                     </div>

                     <div class="card-body">

                        <h1 class="card-title pricing-card-title">9,99 €<small class="text-body-secondary fw-light">/6gg</small></h1>

                        <ul class="list-unstyled mt-3 mb-4">

                           <li>144h di sponsorizzazione</li>
                           <li>Pagamento con Carta di Credito</li>
                           <li class="fs-5 text-evident pt-2">
                              <i class="fa-brands fa-paypal"></i>
                              <i class="fa-brands fa-cc-visa"></i>
                              <i class="fa-brands fa-cc-mastercard"></i>
                              <i class="fa-brands fa-cc-amex"></i>
                              <i class="fa-brands fa-apple-pay"></i>
                              <i class="fa-brands fa-google-pay"></i>
                           </li>

                        </ul>

                        <form action="{{ route('admin.sponsorships.payment.form') }}" method="get">

                           <input type="hidden" name="house_id" value="{{ $selectedHouse->id }}">
                           <input type="hidden" name="sponsorship_id" value="3">
                           <input type="hidden" name="type" value="premium">
                           <input type="hidden" name="price" value="9.99">
                           <input type="hidden" name="duration" value="144">

                           <button type="submit" class="w-100 btn btn-lg style-full">Acquista ora</button>

                        </form>

                     </div>

                  </div>

               </div>

            </div>
            
         </section>

      @endif

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

      .style-outline {
         height: 50%;
         border-color: {{ env('color_secondary') }};
         color: {{ env('color_secondary') }};
      }

      .style-outline:hover {
         color: white;
         box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
         background-color: {{ env('color_secondary') }};
      }

      .style-full,
      .style-full-header {
         height: 50%;
         background-color: {{ env('color_secondary') }};
         color: #FFFFFF;
      }

      .style-full:hover {
         color: white;
         box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
         background-color: {{ env('color_primary') }};
      }

      .card-premium {
         border: 1px solid {{ env('color_secondary') }};
      }

      .card-header-premium {
         background-color: {{ env('color_secondary') }};
         color: #FFFFFF;
         padding: 1rem;
      }

      .text-evident {
         color: {{ env('color_secondary') }};
      }
   </style>
@endsection
