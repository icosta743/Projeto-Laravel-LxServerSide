@extends('layouts.fo')

@section('content')

<div class="container mt-3">

    <h2 class="mb-3">Prendas de Natal</h2>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <a href="{{ route('gifts.add') }}" class="btn btn-success mb-3">Adicionar prenda</a>

    <table class="table table-striped table-hover">

        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Prenda</th>
                <th scope="col">Pessoa</th>
                <th scope="col">Valor previsto (€)</th>
                <th scope="col">Valor gasto (€)</th>
                <th scope="col">Diferença (€)</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($gifts as $gift)
                <tr>
                    <th scope="row">{{ $gift->id }}</th>
                    <td>{{ $gift->name }}</td>
                    <td>{{ $gift->user_name }}</td>
                    <td>{{ $gift->expected_value }}</td>
                    <td>{{ $gift->spent_value }}</td>

                    {{-- ponto extra: diferença entre o gasto e o previsto --}}
                    <td>
                        @if ($gift->spent_value > $gift->expected_value)
                            <span class="text-danger">+{{ number_format($gift->spent_value - $gift->expected_value, 2) }}</span>
                        @elseif ($gift->spent_value)
                            <span class="text-success">{{ number_format($gift->spent_value - $gift->expected_value, 2) }}</span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('gifts.delete', $gift->id) }}"
                           class="btn btn-danger">Apagar</a>

                        <a href="{{ route('gifts.edit', $gift->id) }}"
                           class="btn btn-info">Ver / Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

</div>

@endsection
