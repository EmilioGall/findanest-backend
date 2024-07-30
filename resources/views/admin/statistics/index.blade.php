@extends('layouts.admin')

@section('content')
   <div class="container pt-4 text-custom-secondary">

      {{-- Statistics Header --}}
      <div class="row justify-content-between align-items-center border-bottom">

         {{-- Statistics Title --}}
         <div class="col-12 col-sm-10">

            <h2 class="fw-1 fs-2 text-main">Statistiche</h2>

         </div>

         {{-- Button to Index --}}
         <div class="col-12 col-sm-2 d-flex justify-content-end">

            <a type="button" class="btn btn-outline h-75 w-50 d-flex align-items-center justify-content-center"
               href="{{ route('admin.house.index') }}">

               <i class="fa-solid fa-angles-left"></i>

            </a>

         </div>

      </div>
      {{-- /Statistics Header --}}

      <div class="row pt-3">
         <div class="col-md-4">
            <div class="h-100 d-flex align-items-center justify-content-center border rounded stats-top">
               <i class="fas fa-house me-3"></i>
               <span class="fs-5">Case inserite: <strong class="ms-2">{{ $totalHouses }}</strong></span>
            </div>
         </div>
         <div class="col-md-4">
            <div class="h-100 d-flex align-items-center justify-content-center border rounded stats-top">
               <i class="fas fa-dollar-sign me-3"></i>
               <span class="fs-5">Sponsorizzazioni attive: <strong
                     class="ms-2">{{ $activeSponsorships }}</strong></span>
            </div>
         </div>
         <div class="col-md-4">
            <div class="h-100 d-flex align-items-center justify-content-center border rounded stats-top">
               <i class="fas fa-envelope me-3"></i>
               <span class="fs-5">Messaggi ricevuti: <strong class="ms-2">{{ $totalMessages }}</strong></span>
            </div>
         </div>
      </div>

      <div class="row pt-4">
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
            <input type="date"
               id="start_date"
               name="start_date"
               class="form-control"
               value="{{ $startDate }}">
         </div>
         <div class="col-md-2">
            <label for="end_date" class="small">Data Fine</label>
            <input type="date"
               id="end_date"
               name="end_date"
               class="form-control"
               value="{{ $endDate }}">
         </div>
         <div class="col-md-3">
            <label for="predefined_intervals" class="small">Intervalli Predefiniti</label>
            <select id="predefined_intervals" name="predefined_intervals" class="form-select">
               <option value="last_31_days" {{ $predefinedInterval == 'last_31_days' ? 'selected' : '' }}>Ultimi 31
                  giorni</option>
               <option value="last_7_days" {{ $predefinedInterval == 'last_7_days' ? 'selected' : '' }}>Ultimi 7 giorni
               </option>
               <option value="today" {{ $predefinedInterval == 'today' ? 'selected' : '' }}>Oggi</option>
               <option value="custom" {{ $predefinedInterval == 'custom' ? 'selected' : '' }}>Personalizzato</option>
            </select>

         </div>
         <div class="col-md-1 d-flex align-items-end">
            <button id="apply_filters" class="btn btn-custom w-100">Applica</button>
         </div>
      </div>

      <div class="row pt-4">
         <div class="col-8">
            <h6>Visualizzazioni totali per casa</h6>
            <div class="h-100 p-4 stats-bottom">
               <canvas id="viewsChart"></canvas>
            </div>
         </div>
         <div class="col-4">
            <h6>Top 3 visualizzazioni negli ultimi 31gg</h6>
            <div class="h-100 p-4 stats-bottom">
               <canvas id="topThreeChart"></canvas>
            </div>
         </div>
      </div>
   </div>

   <style>
      .text-main {
         color: {{ env('color_secondary') }};
      }

      .text-custom-secondary {

         color: {{ env('color_dark_grey') }};
      }

      .btn-outline {
         height: 50%;
         border-color: {{ env('color_secondary') }};
         color: {{ env('color_secondary') }};

         &:hover {
            color: white;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
            background-color: {{ env('color_secondary') }};
         }
      }

      .btn-full {
         color: white;
         box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);

         background-color: {{ env('color_secondary') }};

         &:hover {
            box-shadow: none;
            border-color: {{ env('color_secondary') }};
            color: {{ env('color_secondary') }};

         }
      }

      .stats-top {
         padding: 1em;
         border-color: {{ env('color_secondary') }} !important;
      }

      .stats-top i {
         color: {{ env('color_secondary') }};
         font-size: 2rem;
      }

      .stats-top strong {
         color: {{ env('color_secondary') }};
         font-size: 1.7rem;
      }

      .form-control,
      .form-select {
         border-color: {{ env('color_secondary') }} !important;
      }

      .btn-custom {
         border-color: {{ env('color_secondary') }};
         color: {{ env('color_secondary') }};

      }

      .btn-custom:hover {
         color: white;
         box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
         background-color: {{ env('color_secondary') }};
      }
   </style>

   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <script>
      document.addEventListener('DOMContentLoaded', function() {
         const ctx = document.getElementById('viewsChart').getContext('2d');
         const topCtx = document.getElementById('topThreeChart').getContext('2d');

         // Dati per il grafico delle visualizzazioni totali suddivise per casa
         const viewsLabels = [
            @foreach ($views as $view)
               '{{ $view->house_name }}',
            @endforeach
         ];

         const viewsData = [
            @foreach ($views as $view)
               {{ $view->views }},
            @endforeach
         ];

         // Dati per il grafico delle top 3 case più visualizzate (statici, ultimi 31 giorni)
         const topThreeLabels = [
            @foreach ($topThreeHouses as $house)
               '{{ $house->house_name }}',
            @endforeach
         ];

         const topThreeData = [
            @foreach ($topThreeHouses as $house)
               {{ $house->views }},
            @endforeach
         ];

         // Plugin per mostrare il messaggio "No data available"
         const noDataPlugin = {
            id: 'noDataPlugin',
            beforeDraw: (chart) => {
               const datasets = chart.data.datasets;
               const hasData = datasets.some(dataset => dataset.data.length > 0);

               if (!hasData) {
                  const ctx = chart.ctx;
                  const width = chart.width;
                  const height = chart.height;
                  const padding = 10;
                  const message =
                     'Per questa casa non sono presenti visualizzazioni nel periodo indicato.';

                  ctx.save();
                  ctx.textAlign = 'center';
                  ctx.textBaseline = 'middle';
                  ctx.font = '18px Sans-serif';

                  // Calcola la larghezza e altezza del testo
                  const textMetrics = ctx.measureText(message);
                  const textWidth = textMetrics.width;
                  const textHeight = parseInt(ctx.font);

                  // Disegna il rettangolo con il colore di sfondo
                  ctx.fillStyle = '{{ env('color_secondary') }}';
                  ctx.fillRect(
                     (width - textWidth) / 2 - padding,
                     (height - textHeight) / 2 - padding,
                     textWidth + padding * 2,
                     textHeight + padding * 2
                  );

                  // Imposta il colore del testo e disegna il messaggio
                  ctx.fillStyle = 'white';
                  ctx.fillText(message, width / 2, height / 2);
                  ctx.restore();
               }
            }
         };

         // Configurazione del grafico delle visualizzazioni totali suddivise per casa
         let viewsChart = new Chart(ctx, {
            type: 'bar',
            data: {
               labels: viewsLabels,
               datasets: [{
                  label: 'Visualizzazioni per casa',
                  data: viewsData,
                  backgroundColor: '{{ env('color_secondary') }}',
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
            },
            plugins: [noDataPlugin]
         });

         // Configurazione del grafico delle top 3 case più visualizzate
         let topThreeChart = new Chart(topCtx, {
            type: 'doughnut',
            data: {
               labels: topThreeLabels,
               datasets: [{
                  label: 'Top 3 Case più visitate',
                  data: topThreeData,
                  backgroundColor: ['{{ env('color_secondary') }}',
                     '{{ env('color_light_green') }}', '{{ env('color_dark_blue') }}'
                  ],
                  hoverOffset: 4
               }]
            }
         });

         const predefinedIntervals = document.getElementById('predefined_intervals');
         const startDateInput = document.getElementById('start_date');
         const endDateInput = document.getElementById('end_date');

         // Imposta la data massima per l'input di fine data come oggi
         const today = new Date().toISOString().split('T')[0];
         endDateInput.setAttribute('max', today);

         // Aggiorna le date di inizio e fine in base agli intervalli predefiniti
         predefinedIntervals.addEventListener('change', function() {
            const interval = this.value;
            const today = new Date();
            let startDate, endDate;

            switch (interval) {
               case 'last_7_days':
                  startDate = new Date(today);
                  startDate.setDate(today.getDate() - 7);
                  endDate = today;
                  break;
               case 'last_31_days':
                  startDate = new Date(today);
                  startDate.setDate(today.getDate() - 31);
                  endDate = today;
                  break;
               case 'today':
                  startDate = today;
                  endDate = today;
                  break;
               case 'custom':
                  startDate = startDateInput.value;
                  endDate = endDateInput.value;
                  break;
               default:
                  startDate = '';
                  endDate = '';
            }

            startDateInput.value = startDate.toISOString().split('T')[0];
            endDateInput.value = endDate.toISOString().split('T')[0];
         });

         // Se l'utente cambia manualmente la data di inizio o di fine, seleziona "Personalizzato"
         startDateInput.addEventListener('change', function() {
            predefinedIntervals.value = 'custom';
         });

         endDateInput.addEventListener('change', function() {
            predefinedIntervals.value = 'custom';
         });

         // Gestisci il click sul pulsante "Applica" per aggiornare i grafici
         document.getElementById('apply_filters').addEventListener('click', function() {
            const houseId = document.getElementById('house_id').value;
            const startDate = startDateInput.value;
            const endDate = endDateInput.value;
            const interval = predefinedIntervals
               .value; // Prende il valore corrente dell'intervallo predefinito

            const form = document.createElement('form');
            form.method = 'GET';
            form.action = '{{ route('admin.statistics.index') }}';

            const houseInput = document.createElement('input');
            houseInput.type = 'hidden';
            houseInput.name = 'house_id';
            houseInput.value = houseId;
            form.appendChild(houseInput);

            const startInput = document.createElement('input');
            startInput.type = 'hidden';
            startInput.name = 'start_date';
            startInput.value = startDate;
            form.appendChild(startInput);

            const endInput = document.createElement('input');
            endInput.type = 'hidden';
            endInput.name = 'end_date';
            endInput.value = endDate;
            form.appendChild(endInput);

            const intervalInput = document.createElement('input');
            intervalInput.type = 'hidden';
            intervalInput.name = 'predefined_intervals';
            intervalInput.value = interval;
            form.appendChild(intervalInput);

            document.body.appendChild(form);
            form.submit();
         });
      });
   </script>
@endsection
