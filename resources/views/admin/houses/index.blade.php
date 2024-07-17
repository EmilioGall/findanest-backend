@extends('layouts.admin')

@section('content')

   <div class="container">

      {{-- Search  Bar --}}
      <div class="">

         <form action="{{ route('search') }}" method="GET"
            class="form-inline d-flex align-items-center justify-content-between">

            <input class="form-control mx-2"
               type="search"
               name="query"
               placeholder="Cerca"
               aria-label="Search">

            <button class="btn btn-outline-success my-2" type="submit">Cerca</button>

         </form>

      </div>

      {{-- Houses List --}}
      <div class="list-group">

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

                        <td><img class="w-50" src="{{ asset('storage/' . $house->image) }}" alt=""></td>

                        <td>{{ $house->title }}</td>

                        <td>{{ $house->address }}</td>

                        <td>{{ $house->price }} €/notte</td>

                        <td>

                           <div class="d-flex gap-2">

                              <a class="btn btn-primary"
                                 href="{{ route('admin.house.show', ['house' => $house->slug]) }}"><i
                                    class="fa-solid fa-eye"></i></a>

                              <a class="btn btn-warning text-white" href=""><i class="fa-solid fa-pencil"></i></a>

                              <a class="btn btn-danger" href=""><i class="fa-solid fa-trash"></i></a>

                           </div>

                        </td>

                     </tr>
                  @endforeach
               </tbody>

            </table>
         @else
            <h1>Nessun risultato</h1>
         @endif

      </div>

   </div>

   <style>
      img {
         height: 50px;
         object-fit: cover;
      }
   </style>
@endsection
