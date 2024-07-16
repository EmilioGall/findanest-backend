@extends('layouts.admin')

@section('content')
    <div class="container">
        <table class="table">
            <thead>
                <tr class="text-center">
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
                    <tr class="text-center">
                        <th scope="row">{{ $index + 1 }}</th>
                        <td><img class="w-50" src="{{ $house->image }}" alt=""></td>
                        <td>{{ $house->title }}</td>
                        <td>{{ $house->address }}</td>
                        <td>{{ $house->price }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a class="btn btn-primary" href=""><i class="fa-solid fa-eye"></i></a>
                                <a class="btn btn-warning text-white" href=""><i class="fa-solid fa-pencil"></i></a>
                                <a class="btn btn-danger" href=""><i class="fa-solid fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
