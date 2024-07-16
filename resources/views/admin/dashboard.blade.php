@extends('layouts.admin')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-4">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div> --}}


</head>

<body>

    <div class="container mt-5">
        <div class="row">
            <!-- Card 1 casa-->
            <div class="col-md-4 mb-4">
                <a href="{{ route('admin.house.index') }}">
                    <div class="card">
                        <div class="card-body">
                            <i class="fas fa-home card-icon"></i>
                            <div class="card-text">Annunci</div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Card 2 analytics-->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <i class="fas fa-chart-simple card-icon"></i>
                        <div class="card-text">Statistiche</div>
                    </div>
                </div>
            </div>
            <!-- Card 3 utente-->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <i class="fas fa-user card-icon"></i>
                        <div class="card-text">Utente</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Card 4 messaggi-->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <i class="fas fa-message card-icon"></i>
                        <div class="card-text">Messaggi</div>
                    </div>
                </div>
            </div>
            <!-- Card 5 sponsorships-->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <i class="fas fa-dollar-sign card-icon"></i>
                        <div class="card-text">Sponsorizzazioni</div>
                    </div>
                </div>
            </div>
            <!-- Card 6 logout-->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="fas fa-power-off card-icon"></i>
                            <div class="card-text">Logout</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<style>
.card {
    height: 250px; 
    /* border: 1px solid #000;  */
    border-radius: 15px; 
    display: flex;
    justify-content: center;
    align-items: center;
    transition: background 0.5s ease, color 0.5s ease, transform 0.3s ease; /* Transizioni per sfondo, colore e trasformazione */
}

.card:hover {
    
    
    color: #5D6D7E ;
    transform: scale(1.05); 
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); 
}

.card-icon {
    font-size: 70px; 
    text-align: center;
    margin-bottom: 10px;
}

.card-text {
    text-align: center;
    margin-top: 10px; 
    font-size: 20px;
}

.card-body {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100%;
}

a {
    text-decoration: none;
    color: inherit; /* Assicura che il colore del testo sia ereditato */
}



</style> 

@endsection
