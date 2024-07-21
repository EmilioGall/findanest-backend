@extends('layouts.app')

@section('content')
<style>
    img {
        max-width: 100%;
        object-fit: cover;
    }
    .hero-section {
        margin-top: 50px;
        height: 700px;
    }
    .text-color {
        color: #ba74ff;
    }
    .wrapper {
        position: relative;
        background-image: url({{ asset('images/sky2.jpg') }});
        background-repeat: no-repeat;
        background-size: cover;
    }
    .wrapper::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.3); 
        z-index: 1;
    }
    .wrapper .container {
        position: relative;
        z-index: 2;
    }
    .btn {
        border: 2px solid #ba74ff;
    }
    .btn:hover {
        background-color: #ba74ff;
    }
    .text-wrap{
        text-shadow: 1px 1px  black;
    }
</style>
    <div class="wrapper">
        <!-- prima parte -->
        <header class="hero-section">
            <div class="container">
                <div class="row align-items-center py-4 g-5">
                    <div class="col-12 col-md-6">
                        <div class="text-center text-md-start">
                            <h1 class="display-md-2 display-4 fw-bold text-light  pb-2">
                                <span class="text-color">Affitta </span ">con Facilità Guadagna senza Pensieri
                            </h1>
                            <p class="lead text-light text-wrap">
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptate dolorem aliquid quae sunt asperiores blanditiis, rerum eos, quis nam voluptatem distinctio! Nulla eius ea natus vitae voluptatem cupiditate architecto. Fugiat.
                            </p>
                            <button class="btn px-5 py-3 mt-3 fs-5 fw-medium text-light  text-wrap" type="button">
                                Pubblica il tuo primo annuncio
                            </button>
                        </div>
                    </div>

                </div>
                <!-- fine prima riga -->

            </div>
        </header>
    </div>

    <div class="wrapper-mission">

        <div class="container mb-5 mission">
            <div class="row align-items-center gx-3 gy-5 py-5 mt-5">
                <div class="col-12 col-md-12 col-lg-5 ">
                    <img src="{{ asset('images/backi.jpg') }}" class="img-fluid mx-auto d-block" alt="back" />
                </div>
                <div class="col-12 col-md-12 text-center text-lg-start col-lg-7">
                    <h2 class="fw-bold  fs-1 pb-3 text-color">La nostra Missione</h2>
                    <p class="about-text">
                        FindNest si dedica a rivoluzionare il mercato immobiliare rendendo la pubblicazione e la gestione degli annunci di affitto semplice, rapida ed efficace. La nostra missione è fornire una piattaforma intuitiva e accessibile che colleghi proprietari di immobili e affittuari in modo efficiente e trasparente.
                    </p>
                    <p class="about-text">
                        FindNest è una piattaforma innovativa e all'avanguardia che consente ai proprietari di immobili di pubblicare i loro annunci di affitto in pochi semplici passi. Fondata sul principio della semplicità e dell'efficienza, FindNest offre strumenti avanzati per garantire che ogni immobile riceva la massima visibilità e attragga i giusti affittuari.
                    </p>
                    <button class="btn px-5 py-3 mt-3 fs-5 fw-medium" type="button">
                        Scopri di piu
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="features-section py-5">
        <div class="container">
            <h2 class="fs-1 fw-bold text-center pt-5 pb-5 text-color">
                Key Features
            </h2>
            <div class="row g-5 pb-5">
                <div class="col-md-6 col-lg-4">
                    <div class="card px-3 py-4 shadow-sm">
                        <ion-icon class="ionicons" name="bulb-outline"></ion-icon>
                        <h3 class="f5">Pubblicazione Annunci Facile e Veloce</h3>
                            <br>
                            <ul>
                                <li><i class="fa-regular fa-circle-dot"></i> Carica le foto del tuo immobile e descrivilo con dettagli precisi.</li>
                                <br>
                                <li><i class="fa-regular fa-circle-dot"></i> Imposta il prezzo di affitto, la durata del contratto e altri dettagli rilevanti.</li>
                                <br>
                                <li><i class="fa-regular fa-circle-dot"></i> Pubblica l'annuncio con un solo clic.</li>
                            </ul>
                       
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card px-3 py-4 shadow-sm blue-bg">
                        <ion-icon class="ionicons" name="shield-checkmark-outline"></ion-icon>
                        <h3 class="f5">Gestione degli Annunci</h3>
                        <br>
                        <ul>
                            <li><i class="fa-regular fa-circle-dot"></i> Modifica e aggiorna i tuoi annunci in qualsiasi momento.</li>
                            <br>
                            <li><i class="fa-regular fa-circle-dot"></i> Monitora le visualizzazioni e le interazioni con il tuo annuncio tramite il nostro dashboard.</li>
                            <br>
                            <li><i class="fa-regular fa-circle-dot"></i> Un team di esperti sempre disponibile per assisterti nella pubblicazione e gestione dei tuoi annunci.</li>
                        </ul>
                   
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 offset-md-3 offset-0 offset-lg-0">
                    <div class="card px-3 py-4 shadow-sm">
                        <ion-icon class="ionicons" name="hourglass-outline"></ion-icon>
                        <h3 class="f5">Comunicazione Semplificata</h3>
                        <br>
                        <ul>
                            <li><i class="fa-regular fa-circle-dot"></i> Ricevi messaggi e richieste di informazioni direttamente attraverso la piattaforma.</li>
                            <br>
                            <li><i class="fa-regular fa-circle-dot"></i> Gestisci le richieste di visita e le domande degli affittuari in modo centralizzato.</li>
                            <br>
                            <li><i class="fa-regular fa-circle-dot"></i> Pubblica l'annuncio con un solo clic.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="row align-items-center justify-content-center">
            <div class="col-12">
                <h2 class="fs-1 fw-bold text-color text-center pb-5">
                    I nostri Pacchetti Sponsorizzazione
                </h2>
                <ul class="nav nav-tabs d-flex flx-wrap justify-content-center" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active me-md-3 me-1 text-dark" id="home-tab" data-bs-toggle="tab"
                            data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane"
                            aria-selected="true">
                            Essential
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link me-md-3 me-1 text-dark" id="vr" data-bs-toggle="tab"
                            data-bs-target="#vr-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane"
                            aria-selected="false">
                            Premium
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link me-md-3 me-1 text-dark" id="headphones-tab" data-bs-toggle="tab"
                            data-bs-target="#headphones-tab-pane" type="button" role="tab"
                            aria-controls="contact-tab-pane" aria-selected="false">
                            Excellence
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                        tabindex="0">
                        <div class="row g-4 mt-5 justify-content-center align-items-center">
                            <div class="col-12 col-md-4">
                                <img src="assets/headphones-1.webp" alt="" class="img-fluid  d-block mx-auto" />
                            </div>
                            <div class="col-12 col-md-4">
                                <img src="assets/vr-1.webp" alt="" class="img-fluid  d-block mx-auto" />
                            </div>
                            <div class="col-12 col-md-4">
                                <img src="assets/vr-2.webp" alt="" class="img-fluid  d-block mx-auto" />
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="vr-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                        tabindex="0">
                        <div class="row mt-5 g-4">
                            <div class="col-12 col-md-4">
                                <img src="assets/vr-1.webp" alt="" class="img-fluid" />
                            </div>
                            <div class="col-12 col-md-4">
                                <img src="assets/vr-2.webp" alt="" class="img-fluid" />
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="headphones-tab-pane" role="tabpanel" aria-labelledby="headphones-tab"
                        tabindex="0">
                        <div class="row g-4 mt-5">
                            <div class="col-12 col-md-4">
                                <img src="assets/headphones-1.webp" alt="" class="img-fluid" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5 mb-5">
        <div class="row">
            <div class="col-12">
                <h2 class="fw-bold text-color fs-1 pb-3 text-center">
                    Come Funziona?
                </h2>

                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button fs-3 text-dark fw-medium" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                aria-controls="collapseOne">
                                Pubblicazione dell'Annuncio
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p class="lead">
                                    Dopo esserti registrato su FindNest, puoi inserire i dettagli del tuo immobile, caricare foto di alta qualità e definire il prezzo e le condizioni di affitto. Una volta completata questa fase, l'annuncio sarà pubblicato e visibile ai potenziali affittuari.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fs-3 text-dark fw-medium" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                aria-controls="collapseTwo">
                                Gestione e Promozione dell'Annuncio
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p class="lead">
                                    Con il dashboard intuitivo di FindNest, puoi monitorare e aggiornare facilmente il tuo annuncio. Utilizza strumenti di analisi per capire le performance del tuo immobile e promuovi l'annuncio per aumentare la sua visibilità attraverso reti partner e motori di ricerca.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fs-3 text-dark fw-medium" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false"
                                aria-controls="collapseThree">
                                Comunicazione e Supporto
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p class="lead">
                                    Gestisci tutte le comunicazioni con i potenziali affittuari direttamente tramite la piattaforma, organizzando visite e rispondendo alle domande. Inoltre, puoi contare su un team di supporto dedicato per assistenza in ogni fase del processo.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

    <footer class="footer-section">
        <p class="text-center py-5 mb-0">
            &copy; 2024 <a href="https://boolean.careers/?utm_source=google&utm_campaign=it_search_brand&utm_medium=cpc&utm_content=boolean&utm_term=boolean&gad_source=1&gclid=CjwKCAjw4_K0BhBsEiwAfVVZ_xOnCw8FweyKbUmE4aajAxlp75LLn4I_TmXDrK0mLX5EgO57iPL7WRoCT0UQAvD_BwE">Boolean</a>. All rights reserved.
        </p>
    </footer>
@endsection
