@extends('layouts.admin')

@section('content')
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Your Profile') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h3 class="text-lg font-semibold mb-4 mt-5">Il tuo profilo</h3>
                <p><span class="fw-bold">Nome:</span> {{ $user->name }}</p>
                <p><span class="fw-bold">Cognome:</span> {{ $user->surname }}</p>
                <p><span class="fw-bold">Data di nascita:</span> {{ $user->date_of_birth->format('d/m/Y') }}</p>
                <p><span class="fw-bold">Email:</span> {{ $user->email }}</p>
            </div>
        </div>
    </div>
</div>

@endsection

