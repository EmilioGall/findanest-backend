@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Inserisci un nuovo appartamento</h1>

        {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        <form action="{{ route('admin.house.store') }}" method="POST">

            <button class="btn btn-success mb-3" type="submit">Salva</button>


            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price">{{ old('number') }}</input>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" id="description" name="description"
                    value="{{ old('description') }}">
            </div>

            <div class="form-group">
                <label for="rooms">Stanze</label>
                <input type="number" class="form-control" id="rooms" name="rooms"
                    placeholder="Inserisci il numero di stanze">
            </div>

            <div class="form-group">
                <label for="bathrooms">Bathroom</label>
                <input type="number" class="form-control" id="bathrooms" name="bathrooms"
                    placeholder="Inserisci il numero di bagni">
            </div>

            <div class="form-group">
                <label for="sqm">Metri Quadrati</label>
                <input type="number" class="form-control" id="sqm" name="sqm"
                    placeholder="Inserisci i metri quadrati">
            </div>

            <div class="form-group">
                <label for="latitude">Latitudine</label>
                <input type="text" class="form-control" id="latitude" name="latitude"
                    placeholder="Inserisci la latitudine">
            </div>

            <div class="form-group">
                <label for="longitude">Longitudine</label>
                <input type="text" class="form-control" id="longitude" name="longitude"
                    placeholder="Inserisci la longitudine">
            </div>

            <div class="form-group">
                <label for="image">Immagine</label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>

            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="visible" name="visible">
                <label class="form-check-label" for="visible">Visibile</label>
            </div>

        </form>
    </div>
@endsection
