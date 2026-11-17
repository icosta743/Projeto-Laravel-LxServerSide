@extends('layouts.fo')

@section('content')

<div class="container mt-3">

    <h2>Adicionar prenda</h2>

    <form action="{{ route('gifts.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nome da prenda</label>
            <input required type="text" name="name" class="form-control">
        </div>
        @error('name')
            <p>Nome inválido</p>
        @enderror

        <div class="mb-3">
            <label>Valor previsto (€)</label>
            <input required type="number" step="0.01" name="expected_value" class="form-control">
        </div>
        @error('expected_value')
            <p>Valor previsto inválido</p>
        @enderror

        <div class="mb-3">
            <label>Valor gasto (€)</label>
            <input type="number" step="0.01" name="spent_value" class="form-control">
        </div>
        @error('spent_value')
            <p>Valor gasto inválido</p>
        @enderror

        <div class="mb-3">
            <label>Pessoa</label>

            <select required name="user_id" class="form-control">
                <option value="">Escolher utilizador</option>

                @foreach ($users as $user)
                    <option value="{{ $user->id }}">
                        {{ $user->name }}
                    </option>
                @endforeach

            </select>
        </div>
        @error('user_id')
            <p>Pessoa inválida</p>
        @enderror

        <button type="submit" class="btn btn-success">
            Guardar prenda
        </button>

    </form>

</div>

@endsection
