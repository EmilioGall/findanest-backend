@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Inserisci un nuovo appartamento</h1>

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
                <div class="col-12 mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                </div>

                <div class="col-12 mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
                </div>

                <div class="col-12 mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description"
                           value="{{ old('description') }}">
                </div>

                <div class="col-12 mb-3">
                    <label for="image" class="form-label">Cover Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="rooms" class="form-label">Rooms</label>
                        <input type="number" class="form-control" id="rooms" name="rooms" value="{{ old('rooms') }}">
                    </div>

                    <div class="mb-3">
                        <label for="bathrooms" class="form-label">Bathrooms</label>
                        <input type="number" class="form-control" id="bathrooms" name="bathrooms" value="{{ old('bathrooms') }}">
                    </div>


                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="price" name="price" step="0.01" value="{{ old('price') }}">
                    </div>

                    <div class="mb-3">
                        <label for="sqm" class="form-label">Area (sqm)</label>
                        <input type="number" class="form-control" id="sqm" name="sqm" value="{{ old('sqm') }}">
                    </div>
                </div>
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="visible" name="visible" {{ old('visible') ? 'checked' : '' }}>
                <label class="form-check-label" for="visible">Visible</label>
            </div>

            

            <button type="submit" class="btn btn-success">Post</button>
        </form>
    </div>
@endsection