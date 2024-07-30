@extends('layouts.admin')

@section('content')
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-md-8 pt-5 pb-3">
            <div class="card card-premium">
               <div class="card-header card-header-premium">
                  Dettagli del pagamento
               </div>
               <ul class="list-group list-group-flush">
                  <!-- Confirmation message with dynamic data -->
                  <div class="list-group-item py-4 text-center fs-5">
                     Stai per pagare <span class="fw-bold">{{ $amount }} € </span> per una
                     sponsorizzazione di tipo <span class="fw-bold">{{ ucfirst($sponsorshipType) }}</span>
                     della durata di <span class="fw-bold">{{ $duration }} ore</span>.
                  </div>
                  <li class="list-group-item">
                     <form id="payment-form" action="{{ route('admin.sponsorships.payment.handle') }}" method="POST">
                        @csrf
                        <!-- Hidden fields to pass data to the backend -->
                        <input type="hidden" name="house_id" value="{{ $houseId }}">
                        <input type="hidden" name="sponsorship_id" value="{{ $sponsorshipId }}">
                        <input type="hidden" name="amount" value="{{ $amount }}">
                        <input type="hidden" name="duration" value="{{ $duration }}">

                        <div class="form-group pt-3">
                           <label class="fw-bold text-evident" for="cc-name">Nome sulla carta</label>
                           <input type="text"
                              class="form-control input-height"
                              id="cc-name"
                              placeholder="Nome Cognome"
                              required>
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
         <div class="col-md-8">
            <div class="col-12 col-sm-2">
               <a href="{{ route('admin.sponsorships.index') }}?house_id={{ $houseId }}"
                  class="btn btn-custom-outline h-75 w-50 d-flex align-items-center justify-content-center p-2">
                  <i class="fa-solid fa-angles-left"></i>
               </a>
            </div>
         </div>
      </div>
   </div>

   <!-- Container for toasts -->
   <div class="toast-container position-fixed bottom-0 end-0 p-3">
      <!-- Toast for payment processing error -->
      <div id="payment-error-toast"
         class="toast"
         role="alert"
         aria-live="assertive"
         aria-atomic="true">
         <div class="toast-header bg-danger text-white">
            <strong class="me-auto">Errore di Pagamento</strong>
            <button type="button"
               class="btn-close btn-close-white"
               data-bs-dismiss="toast"
               aria-label="Close"></button>
         </div>
         <div class="toast-body">
            Errore: Il pagamento non è stato processato correttamente.
         </div>
      </div>

      <!-- Toast for invalid credit card data -->
      <div id="invalid-card-toast"
         class="toast"
         role="alert"
         aria-live="assertive"
         aria-atomic="true">
         <div class="toast-header bg-danger text-white">
            <strong class="me-auto">Dati Carta Non Validi</strong>
            <button type="button"
               class="btn-close btn-close-white"
               data-bs-dismiss="toast"
               aria-label="Close"></button>
         </div>
         <div class="toast-body">
            Errore: I dati della carta di credito non sono validi.
         </div>
      </div>
   </div>

   <!-- Payment confirmation modal -->
   <div class="modal fade"
      id="confirm-payment-modal"
      tabindex="-1"
      aria-labelledby="confirm-payment-modal-label"
      aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="confirm-payment-modal-label">Conferma Pagamento</h5>
               <button type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"></button>
            </div>
            <div class="modal-body ">
               <p class="text-custom-secondary">Stai per pagare un importo di <strong>{{ $amount }} €</strong>. Sei
                  sicuro di voler continuare?</p>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
               <button type="button" id="confirm-payment-btn" class="btn btn-custom">Conferma e Paga</button>
            </div>
         </div>
      </div>
   </div>

   <!-- Payment status modal -->
   <div class="modal fade"
      id="payment-status-modal"
      tabindex="-1"
      aria-labelledby="payment-status-modal-label"
      aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="payment-status-modal-label">Esito del pagamento</h5>
               <button type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <p id="payment-status-message">Pagamento in corso...</p>
            </div>
            <div class="modal-footer">
               <button type="button"
                  id="payment-status-close-btn"
                  class="btn btn-secondary"
                  data-house-id="{{ $houseId }}">Chiudi</button>
            </div>
         </div>
      </div>
   </div>


   <!-- scripts -->
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
                  showToast('payment-error-toast', 'Errore nel fetch del token.');
                  return;
               }

               braintree.client.create({
                  authorization: data.token
               }, function(err, clientInstance) {
                  if (err) {
                     console.error('Errore nella creazione del client:', err);
                     showToast('payment-error-toast', 'Errore nella creazione del client.');
                     return;
                  }

                  braintree.hostedFields.create({
                     client: clientInstance,
                     fields: {
                        number: {
                           selector: '#card-number',
                           placeholder: 'XXXX XXXX XXXX XXXX'
                        },
                        cvv: {
                           selector: '#cvv',
                           placeholder: 'XXX'
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
                        showToast('payment-error-toast',
                           'Errore nella creazione dei campi ospitati.');
                        return;
                     }

                     document.getElementById('payment-form').addEventListener('submit',
                        function(event) {
                           event.preventDefault();

                           // Show the confirmation modal
                           const confirmModal = new bootstrap.Modal(document
                              .getElementById('confirm-payment-modal'));
                           confirmModal.show();

                           // Handle the click on the confirm payment button
                           document.getElementById('confirm-payment-btn')
                              .addEventListener('click', function() {
                                 confirmModal.hide();

                                 hostedFieldsInstance.tokenize(function(err,
                                    payload) {
                                    if (err) {
                                       console.error(
                                          'Errore nella tokenizzazione:',
                                          err);
                                       showToast(
                                          'payment-error-toast',
                                          'Errore: i dati inseriti non sono validi.'
                                       );
                                       return;
                                    }

                                    const input = document
                                       .createElement('input');
                                    input.type = 'hidden';
                                    input.name =
                                       'payment_method_nonce';
                                    input.value = payload.nonce;
                                    document.getElementById(
                                          'payment-form')
                                       .appendChild(input);

                                    fetch(document.getElementById(
                                             'payment-form')
                                          .action, {
                                             method: 'POST',
                                             body: new FormData(
                                                document
                                                .getElementById(
                                                   'payment-form'
                                                )),
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
                                             // Show the payment status modal
                                             const
                                                statusModal =
                                                new bootstrap
                                                .Modal(
                                                   document
                                                   .getElementById(
                                                      'payment-status-modal'
                                                   ));
                                             document
                                                .getElementById(
                                                   'payment-status-message'
                                                )
                                                .innerText =
                                                'Pagamento avvenuto con successo!';
                                             statusModal
                                                .show();
                                          } else {
                                             showToast(
                                                'payment-error-toast',
                                                'Errore: ' +
                                                data
                                                .error);
                                          }
                                       })
                                       .catch(err => {
                                          console.error(
                                             'Errore nella richiesta di pagamento:',
                                             err);
                                          showToast(
                                             'payment-error-toast',
                                             'Errore durante il pagamento.'
                                          );
                                       });
                                 });
                              }, {
                                 once: true
                              }); // Ensure the click is handled only once
                        });
                  });
               });
            })
            .catch(err => {
               console.error('Errore nel fetch del token:', err);
               showToast('payment-error-toast', 'Errore nel fetch del token.');
            });

         // Function to show toasts
         function showToast(toastId, message) {
            const toastEl = document.getElementById(toastId);
            const toast = new bootstrap.Toast(toastEl);
            toastEl.querySelector('.toast-body').innerText = message;
            toast.show();
         }

         // Handle the click on the "Close" button of the payment status modal
         const closeButton = document.getElementById('payment-status-close-btn');
         if (closeButton) {
            closeButton.addEventListener('click', function() {
               const houseId = this.getAttribute('data-house-id');
               window.location.href = `/admin/sponsorships?house_id=${houseId}`;
            });
         }
      });
   </script>




   <style>
      .text-custom-secondary {

         color: {{ env('color_dark_grey') }};
      }

      .input-height {
         height: 38px;
         /* Altezza standard per gli input */
      }

      .btn-custom {
         background-color: {{ env('color_secondary') }};
         border-color: {{ env('color_secondary') }};
         color: #FFFFFF;
      }

      .btn-custom:hover {
         color: white;
         box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
         background-color: {{ env('color_secondary') }};
         border-color: {{ env('color_secondary') }};
      }

      .card-header-premium {
         background-color: {{ env('color_secondary') }};
         color: #FFFFFF;
         padding: 1rem;
      }

      .text-evident {
         color: {{ env('color_secondary') }};
      }

      .card-premium {
         border: 1px solid {{ env('color_secondary') }};
      }

      .btn-custom-outline {
         height: 50%;
         border-color: {{ env('color_secondary') }};
         color: {{ env('color_secondary') }};


         &:hover {
            color: white;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
            background-color: {{ env('color_secondary') }};
         }
      }
   </style>
@endsection
