@extends('layouts.fo')

@section('content')

    <h1>BackOffice</h1>

    @if (Auth::user()->user_type == \App\Models\User::TYPE_ADMIN)
        <div class="alert alert-warning">
            Conta de Administrador
        </div>
    @endif

    <h5>Olá, {{ Auth::user()->name }}</h5>

@endsection
