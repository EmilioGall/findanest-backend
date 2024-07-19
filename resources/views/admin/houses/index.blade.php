@extends('layouts.admin')

@section('content')

   <div class="container">

      <div class="mt-3">

         @include('partials.session_message')

      </div>

      {{-- Search  Bar --}}
      {{-- <div class="">

         <form action="{{ route('search') }}" method="GET"
            class="form-inline d-flex align-items-center justify-content-between">

            <input class="form-control mx-2"
               type="search"
               name="query"
               placeholder="Cerca"
               aria-label="Search">

            <button class="btn btn-outline-success my-2" type="submit">Cerca</button>

         </form>

      </div> --}}

      {{-- Pagination Form --}}
      <div>

         <form action="{{ route('admin.house.index') }}" method="GET"
            class="d-flex justify-content-center align-items-center gap-3">
            @csrf

            <label for="per_page">Case visualizzate</label>
            <select name="per_page" id="per_page">
               <option value="5" @selected($houses->perPage() == 5)>5</option>
               <option value="10" @selected($houses->perPage() == 10)>10</option>
               <option value="15" @selected($houses->perPage() == 15)>15</option>
            </select>

            <button type="submit" class="btn btn-outline-success">Applica</button>

         </form>

      </div>

      {{-- Houses List --}}
      <div class="list-group pt-3">
         @if ($houses)
            <table class="table">

               <thead>

                  <tr>

                     <th scope="col">#</th>
                     <th scope="col">Immagine</th>
                     <th scope="col">Titolo</th>
                     <th scope="col">Indirizzo</th>
                     <th scope="col">Prezzo</th>
                     <th scope="col">Azioni</th>

                  </tr>

               </thead>

               <tbody>
                  @foreach ($houses as $index => $house)
                     <tr>

                        <th scope="row">{{ $index + 1 }}</th>

                        <td><img
                              src="{{ $house->image == 'https://placehold.co/300x150?text=Anteprima+non+disponibile' || $house->image == null ? 'https://placehold.co/300x150?text=Anteprima+non+disponibile' : asset('storage/' . $house->image) }}"
                              alt="userplaceholder"></td>

                        <td>{{ $house->title }}</td>

                        <td>{{ $house->address }}</td>

                        <td>{{ strpos($house->price, '.') !== false ? str_replace('.', ',', $house->price) : $house->price . ',00' }} €/notte</td>

                        <td>

                           <div class="d-flex gap-2">

                              <a class="btn btn-outline-primary"
                                 href="{{ route('admin.house.show', ['house' => $house->slug]) }}">
                                 <i class="fa-solid fa-eye"></i>
                              </a>

                              <a class="btn btn-outline-warning"
                                 href="{{ route('admin.house.edit', ['house' => $house->slug]) }}">
                                 <i class="fa-solid fa-pencil"></i>
                              </a>

                              {{-- Delete Button --}}
                              <form id="delete-form-{{ $house->id }}"
                                 action="{{ route('admin.house.destroy', ['house' => $house->slug]) }}" method="POST">
                                 @csrf
                                 @method('DELETE')

                                 <!-- Button trigger modal -->
                                 <button type="button"
                                    class="btn btn-outline-danger delete-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#delete-modal"
                                    data-house-title="{{ $house['title'] }}"
                                    data-house-id="{{ $house['id'] }}">
                                    <i class="fa-solid fa-trash"></i>
                                 </button>

                              </form>

                           </div>

                        </td>

                     </tr>
                  @endforeach
               </tbody>

            </table>

            {{-- Pagination Links --}}
            <div class="d-flex justify-content-center">

               {{ $houses->links() }}

            </div>
         @else
            <h1>Nessun risultato</h1>
         @endif
      </div>

   </div>

   {{-- destroy modal --}}
   @include('partials.delete-modal')

   <style>

      table {

         img {
            max-width: 100px;
            object-fit: cover;
         }
      }
   </style>

@endsection
