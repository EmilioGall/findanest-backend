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
                <p><strong>Nome:</strong> {{ $user->name }}</p>
                {{-- <p><strong>Cognome:</strong> {{ $user->surname }}</p> --}}
                <p><strong>Email:</strong> {{ $user->email }}</p>
            </div>
        </div>
    </div>
</div>
@endsection

