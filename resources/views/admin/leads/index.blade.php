@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="py-3 mb-4">Richieste di contatto</h1>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Stato</th>
                    <th scope="col">Nome</th>
                    <th scope="col">E-Mail</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Data</th>
                    <th scope="col">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($leads as $lead)
                    <tr>
                        <th scope="row">{{ $lead->id }}</th>
                        <td class="col-auto">
                            <select class="form-selects form-select-sm" id="autoSizingSelect">
                                <option value="new">Nuovo</option>
                                <option value="handled">Gestito</option>
                                <option value="closed">Chiuso</option>
                            </select>
                        </td>
                        <td>{{ $lead->name }}</td>
                        <td>{{ $lead->email }}</td>
                        <td>{{ $lead->phone_number }}</td>
                        <td>{{ $lead->created_at }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a class="btn btn-small btn-outline-primary" href="#">
                                    <i class="fa-solid fa-reply"></i><small class="ms-2">Rispondi</small>
                                </a>
                        </td>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            {{ $leads->links() }}
        </div>
    </div>
@endsection
