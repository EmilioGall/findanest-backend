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
                <label for="title" class="form-label">Titolo</label>
                <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Prezzo</label>
                <input type="number" class="form-control" id="price" name="price">{{old('number')}}</input>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Indirizzo</label>
                <input type="text" class="form-control" id="address" name="address" value="{{old('address')}}">
            </div>

        </form>
    </div>
@endsection
