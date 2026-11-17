<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function allTasks()
    {
        $tasks = $this->getAllTasks();

        //tarefas do id 4
        // Task::TaskByUser(4);

        //chamar pela variável do modelo
        // Task::STATUS_COMPLETED;

    return view('tasks.alltasks', compact('tasks'));
    }

    protected function getAllTasks() {
        $tasks = Task:: join('users', 'tasks.user_id', '=', 'users.id')
            ->select(
                'tasks.id',
                'tasks.name',
                'tasks.status',
                'tasks.due_at',
                'users.name as user_name'
            )
            ->get();

        return $tasks;
    }

    public function editTasks(int $id)
{
    $taskInfo = Task::join( 'users',
        'tasks.user_id',
        '=',
        'users.id'
    )
    ->where('tasks.id', $id)
    ->select(
        'tasks.id',
        'tasks.description',
        'tasks.due_at',
        'tasks.status',
        'tasks.name',
        'users.name as user_name'
    )
    ->first();

    return view('tasks.edittask', compact('taskInfo'));
}

public function deleteTasks(int $id){

    Task::where('id', $id)->delete();

    return back();
}



public function addTasks()
{
    $users = $this->getAllUsers();

    return view('tasks.addtask', compact('users'));
}

private function getAllUsers()
{
    $users = User::select('id', 'name')->get();

    return $users;
}


public function storeTask(Request $request)
{
    // validar os dados
    $request->validate([
        'name' => 'required|string|max:50',
        'description' => 'required',
        'user_id' => 'required|exists:users,id'
    ]);

    // inserir na base de dados
    Task::insert([
        'name' => $request->name,
        'email' => $request->email,
        'user_id' => $request->user_id
        ]);

    return redirect()->route('tasks.all')->with('message','Tarefa adicionada com sucesso!');
}

}

