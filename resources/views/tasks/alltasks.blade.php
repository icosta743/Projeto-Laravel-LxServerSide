
@extends('layouts.fo')

@section('content')

@if (session('message'))
<div class="alert alert-success">
    {{session('message')}}
</div>
@endif

    <a class="btn btn-warning" href="{{ route('tasks.add') }}">Adicionar tarefa</a>
    <h6>Tarefas da base de dados</h6>
    <table class="table">
        </thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Estado</th>
                <th scope="col">Data de conclusão</th>
                <th scope="col">Pessoa responsável</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <th scope="row">{{ $task->id }}</th>
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->status ? 'Concluída' : 'Por fazer' }}</td>
                    <td>{{ $task->due_at }}</td>
                    <td>{{ $task->user_name }}</td>
                    <td>
                        <a href="{{ route('tasks.delete', $task->id) }}"
                           class="btn btn-danger">Apagar</a>

                        <a href="{{ route('tasks.edit', $task->id) }}"
                           class="btn btn-info">Ver / Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

</div>

@endsection
