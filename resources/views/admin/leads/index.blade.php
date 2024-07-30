@extends('layouts.admin')

@php
   use Carbon\Carbon;
@endphp


@section('content')
   <div class="container pt-4 text-custom-secondary">

      {{-- Messages Header --}}
      <div class="row justify-content-between align-items-center border-bottom">

         {{-- Messages Title --}}
         <div class="col-12 col-sm-10">

            <h2 class="fw-1 fs-2 text-main">Richieste di contatto</h2>

         </div>

         {{-- Button to Index --}}
         <div class="col-12 col-sm-2 d-flex justify-content-end">

            <a type="button" class="btn btn-outline h-75 w-50 d-flex align-items-center justify-content-center"
               href="{{ route('admin.house.index') }}">

               <i class="fa-solid fa-angles-left"></i>

            </a>

         </div>

      </div>
      {{-- /Messages Header --}}

      <form method="GET" action="{{ route('admin.leads.index') }}" class="pt-3">
         <div class="col-4">
            <div class="mb-3">
               <label for="house_id" class="form-label"><small>Seleziona la casa per visualizzare i
                     messaggi</small></label>
               <select class="form-select"
                  id="house_id"
                  name="house_id"
                  onchange="this.form.submit()">
                  <option value="">Tutte le case</option>
                  @foreach ($houses as $house)
                     <option value="{{ $house->id }}" {{ $house->id == $houseId ? 'selected' : '' }}>
                        {{ $house->title }}
                     </option>
                  @endforeach
               </select>
            </div>
         </div>

      </form>

      <table class="table">
         <thead>
            <tr>
               <th scope="col">#</th>
               {{-- <th scope="col">Stato</th> --}}
               <th scope="col">Nome</th>
               <th scope="col">E-Mail</th>
               <th scope="col">Telefono</th>
               <th scope="col">Ricevuto il</th>
               <th scope="col">Azioni</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($leads as $index => $lead)
               <tr>
                  <th scope="row">{{ $index + 1 }}</th>
                  {{-- <td class="col-auto">
                            <select
                                class="form-select form-select-sm badge rounded-pill {{ $lead->status == 'closed' ? 'bg-warning' : ($lead->status == 'handled' ? 'bg-warning' : 'bg-success') }}"
                                id="autoSizingSelect">
                                <option value="new" {{ $lead->status == 'new' ? 'selected' : '' }}>Nuovo</option>
                                <option value="handled" {{ $lead->status == 'handled' ? 'selected' : '' }}>Gestito</option>
                                <option value="closed" {{ $lead->status == 'closed' ? 'selected' : '' }}>Chiuso</option>
                            </select>
                        </td> --}}

                  <td>{{ $lead->name }}</td>
                  <td>{{ $lead->email }}</td>
                  <td>{{ $lead->phone_number }}</td>
                  <td>{{ Carbon::parse($lead->created_at)->format('d/m/Y H:i') }}</td>
                  <td>
                     <div class="d-flex gap-2">
                        <a class="btn btn-sm btn-full" href="{{ route('admin.leads.show', ['lead' => $lead->id]) }}">
                           <span>Dettagli</span>
                        </a>
                     </div>
                  </td>
               </tr>
            @endforeach
         </tbody>
      </table>
      <div>
         {{ $leads->links() }}
      </div>
   </div>

   <style>
      .btn-details {
         background-color: {{ env('color_secondary') }};
         border-color: {{ env('color_secondary') }};
         color: #FFFFFF;
      }

      .btn-details:hover {
         color: white;
         box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
         background-color: {{ env('color_secondary') }};
         border-color: {{ env('color_secondary') }};
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
