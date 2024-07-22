@extends('layouts.admin')

@section('content')
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Your Profile') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div>
            <div class="p-6">
                <h1 class="text-lg font-semibold mb-5 mt-5">Il tuo profilo</h1>
                <p><span class="fw-bold">Nome:</span> {{ $user->name }}</p>
                <p><span class="fw-bold">Cognome:</span> {{ $user->surname }}</p>
                <p><span class="fw-bold">Data di nascita:</span> {{ $user->date_of_birth ? $user->date_of_birth->format('d/m/Y') : '' }}</p>
                <p><span class="fw-bold">Email:</span> {{ $user->email }}</p>
            </div>
        </div>
    </div>
</div>

@endsection

