@extends('layouts.admin')

@php
    use Carbon\Carbon;
@endphp

@section('content')
    <div class="container">
        <h1 class="py-3 mb-4">Dettagli messaggio</h1>

        <div class="row">
            <div class="col-8">
                <!-- Casa -->
                <div class="row mb-4 border rounded py-2">
                    <div class="col-sm-4 col-md-2 d-flex align-items-center">
                        <h6 class="mb-0 fw-bold">Casa</h6>
                    </div>
                    <div class="col-sm-8 col-md-6">
                        {{ $house->title }}
                    </div>
                </div>


                <!-- Nome -->
                <div class="row mb-4">
                    <div class="col-sm-4 col-md-2 d-flex align-items-start">
                        <h6 class="mb-0 fw-bold">Nome</h6>
                    </div>
                    <div class="col-sm-8 col-md-10">
                        {{ $lead->name }}
                    </div>
                </div>

                <!-- E-mail -->
                <div class="row mb-4">
                    <div class="col-sm-4 col-md-2 d-flex align-items-start">
                        <h6 class="mb-0 fw-bold">E-Mail</h6>
                    </div>
                    <div class="col-sm-8 col-md-10">
                        {{ $lead->email }}
                    </div>
                </div>

                <!-- Telefono -->
                <div class="row mb-4">
                    <div class="col-sm-4 col-md-2 d-flex align-items-start">
                        <h6 class="mb-0 fw-bold">Telefono</h6>
                    </div>
                    <div class="col-sm-8 col-md-10">
                        {{ $lead->phone_number }}
                    </div>
                </div>

                <!-- Messaggio -->
                <div class="row mb-4">
                    <div class="col-sm-4 col-md-2 d-flex align-items-start">
                        <h6 class="mb-0 fw-bold">Messaggio</h6>
                    </div>
                    <div class="col-sm-8 col-md-10">
                        {{ $lead->message }}
                    </div>
                </div>
            </div>
        </div>

        <a class="btn btn-outline-primary mt-4" href="{{ route('admin.leads.index', ['house_id' => $houseId]) }}">
            <i class="fa-solid fa-angles-left"></i>
            <span class="ps-1">Torna alla lista messaggi</span>
        </a>
    </div>
@endsection
