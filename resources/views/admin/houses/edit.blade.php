@extends('layouts.admin')

@section('content')

   <div class="container">

      <h1 class="py-2">Modifica la tua casa</h1>

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
      <form action="{{ route('admin.house.update', ['house' => $house->slug]) }}"
         method="POST"
         enctype="multipart/form-data"
         id="houseForm">
         @csrf
         @method('PUT')

         {{-- Input Immagine --}}
         <div class="row mb-3">

            <div class="col-12">

               <label for="image" class="form-label">Foto</label>
               <input type="file"
                  accept="image/jpeg, image/png"
                  class="form-control"
                  id="image"
                  name="images[]"
                  multiple>
               <output></output>

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
            <div class="col-md-2">

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
            <div class="col-md-2">

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
            <div class="col-md-2">

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
            <div class="col-md-2">

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

         {{-- Checkbox Visibile --}}
         <div class="row mb-3 ms-1">

            <div class="col-md-6 form-check form-switch mt-4">

               <input class="form-check-input"
                  type="checkbox"
                  id="visible"
                  name="visible"
                  value="{{ old('visible', 2) }}"
                  {{-- @dd($house['visible']) --}}
                  {{ old('visible', $house['visible']) === '2' ? 'checked' : '' }}>
               <label class="form-check-label" for="visible">Visibile</label>

            </div>

         </div>

         {{-- Input description --}}
         <div class="row mb-3">

            <div class="col-12">

               <label for="description" class="form-label">Descrizione</label>
               <textarea class="form-control" id="description" name="description">

                  {{ old('description', $house['description']) }}

               </textarea>

            </div>

         </div>

         {{-- Submit Button --}}
         <button type="submit" class="btn btn-success mb-3">Salva</button>

      </form>

   </div>

   <script>
      const input = document.querySelector("#image");

      const output = document.querySelector("output");

      let imagesArray = [];

      input.addEventListener("change", function() {

         imagesArray = Array.from(input.files);
         displayImages();
      });

      function displayImages() {

         output.innerHTML = imagesArray.map((image, index) => `
            <div class="image">
                <img src="${URL.createObjectURL(image)}" alt="image">
                <span onclick="deleteImage(${index})">&times;</span>
            </div>`).join('');
      }

      function deleteImage(index) {

         imagesArray.splice(index, 1);
         displayImages();
      }
   </script>

   <style>
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
         cursor: pointer;
         font-size: 20px;
         color: white;
         background-color: rgba(0, 0, 0, 0.6);
         border-radius: 50%;
         padding: 2px 8px;
      }

      output .image span:hover {
         background-color: rgba(0, 0, 0, 0.8);
      }
   </style>

@endsection
