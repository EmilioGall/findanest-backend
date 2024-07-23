@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="py-3 mb-2">Sponsorizza i tuoi annunci</h1>

        <form method="GET" action="{{ route('admin.sponsorships.index') }}" class="pb-4">
            <div class="col-4">
                <div class="mb-3">
                    <label for="house_id" class="form-label"><small>Seleziona la casa da sponsorizzare</small></label>
                    <select class="form-select" id="house_id" name="house_id" onchange="this.form.submit()">
                        <option value="">Tutte le case</option>
                        @foreach ($houses as $house)
                            <option value="{{ $house->id }}"
                                {{ $selectedHouse && $selectedHouse->id == $house->id ? 'selected' : '' }}>
                                {{ $house->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>

        @if ($selectedHouse)
            {{-- Details card --}}
            <h4>Dettagli principali della casa</h4>
            <div class="card mt-4">
                <div class="card-header">
                    {{ $selectedHouse->title }}
                </div>
                <div class="card-body">
                    <p><span class="fw-bold">Indirizzo:</span> {{ $selectedHouse->address }}</p>
                    <p><span class="fw-bold">Descrizione:</span> {{ $selectedHouse->description }}</p>
                </div>
            </div>

            {{-- Sponsorship cards --}}
            <section>
                <h4 class="pt-5 pb-2">Scegli il tuo pacchetto di sponsorizzazione</h4>
                <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
                    <div class="col">
                        <div class="card mb-4 rounded-3 shadow-sm">
                            <div class="card-header py-3">
                                <h4 class="my-0 fw-normal">Essential</h4>
                            </div>
                            <div class="card-body">
                                <h1 class="card-title pricing-card-title">2,99 €<small class="text-body-secondary fw-light">
                                        /
                                        1gg</small>
                                </h1>
                                <ul class="list-unstyled mt-3 mb-4">
                                    <li>12h di sponsorizzazione</li>
                                    <li>Pagamento con Carta di Credito</li>
                                </ul>
                                <button type="button" class="w-100 btn btn-lg style-outline">Acquista ora</button>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card mb-4 rounded-3 shadow-sm">
                            <div class="card-header py-3">
                                <h4 class="my-0 fw-normal">Regular</h4>
                            </div>
                            <div class="card-body">
                                <h1 class="card-title pricing-card-title">5,99 €<small class="text-body-secondary fw-light">
                                        /
                                        3gg</small>
                                </h1>
                                <ul class="list-unstyled mt-3 mb-4">
                                    <li>72h di sponsorizzazione</li>
                                    <li>Pagamento con Carta di Credito</li>
                                </ul>
                                <button type="button" class="w-100 btn btn-lg style-outline">Acquista ora</button>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card mb-4 rounded-3 shadow-sm card-premium">
                            <div class="card-header card-header-premium">
                                <h4 class="my-0 fw-normal">Premium</h4>
                            </div>
                            <div class="card-body">
                                <h1 class="card-title pricing-card-title">9,99 €<small class="text-body-secondary fw-light">
                                        /
                                        12gg</small>
                                </h1>
                                <ul class="list-unstyled mt-3 mb-4">
                                    <li>144h di sponsorizzazione</li>
                                    <li>Pagamento con Carta di Credito</li>
                                </ul>
                                <button type="button" class="w-100 btn btn-lg style-full">Acquista ora</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

    </div>

    <style>
        .style-outline {
            height: 50%;
            border-color: {{ env('color_light_purple') }};
            color: {{ env('color_light_purple') }};
        }

        .style-outline:hover {
            color: white;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
            background-color: {{ env('color_light_purple') }};
        }

        .style-full {
            height: 50%;
            background-color: {{ env('color_light_purple') }};
            color: #FFFFFF;
        }

        .style-full:hover {
            color: white;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
            background-color: {{ env('color_dark_purple') }};
        }

        .card-premium {
            border: 1px solid {{ env('color_light_purple') }};
        }

        .card-header-premium {
            background-color: {{ env('color_light_purple') }};
            color: #FFFFFF;
            padding: 1rem;
        }
    </style>
@endsection
