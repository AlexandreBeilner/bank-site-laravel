@extends('layouts.app')

@section('title', 'Editar Cliente')
@section('page_title', 'Editar Cliente')

@section('content')
    <div class="bg-slate-950/80 border border-slate-800 rounded-lg p-6">
        <h2 class="text-lg font-semibold text-orange-400 mb-4">
            Editar Cliente
        </h2>

        @include('customers._form', [
            'action' => route('customers.update', $customer),
            'method' => 'PUT',
            'customer' => $customer,
            'submitLabel' => 'Salvar',
        ])
    </div>
@endsection
