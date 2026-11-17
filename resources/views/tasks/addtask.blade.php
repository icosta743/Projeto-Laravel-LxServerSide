
@extends('layouts.fo')

@section('content')

<div class="container mt-3">

    <h2>Adicionar tarefa</h2>

    <form action="{{ route('tasks.store') }}" method="POST">

        @csrf

        <div class="mb-3">
            <label>Nome da tarefa</label>
            <input type="text" name="name" class="form-control">
        </div>

        <div class="mb-3">
            <label>Descrição</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Utilizador responsável</label>

            <select name="user_id" class="form-control">
                <option value="">Escolher utilizador</option>

                @foreach ($users as $user)
                    <option value="{{ $user->id }}">
                        {{ $user->name }}
                    </option>
                @endforeach

            </select>
        </div>

        <button type="submit" class="btn btn-success">
            Guardar tarefa
        </button>

    </form>

</div>

@endsection
