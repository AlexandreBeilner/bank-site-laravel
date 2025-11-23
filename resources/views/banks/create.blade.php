@extends('layouts.app')

@section('title', 'Novo Banco')
@section('page_title', 'Novo Banco')

@section('content')
    <div class="bg-slate-950/80 border border-slate-800 rounded-lg p-6">
        <h2 class="text-lg font-semibold text-orange-400 mb-4">
            Criar Novo Banco
        </h2>

        @include('banks._form', [
            'action' => route('banks.store'),
            'method' => 'POST',
            'bank' => null,
            'submitLabel' => 'Criar',
        ])
    </div>
@endsection
