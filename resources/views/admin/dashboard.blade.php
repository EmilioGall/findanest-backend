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

    <style>
        .card-icon {
            font-size: 50px;
            text-align: center;
            margin: 50px 0;
        }

        a {
            text-decoration: none;
        }
    </style>
    </head>

    <body>

        <div class="container mt-5">
            <div class="row">
                <!-- Card 1 casa-->
                <div class="col-md-4 mb-4">
                    <a href="{{ route('admin.house.index') }}">
                        <div class="card">
                            <div class="card-body d-flex justify-content-center align-items-center">
                                <i class="fas fa-home card-icon"></i>
                            </div>
                        </div>
                    </a>

                </div>
                <!-- Card 2 analytics-->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <i class="fas fa-chart-simple card-icon"></i>
                        </div>
                    </div>
                </div>
                <!-- Card 3 utente-->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <i class="fas fa-user card-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Card 4 messaggi-->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <i class="fas fa-message card-icon"></i>
                        </div>
                    </div>
                </div>
                <!-- Card 5 sponsorships-->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <i class="fas fa-dollar card-icon"></i>
                        </div>
                    </div>
                </div>
                <!-- Card 6 logout-->


                <div class="col-md-4 mb-4">

                    <div class="card">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="fas fa-power-off card-icon"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        </div>
    @endsection
