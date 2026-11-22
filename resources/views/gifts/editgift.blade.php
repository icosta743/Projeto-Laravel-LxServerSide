@extends('layouts.fo')

@section('content')

<div class="container mt-3">

    <h6>Detalhes da prenda {{ $giftInfo->name }}</h6>
    <p>Pessoa: {{ $giftInfo->user_name }}</p>
    <p>Valor previsto: {{ $giftInfo->expected_value }} €</p>
    <p>Valor gasto: {{ $giftInfo->spent_value }} €</p>
    <h2>Editar prenda</h2>

    <form method="POST" action="{{ route('gifts.update') }}">
        @method('PUT')
        @csrf

        <input type="hidden" name="id" value="{{ $giftInfo->id }}">

        <div class="mb-3">
            <label>Nome da prenda</label>
            <input value="{{ $giftInfo->name }}" required type="text" name="name" class="form-control">
        </div>
        @error('name')
            <p>Nome inválido</p>
        @enderror

        <div class="mb-3">
            <label>Valor previsto (€)</label>
            <input value="{{ $giftInfo->expected_value }}" required type="number" step="0.01" name="expected_value" class="form-control">
        </div>
        @error('expected_value')
            <p>Valor previsto inválido</p>
        @enderror

        <div class="mb-3">
            <label>Valor gasto (€)</label>
            <input value="{{ $giftInfo->spent_value }}" type="number" step="0.01" name="spent_value" class="form-control">
        </div>
        @error('spent_value')
            <p>Valor gasto inválido</p>
        @enderror

        <div class="mb-3">
            <label>Pessoa</label>

            <select required name="user_id" class="form-control">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $user->id == $giftInfo->user_id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>
        @error('user_id')
            <p>Pessoa inválida</p>
        @enderror

        <button type="submit" class="btn btn-primary">Actualizar</button>
        
    </form>

</div>

@endsection
