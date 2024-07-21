@extends('layouts.admin')

@php
    use Carbon\Carbon;
@endphp


@section('content')
    <div class="container">
        <h1 class="py-3 mb-2">Richieste di contatto</h1>

        <form method="GET" action="{{ route('admin.leads.index') }}" class="pb-4">
            <div class="col-4">
                <div class="mb-3">
                    <label for="house_id" class="form-label"><small>Seleziona la casa per visualizzare i
                            messaggi</small></label>
                    <select class="form-select" id="house_id" name="house_id" onchange="this.form.submit()">
                        <option value="">Tutte le case</option>
                        @foreach ($houses as $house)
                            <option value="{{ $house->id }}" {{ $house->id == $houseId ? 'selected' : '' }}>
                                {{ $house->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

        </form>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    {{-- <th scope="col">Stato</th> --}}
                    <th scope="col">Nome</th>
                    <th scope="col">E-Mail</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Ricevuto il</th>
                    <th scope="col">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($leads as $index => $lead)
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        {{-- <td class="col-auto">
                            <select
                                class="form-select form-select-sm badge rounded-pill {{ $lead->status == 'closed' ? 'bg-warning' : ($lead->status == 'handled' ? 'bg-warning' : 'bg-success') }}"
                                id="autoSizingSelect">
                                <option value="new" {{ $lead->status == 'new' ? 'selected' : '' }}>Nuovo</option>
                                <option value="handled" {{ $lead->status == 'handled' ? 'selected' : '' }}>Gestito</option>
                                <option value="closed" {{ $lead->status == 'closed' ? 'selected' : '' }}>Chiuso</option>
                            </select>
                        </td> --}}

                        <td>{{ $lead->name }}</td>
                        <td>{{ $lead->email }}</td>
                        <td>{{ $lead->phone_number }}</td>
                        <td>{{ Carbon::parse($lead->created_at)->format('d/m/Y H:i') }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a class="btn btn-sm btn-outline-primary"
                                    href="{{ route('admin.leads.show', ['lead' => $lead->id]) }}">
                                    <span>Dettagli</span>
                                </a>
                            </div>
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
