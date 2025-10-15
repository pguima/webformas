@extends('layouts.app-login')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <h3 class="text-center mb-3">Login</h3>

        {{-- Mensagem de sucesso (ex: após logout) --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        @endif

        {{-- Mensagens de erro gerais --}}
        @if ($errors->has('login_error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $errors->first('login_error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label>Senha</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn btn-primary w-100">Entrar</button>
        </form>
    </div>
</div>
@endsection
