@extends('layouts.admin')

@section('content')

    <div class="container">

        <h1 class="py-2 mb-3">Inserisci un nuovo annuncio</h1>

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

        {{-- Creation form --}}
        <form action="{{ route('admin.house.store') }}" method="POST" enctype="multipart/form-data" id="houseForm">
            @csrf

            {{-- Input Immagine --}}
            <div class="row mb-3">

                <div class="col-12 images-container">

                    <label for="image" class="form-label">Foto</label>
                    <input type="file" accept="image/jpeg, image/png" class="form-control" id="image" name="image">

                </div>

            </div>

            <div class="row mb-3">

                {{-- Input title --}}
                <div class="col-6">

                    <label for="title" class="form-label">Nome *</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">

                    {{-- Front-end validation --}}
                    <div id="titleError" class="invalid-feedback fw-bold"></div>

                </div>

                {{-- Input address --}}
                <div class="col-6">

                    <label for="address" class="form-label">Indirizzo *</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">

                    {{-- Front-end validation --}}
                    <div id="addressError" class="invalid-feedback fw-bold"></div>

                    {{-- Suggerimento indirizzi --}}
                    <ul id="suggestions-list" class="list-group"></ul>

                </div>

            </div>

            <div class="row mb-3">

                {{-- Input rooms --}}
                <div class="col-md-2">
                    <label for="rooms" class="form-label">Stanze *</label>
                    <input type="number" class="form-control" id="rooms" name="rooms" value="{{ old('rooms') }}">

                    {{-- Front-end validation --}}
                    <div id="roomsError" class="invalid-feedback fw-bold"></div>

                </div>

                {{-- Input bathrooms --}}
                <div class="col-md-2">
                    <label for="bathrooms" class="form-label">Bagni *</label>
                    <input type="number" class="form-control" id="bathrooms" name="bathrooms"
                        value="{{ old('bathrooms') }}">

                    {{-- Front-end validation --}}
                    <div id="bathroomsError" class="invalid-feedback fw-bold"></div>

                </div>

                {{-- Input beds --}}
                <div class="col-md-2">

                    <label for="beds" class="form-label">Posti Letto *</label>
                    <input type="number" class="form-control" id="beds" name="beds" value="{{ old('beds') }}">

                    {{-- Front-end validation --}}
                    <div id="bedsError" class="invalid-feedback fw-bold"></div>

                </div>

                {{-- Input sqm --}}
                <div class="col-md-2">
                    <label for="sqm" class="form-label">Dimensione (mq) *</label>
                    <input type="number" class="form-control" id="sqm" name="sqm" value="{{ old('sqm') }}">

                    {{-- frontend validation --}}
                    <div id="sqmError" class="invalid-feedback fw-bold"></div>

                </div>

            </div>

            <div class="row mb-3">

                {{-- Input price --}}
                <div class="col-md-6">

                    <label for="price" class="form-label">Prezzo *</label>
                    <input type="number" class="form-control" id="price" name="price" step="0.01"
                        value="{{ old('price') }}">

                    {{-- frontend validation --}}
                    <div id="priceError" class="invalid-feedback fw-bold"></div>

                </div>

            </div>

            <div class="row mb-3">

                {{-- Checkbox services --}}
                <label class="mt-4 mb-2">Seleziona i servizi</label>
                <div class="col-lg-12 col-md-6 d-flex flex-wrap">

                    {{-- @dd($servicesCollection) --}}

                    @foreach ($servicesCollection as $service)
                        <div class="form-check me-3">
                            <input type="checkbox" id="{{$service->slug}}" name="services[]" value="{{$service->id}}"
                                class="form-check-input">
                            <label for="" class="form-check-label">{{ $service->service_name }}</label>
                        </div>
                    @endforeach

                </div>

                <div class="row mb-3 ms-1">

                    {{-- Checkbox visibie --}}
                    <div class="col-md-6 form-check form-switch mt-4">

                        <input class="form-check-input" type="checkbox" id="visible" name="visible"
                            {{-- @dd(old('visible') ) --}} value="2" {{ old('visible') == '2' ? 'checked' : '' }}>
                        <label class="form-check-label" for="visible">Visibile</label>

                    </div>

                </div>


                <div class="row mb-3">

                    {{-- Input description --}}
                    <div class="col-12">
                        <label for="description" class="form-label">Descrizione</label>
                        <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                    </div>

                </div>

                {{-- Submit Button --}}
                <div>
                    <button type="submit" class="btn btn-success">Salva</button>
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
