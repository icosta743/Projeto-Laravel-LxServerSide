<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Gift;

class UserController extends Controller
{
    public function allUsers() {

        $usersWDB = $this->loadUsersWDB();

        $usersFromDB = User::select('id','name', 'address', 'email', 'nif')
            ->get();

        //dd($usersFromDB);

        return view('users.allusers', compact('usersWDB', 'usersFromDB'));
    }


    public function addUsers()
    {
        $usersWDB = $this->loadUsersWDB();

        return view('users.addusers', compact('usersWDB'));
    }

    public function deleteUsers(int $id) {

        Task::where('user_id',$id)->delete();

        Gift::where('user_id',$id)->delete();


        User::where('id', $id)->delete();

        return back();
    }


    public function editUsers(int $id) {
    $userInfo = User::where('id', $id)->select('name', 'email', 'id', 'address', 'nif')->first();

    return view('users.edituser', compact('userInfo'));

    }


    public function updateUser(Request $request){


        $request->validate([
            'name' =>'required|max:50'
        ]);

        User::where('id', $request->id)->update([
            'name'=> $request->name,
            'address'=> $request->address,
            'nif'=> $request->nif,
        ]);

        return redirect()->route('users.all')->with('message', 'user actualizado com sucesso!');

    }


    public function storeUser(Request $request){

    //validar os dados no servidor
    $request->validate([
        'name' => 'required|max:50',
        'email' => 'required|email|unique:users',
        'password' => 'min:8|required'
    ]);

    //depois de validados, inserir na bd
    User::insert([
        'name'=> $request->name,
        'email'=> $request->email,
        'password'=> Hash::make($request->password)
        ]);

    return redirect()->route('users.all')->with('message', 'utilizador adicionado com sucesso!');

}

    private function loadUsersWDB()
    {
        $usersWithoutDB = [
            ['id' => 1, 'name' => 'Sara', 'email' => 'sara@gmail.com'],
            ['id' => 2, 'name' => 'Bruno', 'email' => 'Bruno@gmail.com'],
            ['id' => 3, 'name' => 'Marco', 'email' => 'Marco@gmail.com'],
            ['id' => 4, 'name' => 'António', 'email' => 'António@gmail.com']
        ];

        return $usersWithoutDB;
    }
}
