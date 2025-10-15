@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        Perfil de {{ $user->name }}
    </div>
    <div class="card-body">
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Tipo:</strong> {{ $user->type }}</p>
        <p><strong>CPF:</strong> {{ $user->cpf }}</p>
        <p><strong>WhatsApp:</strong> {{ $user->whatsapp }}</p>
    </div>
</div>
@endsection
