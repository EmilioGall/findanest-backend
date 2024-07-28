@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="py-4">Statistiche</h1>

        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="h-100 d-flex align-items-center justify-content-center border rounded stats-top">
                    <i class="fas fa-house me-3"></i>
                    <span class="fs-5">Case inserite: <strong class="ms-2">{{ $totalHouses }}</strong></span>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="h-100 d-flex align-items-center justify-content-center border rounded stats-top">
                    <i class="fas fa-dollar-sign me-3"></i>
                    <span class="fs-5">Sponsorizzazioni attive: <strong
                            class="ms-2">{{ $activeSponsorships }}</strong></span>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="h-100 d-flex align-items-center justify-content-center border rounded stats-top">
                    <i class="fas fa-envelope me-3"></i>
                    <span class="fs-5">Messaggi ricevuti: <strong class="ms-2">{{ $totalMessages }}</strong></span>
                </div>
            </div>
        </div>

        <div class="row py-4">
            <div class="col-md-4">
                <label for="house_id" class="small">Seleziona la casa</label>
                <select class="form-select" id="house_id" name="house_id">
                    <option value="">Tutte le case</option>
                    @foreach ($houses as $house)
                        <option value="{{ $house->id }}" {{ $house->id == $houseId ? 'selected' : '' }}>
                            {{ $house->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label for="start_date" class="small">Data Inizio</label>
                <input type="date" id="start_date" name="start_date" class="form-control" value="{{ $startDate }}">
            </div>
            <div class="col-md-2">
                <label for="end_date" class="small">Data Fine</label>
                <input type="date" id="end_date" name="end_date" class="form-control" value="{{ $endDate }}">
            </div>
            <div class="col-md-3">
                <label for="predefined_intervals" class="small">Intervalli Predefiniti</label>
                <select id="predefined_intervals" name="predefined_intervals" class="form-select">
                    <option value="last_31_days" selected>Ultimi 31 giorni</option>
                    <option value="last_7_days">Ultimi 7 giorni</option>
                    <option value="today">Oggi</option>
                </select>
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <button id="apply_filters" class="btn btn-custom w-100">Applica</button>
            </div>
        </div>

        <div class="row pt-4">
            <div class="col-8">
                <h6>Visualizzazioni totali suddivise per casa</h6>
                <div class="h-100 p-4 stats-bottom">
                    <canvas id="viewsChart"></canvas>
                </div>
            </div>
            <div class="col-4">
                <h6>Top 3 delle case più visualizzate</h6>
                <div class="h-100 p-4 stats-bottom">
                    <canvas id="topThreeChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <style>
        .stats-top {
            padding: 1em;
            border-color: {{ env('color_light_purple') }} !important;
        }

        .stats-top i {
            color: {{ env('color_light_purple') }};
            font-size: 2rem;
        }

        .stats-top strong {
            color: {{ env('color_light_purple') }};
            font-size: 1.7rem;
        }

        .form-control,
        .form-select {
            border-color: {{ env('color_light_purple') }} !important;
        }

        .btn-custom {
            border-color: {{ env('color_light_purple') }};
            color: {{ env('color_light_purple') }};

        }

        .btn-custom:hover {
            color: white;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
            background-color: {{ env('color_light_purple') }};
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('viewsChart').getContext('2d');
            const topCtx = document.getElementById('topThreeChart').getContext('2d');

            let viewsChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($views->pluck('house_name')),
                    datasets: [{
                        label: 'Visualizzazioni per casa',
                        data: @json($views->pluck('views')),
                        backgroundColor: '{{ env('color_light_purple') }}',
                        borderWidth: 1
                    }]
                },
                options: {
                    indexAxis: 'y',
                    scales: {
                        x: {
                            beginAtZero: true
                        }
                    }
                }
            });

            let topThreeChart = new Chart(topCtx, {
                type: 'doughnut',
                data: {
                    labels: @json($topThreeHouses->pluck('house_name')),
                    datasets: [{
                        label: 'Top 3 Case più visitate',
                        data: @json($topThreeHouses->pluck('views')),
                        backgroundColor: ['{{ env('color_light_purple') }}',
                            '{{ env('color_light_green') }}', '{{ env('color_dark_blue') }}'
                        ],
                        hoverOffset: 4
                    }]
                }
            });

            function updateChart(houseId) {
                const url = `{{ route('admin.statistics.index') }}?house_id=${houseId}`;

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        viewsChart.destroy();
                        viewsChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: data.views.map(view => view.house_name),
                                datasets: [{
                                    label: 'Visualizzazioni per casa',
                                    data: data.views.map(view => view.views),
                                    backgroundColor: '{{ env('color_light_purple') }}',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                indexAxis: 'y',
                                scales: {
                                    x: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    }).catch(error => console.error('Errore nella richiesta:', error));
            }

            document.getElementById('house_id').addEventListener('change', function() {
                const houseId = this.value;
                updateChart(houseId);
            });
        });
    </script>
@endsection
