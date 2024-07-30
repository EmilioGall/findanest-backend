@extends('layouts.admin')

@section('content')

   <div class="container pt-4 text-custom-secondary">

      <div class="row justify-content-between align-items-center border-bottom">

         {{-- Edit Title --}}
         <div class="col-12 col-sm-10">

            <h2 class="fw-1 fs-2 text-main">Modifica la tua casa</h2>

         </div>

         {{-- Button to Index --}}
         <div class="col-12 col-sm-2 d-flex justify-content-end">

            <a type="button" class="btn btn-outline h-75 w-50 d-flex align-items-center justify-content-center"
               href="{{ route('admin.house.index', ['page' => $curPage, 'per_page' => $perPage]) }}">

               <i class="fa-solid fa-angles-left"></i>

            </a>

         </div>

      </div>

      {{-- Handling error --}}
      @if ($errors->any())
         <div class="alert alert-danger">

            <ul>
               @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
               @endforeach
            </ul>

         </div>
      @endif
      {{-- End handling error --}}

      {{-- Edit form --}}
      <form class="pt-3"
         action="{{ route('admin.house.update', ['house' => $house->slug]) }}"
         method="POST"
         enctype="multipart/form-data"
         id="houseForm">
         @csrf
         @method('PUT')

         {{-- Input Immagine --}}
         <div class="row mb-3">

            <div class="col-12 images-container">

               <label for="image" class="form-label">Foto</label>
               <input type="file"
                  accept="image/jpeg, image/png"
                  class="form-control"
                  id="image"
                  name="image">

            </div>

         </div>

         <div class="row mb-3">

            {{-- Input title --}}
            <div class="col-6">

               <label for="title" class="form-label">Nome</label>
               <input type="text"
                  class="form-control"
                  id="title"
                  name="title"
                  value="{{ old('title', $house['title']) }}">

               {{-- Front-end validation --}}
               <div id="titleError" class="invalid-feedback fw-bold"></div>

            </div>

            {{-- Input address --}}
            <div class="col-6">

               <label for="address" class="form-label">Indirizzo</label>
               <input type="text"
                  class="form-control"
                  id="address"
                  name="address"
                  value="{{ old('address', $house['address']) }}">

               {{-- Front-end validation --}}
               <div id="addressError" class="invalid-feedback fw-bold"></div>

               {{-- Suggerimento indirizzi --}}
               <ul id="suggestions-list" class="list-group"></ul>

            </div>

         </div>

         <div class="row mb-3">

            {{-- Input rooms --}}
            <div class="col-md-3">

               <label for="rooms" class="form-label">Stanze</label>
               <input type="number"
                  class="form-control"
                  id="rooms"
                  name="rooms"
                  value="{{ old('rooms', $house['rooms']) }}">

               {{-- Front-end validation --}}
               <div id="roomsError" class="invalid-feedback fw-bold"></div>

            </div>

            {{-- Input bathrooms --}}
            <div class="col-md-3">

               <label for="bathrooms" class="form-label">Bagni</label>
               <input type="number"
                  class="form-control"
                  id="bathrooms"
                  name="bathrooms"
                  value="{{ old('bathrooms', $house['bathrooms']) }}">

               {{-- Front-end validation --}}
               <div id="bathroomsError" class="invalid-feedback fw-bold"></div>

            </div>

            {{-- Input beds --}}
            <div class="col-md-3">

               <label for="beds" class="form-label">Posti Letto</label>
               <input type="number"
                  class="form-control"
                  id="beds"
                  name="beds"
                  value="{{ old('beds', $house['beds']) }}">

               {{-- Front-end validation --}}
               <div id="bedsError" class="invalid-feedback fw-bold"></div>

            </div>

            {{-- Input sqm --}}
            <div class="col-md-3">

               <label for="sqm" class="form-label">Dimensione (mq)</label>
               <input type="number"
                  class="form-control"
                  id="sqm"
                  name="sqm"
                  value="{{ old('sqm', $house['sqm']) }}">

               {{-- Front-end validation --}}
               <div id="sqmError" class="invalid-feedback fw-bold"></div>

            </div>

         </div>

         {{-- Input price --}}
         <div class="row mb-3">

            <div class="col-md-6">

               <label for="price" class="form-label">Prezzo</label>
               <input type="number"
                  class="form-control"
                  id="price"
                  name="price"
                  step="0.01"
                  value="{{ old('price', $house['price']) }}">

               {{-- Front-end validation --}}
               <div id="priceError" class="invalid-feedback fw-bold"></div>

            </div>

         </div>

         <div class="row mb-3">

            {{-- Checkbox services --}}
            <label class="mb-2">Seleziona i servizi</label>
            <div class="col-12 d-flex flex-wrap">

               <div class="container-fluid">

                  <div class="row row-col-2 row-cols-md-4 g-2">

                     @foreach ($servicesCollection as $service)
                        @if (old('services') === null)
                           <div class="form-check">
                              <input type="checkbox"
                                 id="{{ $service->slug }}"
                                 name="services[]"
                                 value="{{ $service->id }}"
                                 class="form-check-input"
                                 @checked($house->services->contains($service->id))>
                              <label for="{{ $service->slug }}"
                                 class="form-check-label">{{ $service->service_name }}</label>
                           </div>
                        @else
                           <div class="form-check">
                              <input type="checkbox"
                                 id="{{ $service->slug }}"
                                 name="services[]"
                                 value="{{ $service->id }}"
                                 class="form-check-input"
                                 @checked(in_array($service->id, old('services', [])))>
                              <label for="{{ $service->slug }}"
                                 class="form-check-label">{{ $service->service_name }}</label>
                           </div>
                        @endif
                     @endforeach

                  </div>

               </div>
            </div>

         </div>

         {{-- Input description --}}
         <div class="row mb-3">

            <div class="col-12">

               <label for="description" class="form-label">Descrizione</label>
               <textarea class="form-control" id="description" name="description">{{ old('description', $house['description']) }}</textarea>

            </div>

         </div>

         <div class="row g-5 align-items-center mb-3">

            {{-- Submit Button --}}
            <div class="col-2">
               <button type="submit" class="btn btn-full w-100">Salva</button>
            </div>

            {{-- Checkbox visibie --}}
            <div class="col-md-6 form-check form-switch d-flex gap-2 align-items-center">

               <input class="form-check-input"
                  type="checkbox"
                  id="visible"
                  name="visible"
                  value="2"
                  @checked(old('visible') === null ? $house['visible'] == '2' : old('visible') == '2')>
               <label class="form-check-label" for="visible">Visibile</label>

            </div>

         </div>

      </form>

   </div>

   <script>
      const input = document.querySelector("#image");

      const imagesContainer = document.querySelector(".images-container");

      let imagesArray = [];

      function displayImages() {

         if (document.querySelector("output")) {

            console.log('vengo chiamata');

            const output = document.querySelector("output");

            // console.log(output);

            output.innerHTML = imagesArray.map((image, index) => `
               <div class="image">
   
                  <img src="${URL.createObjectURL(image)}" alt="image">
   
                  <span onclick="deleteImage(${index})" class="text-center">
                     &times;
                  </span>
                  
               </div>`).join('');
         }
      }

      function deleteImage(index) {

         imagesArray.splice(index, 1);

         if (document.querySelector("output") && imagesArray.length === 0) {

            console.log('non ci sono img');

            const output = document.querySelector("output");

            output.remove();

         } else if (imagesArray.length > 0) {

            displayImages();
         }
      }

      input.addEventListener("change", function() {

         imagesArray = Array.from(input.files);

         if (imagesArray.length > 0) {

            // console.log('ci sono img');

            const output = document.createElement("output");

            imagesContainer.append(output);
         }

         const output = document.querySelector("output");

         displayImages();

      });
   </script>

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

      output {
         width: 100%;
         min-height: 150px;
         display: flex;
         justify-content: flex-start;
         flex-wrap: wrap;
         gap: 15px;
         position: relative;
         border: 2px dashed #ddd;
         border-radius: 5px;
         padding: 10px;
         background-color: #f9f9f9;
      }

      output .image {
         height: 150px;
         border-radius: 5px;
         box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
         overflow: hidden;
         position: relative;
      }

      output .image img {
         height: 100%;
         width: 100%;
         object-fit: cover;
      }

      output .image span {
         position: absolute;
         top: 5px;
         right: 10px;
         line-height: 15px;
         height: 20px;
         width: 20px;
         cursor: pointer;
         font-size: 15px;
         color: white;
         background-color: rgba(0, 0, 0, 0.6);
         border-radius: 50%;
      }

      output .image span:hover {
         background-color: rgba(0, 0, 0, 0.8);
      }
   </style>

@endsection
