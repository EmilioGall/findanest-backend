@extends('layouts.admin')

@section('content')

   <div class="container pt-4 text-custom-secondary">

      <div class="mt-2">

         @include('partials.session_message')

      </div>

      {{-- Index Header --}}
      <div class="row justify-content-between align-items-center border-bottom">

         {{-- Index Title --}}
         <div class="col-12 col-sm-6">

            <h2 class="fw-1 fs-2 text-main">Le tue case</h2>

         </div>

         {{-- Pagination Form --}}
         <form action="{{ route('admin.house.index') }}" method="GET"
            class="col-6 d-flex justify-content-end align-items-center text-custom-secondary">
            @csrf

            <div class="input-group d-flex justify-content-end h-50">

               <select class="input-group-text" name="per_page" id="per_page">

                  <option value="5" @selected($houses->perPage() == 5)>5</option>

                  <option value="10" @selected($houses->perPage() == 10)>10</option>

                  <option value="15" @selected($houses->perPage() == 15)>15</option>

               </select>

               <button type="submit" class="btn btn-outline input-group-text">Applica</button>

            </div>

         </form>

      </div>
      {{-- /Index Header --}}

      {{-- Houses List --}}
      <div class="list-group pt-3">
         @if ($houses)
            <table class="table">

               <thead>

                  <tr>

                     <th class=" text-custom-secondary" scope="col">#</th>
                     <th class=" text-custom-secondary" scope="col">Immagine</th>
                     <th class=" text-custom-secondary" scope="col">Titolo</th>
                     <th class=" text-custom-secondary" scope="col">Indirizzo</th>
                     <th class=" text-custom-secondary" scope="col">Prezzo</th>
                     <th class=" text-custom-secondary" scope="col">Azioni</th>

                  </tr>

               </thead>

               <tbody>
                  @foreach ($houses as $index => $house)
                     <tr>

                        <th class=" text-custom-secondary" scope="row">
                           {{ $index + 1 + ($houses->currentPage() - 1) * $houses->perPage() }}</th>

                        <td class=" text-custom-secondary">
                           <a
                              href="{{ route('admin.house.show', ['house' => $house->slug, 'curPage' => $houses->currentPage(), 'perPage' => $houses->perPage()]) }}">
                              <div class="h-100 overflow-hidden shadow-lg"
                                 style="background-position: center; background-size: cover; background-repeat: no-repeat; min-height: ;">
                                 <img id="house-image"
                                    class="h-100"
                                    src="{{ substr($house->image, 0, 8) == 'https://' ? $house->image : asset('images/house_images/' . $house->image) }}"
                                    alt="">
                              </div>
                           </a>
                        </td>

                        <td class=" text-custom-secondary">{{ $house->title }}</td>

                        <td class=" text-custom-secondary">{{ $house->address }}</td>

                        <td class=" text-custom-secondary">
                           {{ strpos($house->price, '.') !== false ? str_replace('.', ',', $house->price) : $house->price . ',00' }}
                           €/notte</td>

                        <td>

                           <div class="d-flex gap-2">

                              {{-- Modify Button --}}

                              <a class="btn btn-outline-warning"
                                 href="{{ route('admin.house.edit', ['house' => $house->slug, 'curPage' => $houses->currentPage(), 'perPage' => $houses->perPage()]) }}">
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
            <div class="d-flex">

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

      .btn-outline-warning:hover {

         color: white;
      }

      form {

         label {
            width: 20%;
         }
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

      .btn-apply {
         height: 50%;
         border-color: {{ env('color_dark_blue') }};
         color: {{ env('color_dark_blue') }};

         &:hover {
            color: white;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
            background-color: {{ env('color_dark_blue') }};
         }
      }

      table {

         img {
            max-width: 100px;
            max-height: 100px;
         }
      }
   </style>

   <script>
      document.addEventListener("DOMContentLoaded", function() {
         const imgElement = document.getElementById('house-image');
         const houseImage = "{{ $house->image }}";

         if (houseImage.substring(0, 8) !== 'https://') {
            const imgPaths = [
               "{{ asset('images/house_images/' . $house->image) }}",
               "{{ asset('storage/' . $house->image) }}"
            ];

            function checkImage(src, callback) {
               const img = new Image();
               img.onload = () => callback(true);
               img.onerror = () => callback(false);
               img.src = src;
            }

            function updateImagePath(index) {
               if (index >= imgPaths.length) return;

               checkImage(imgPaths[index], (exists) => {
                  if (exists) {
                     imgElement.src = imgPaths[index];
                  } else {
                     updateImagePath(index + 1);
                  }
               });
            }

            updateImagePath(0);
         }
      });
   </script>
@endsection
