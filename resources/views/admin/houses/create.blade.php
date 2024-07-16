@extends('layouts.admin')

@section('content')

    <div class="container">
        <h1 class="py-2">Inserisci un nuovo appartamento</h1>

        {{-- handling dell'errore --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- fine dell'handling dell'errore --}}

        {{-- form della creazione --}}
        <form action="{{ route('admin.house.store') }}" method="POST" enctype="multipart/form-data">
            @csrf



            <div class="row">
                <div class="col-3 mb-3">
                    <label for="image" class="form-label">Foto</label>
                    <input type="file" accept="image/jpeg, image/png, image/jpg" class="form-control" id="image"
                        name="image">
                    
                </div>
                <div class="col-6">
                    <output></output>
                </div>
                
            </div>





            <div class="row">
                <div class="col-12 mb-3">
                    <label for="title" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                </div>

                <div class="col-12 mb-3">
                    <label for="address" class="form-label">Indirizzo</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">

                    {{-- suggerimenti --}}
                    <ul id="suggestions-list" class="list-group"></ul>

                </div>

                <div class="col-12 mb-3">
                    <label for="description" class="form-label">Descrizione</label>
                    <input type="text" class="form-control" id="description" name="description"
                        value="{{ old('description') }}">
                </div>

            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="rooms" class="form-label">Stanze</label>
                        <input type="number" class="form-control" id="rooms" name="rooms"
                            value="{{ old('rooms') }}">
                    </div>

                    <div class="mb-3">
                        <label for="bathrooms" class="form-label">Bagni</label>
                        <input type="number" class="form-control" id="bathrooms" name="bathrooms"
                            value="{{ old('bathrooms') }}">
                    </div>

                    <div class="mb-3">
                        <label for="beds" class="form-label">Posti Letto</label>
                        <input type="number" class="form-control" id="beds" name="beds"
                            value="{{ old('beds') }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="price" class="form-label">Prezzo</label>
                        <input type="number" class="form-control" id="price" name="price" step="0.01"
                            value="{{ old('price') }}">
                    </div>

                    <div class="mb-3">
                        <label for="sqm" class="form-label">Dimensione (mq)</label>
                        <input type="number" class="form-control" id="sqm" name="sqm"
                            value="{{ old('sqm') }}">
                    </div>

                    {{-- <div class="form-check mb-3  mt-5">
                        <input type="checkbox" class="form-check-input" id="visible" name="visible"
                            {{ old('visible') ? 'checked' : '' }}>
                        <label class="form-check-label" for="visible">Visibile</label>
                    </div> --}}
                    <div class="form-check form-switch mb-3  mt-5">
                        <input class="form-check-input" type="checkbox" role="switch" class="form-check-input"
                            id="visible" name="visible" {{ old('visible') ? 'checked' : '' }}>
                        <label class="form-check-label" for="visible">Visibile</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Salva</button>

        </form>

    </div>
    <script>
        const input = document.querySelector("#image");
        const output = document.querySelector("output");
        let imagesArray = [];
    
        input.addEventListener("change", function() {
            const file = input.files[0];
            if (file) {
                imagesArray = [file]; 
                displayImages();
            }
        });
    
        function displayImages() {
            let images = "";
            imagesArray.forEach((image, index) => {
                images += `<div class="image">
                            <img src="${URL.createObjectURL(image)}" alt="image">
                            <span onclick="deleteImage(${index})">&times;</span>
                           </div>`;
            });
            output.innerHTML = images;
        }
    
        function deleteImage(index) {
            imagesArray.splice(index, 1);
            output.innerHTML = ""; 
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
            font-size: 22px;
            color: rgb(6, 6, 6);
            background-color: rgba(220, 216, 216, 0.5);
            border-radius: 50%;
            padding: 2px 8px;
        }
    
        output .image span:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }
    </style>

@endsection
