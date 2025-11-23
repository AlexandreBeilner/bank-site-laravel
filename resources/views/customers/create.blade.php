@extends('layouts.app')

@section('title', 'Novo Cliente')
@section('page_title', 'Novo Cliente')

@section('content')
    <div class="bg-slate-950/80 border border-slate-800 rounded-lg p-6">
        <h2 class="text-lg font-semibold text-orange-400 mb-4">
            Criar Novo Cliente
        </h2>

        @include('customers._form', [
            'action' => route('customers.store'),
            'method' => 'POST',
            'customer' => null,
            'submitLabel' => 'Criar',
        ])
    </div>
@endsection
