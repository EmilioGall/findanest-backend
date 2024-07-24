@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 py-5">
                <div class="card card-premium">
                    <div class="card-header card-header-premium">
                        Dettagli del pagamento
                    </div>
                    <ul class="list-group list-group-flush">
                        <!-- Messaggio di conferma con i dati dinamici -->
                        <div class="list-group-item py-4 text-center fs-5">
                            Stai per pagare <span class="fw-bold">{{ $amount }} € </span> per una
                            sponsorizzazione di tipo <span class="fw-bold">{{ ucfirst($sponsorshipType) }}</span>
                            della durata di <span class="fw-bold">{{ $duration }} ore</span>.
                        </div>
                        <li class="list-group-item">
                            <form id="payment-form" action="{{ route('admin.sponsorships.payment.handle') }}"
                                method="POST">
                                @csrf
                                <!-- Campi nascosti per passare i dati al backend -->
                                <input type="hidden" name="house_id" value="{{ $houseId }}">
                                <input type="hidden" name="sponsorship_id" value="{{ $sponsorshipId }}">
                                <input type="hidden" name="amount" value="{{ $amount }}">
                                <input type="hidden" name="duration" value="{{ $duration }}">

                                <div class="form-group pt-3">
                                    <label class="fw-bold text-evident" for="cc-name">Nome sulla carta</label>
                                    <input type="text" class="form-control input-height" id="cc-name"
                                        placeholder="Nome Cognome" required>
                                </div>

                                <div class="form-group pt-3">
                                    <label class="fw-bold text-evident" for="cc-number">Numero della carta</label>
                                    <div id="card-number" class="form-control input-height"></div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group pt-3">
                                            <label class="fw-bold text-evident" for="cc-expiration">Scadenza</label>
                                            <div id="expiration-date" class="form-control input-height"></div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group pt-3">
                                            <label class="fw-bold text-evident" for="cc-cvv">CVV</label>
                                            <div id="cvv" class="form-control input-height"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-custom mt-4 mb-2">Paga ora</button>
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Modale di conferma pagamento -->
    <div class="modal fade" id="confirm-payment-modal" tabindex="-1" aria-labelledby="confirm-payment-modal-label"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirm-payment-modal-label">Conferma Pagamento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Stai per pagare un importo di <strong>{{ $amount }} €</strong>. Sei
                        sicuro di voler continuare?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                    <button type="button" id="confirm-payment-btn" class="btn btn-custom">Conferma e Paga</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modale di stato del pagamento -->
    <div class="modal fade" id="payment-status-modal" tabindex="-1" aria-labelledby="payment-status-modal-label"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="payment-status-modal-label">Esito del pagamento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="payment-status-message">Pagamento in corso...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" id="payment-status-close-btn" class="btn btn-secondary"
                        data-house-id="{{ $houseId }}">Chiudi</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Include i tuoi script -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://js.braintreegateway.com/web/3.103.0/js/client.min.js"></script>
    <script src="https://js.braintreegateway.com/web/3.103.0/js/hosted-fields.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('{{ route('admin.sponsorships.payment.token') }}')
                .then(response => response.json())
                .then(data => {
                    if (!data.token) {
                        console.error('Token non trovato');
                        return;
                    }

                    braintree.client.create({
                        authorization: data.token
                    }, function(err, clientInstance) {
                        if (err) {
                            console.error('Errore nella creazione del client:', err);
                            return;
                        }

                        braintree.hostedFields.create({
                            client: clientInstance,
                            fields: {
                                number: {
                                    selector: '#card-number',
                                    placeholder: '4111 1111 1111 1111'
                                },
                                cvv: {
                                    selector: '#cvv',
                                    placeholder: '123'
                                },
                                expirationDate: {
                                    selector: '#expiration-date',
                                    placeholder: 'MM/YY'
                                }
                            }
                        }, function(err, hostedFieldsInstance) {
                            if (err) {
                                console.error('Errore nella creazione dei campi ospitati:',
                                err);
                                return;
                            }

                            document.getElementById('payment-form').addEventListener('submit',
                                function(event) {
                                    event.preventDefault();

                                    // Mostra il modale di conferma
                                    var confirmModal = new bootstrap.Modal(document
                                        .getElementById('confirm-payment-modal'));
                                    confirmModal.show();

                                    document.getElementById('confirm-payment-btn')
                                        .addEventListener('click', function() {
                                            confirmModal.hide();

                                            hostedFieldsInstance.tokenize(function(err,
                                                payload) {
                                                if (err) {
                                                    console.error(
                                                        'Errore nella tokenizzazione:',
                                                        err);
                                                    return;
                                                }

                                                const form = document
                                                    .getElementById(
                                                        'payment-form');
                                                const input = document
                                                    .createElement('input');
                                                input.type = 'hidden';
                                                input.name =
                                                    'payment_method_nonce';
                                                input.value = payload.nonce;
                                                form.appendChild(input);

                                                fetch(form.action, {
                                                        method: 'POST',
                                                        body: new FormData(
                                                            form),
                                                        headers: {
                                                            'X-CSRF-TOKEN': document
                                                                .querySelector(
                                                                    'meta[name="csrf-token"]'
                                                                    )
                                                                .getAttribute(
                                                                    'content'
                                                                    )
                                                        }
                                                    })
                                                    .then(response => response
                                                        .json())
                                                    .then(data => {
                                                        if (data.success) {
                                                            // Mostra il modale di successo
                                                            document
                                                                .getElementById(
                                                                    'payment-status-message'
                                                                    )
                                                                .innerText =
                                                                'Pagamento avvenuto con successo!';
                                                            var successModal =
                                                                new bootstrap
                                                                .Modal(
                                                                    document
                                                                    .getElementById(
                                                                        'payment-status-modal'
                                                                        ));
                                                            successModal
                                                                .show();
                                                        } else {
                                                            // Mostra il modale di errore
                                                            document
                                                                .getElementById(
                                                                    'payment-status-message'
                                                                    )
                                                                .innerText =
                                                                'Errore: ' +
                                                                data.error;
                                                            var errorModal =
                                                                new bootstrap
                                                                .Modal(
                                                                    document
                                                                    .getElementById(
                                                                        'payment-status-modal'
                                                                        ));
                                                            errorModal
                                                            .show();
                                                        }
                                                    })
                                                    .catch(err => {
                                                        console.error(
                                                            'Errore nella richiesta di pagamento:',
                                                            err);
                                                        document
                                                            .getElementById(
                                                                'payment-status-message'
                                                                )
                                                            .innerText =
                                                            'Errore durante il pagamento.';
                                                        var errorModal =
                                                            new bootstrap
                                                            .Modal(document
                                                                .getElementById(
                                                                    'payment-status-modal'
                                                                    ));
                                                        errorModal.show();
                                                    });
                                            });
                                        });
                                });
                        });
                    });
                })
                .catch(err => {
                    console.error('Errore nel fetch del token:', err);
                });

            // Gestisci il clic sul pulsante "Chiudi" del modale di stato del pagamento
            document.getElementById('payment-status-close-btn').addEventListener('click', function() {
                var houseId = this.getAttribute('data-house-id');
                window.location.href = `/admin/sponsorships?house_id=${houseId}`;
            });
        });
    </script>

    <style>
        .input-height {
            height: 38px;
            /* Altezza standard per gli input */
        }

        .btn-custom {
            background-color: {{ env('color_light_purple') }};
            border-color: {{ env('color_light_purple') }};
            color: #FFFFFF;
        }

        .btn-custom:hover {
            color: white;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
            background-color: {{ env('color_light_purple') }};
            border-color: {{ env('color_light_purple') }};
        }

        .card-header-premium {
            background-color: {{ env('color_light_purple') }};
            color: #FFFFFF;
            padding: 1rem;
        }

        .text-evident {
            color: {{ env('color_light_purple') }};
        }

        .card-premium {
            border: 1px solid {{ env('color_light_purple') }};
        }
    </style>
@endsection
