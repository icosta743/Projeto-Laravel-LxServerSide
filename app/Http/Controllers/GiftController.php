<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use App\Models\User;
use Illuminate\Http\Request;

class GiftController extends Controller
{
    public function allGifts() {
        $gifts = $this->getAllGifts();

        return view('gifts.allgifts', compact('gifts'));
    }

    protected function getAllGifts() {
        $gifts = Gift::join('users', 'gifts.user_id', '=', 'users.id')
            ->select(
                'gifts.id',
                'gifts.name',
                'gifts.expected_value',
                'gifts.spent_value',
                'users.name as user_name'
            )
            ->get();

        return $gifts;
    }


    public function addGifts() {
        $users = $this->getAllUsers();

        return view('gifts.addgift', compact('users'));
    }

    private function getAllUsers() {
        $users = User::select('id', 'name')->get();

        return $users;
    }


    public function storeGift(Request $request) {

        // validar os dados
        $request->validate([
            'name' => 'required|string|max:50',
            'expected_value' => 'required|numeric|min:0',
            'spent_value' => 'nullable|numeric|min:0',
            'user_id' => 'required|exists:users,id'
        ]);

        // inserir na base de dados
        Gift::insert([
            'name' => $request->name,
            'expected_value' => $request->expected_value,
            'spent_value' => $request->spent_value,
            'user_id' => $request->user_id
        ]);

        return redirect()->route('gifts.all')->with('message', 'Prenda adicionada com sucesso!');
    }


    public function editGifts(int $id) {
        $giftInfo = Gift::join('users', 'gifts.user_id', '=', 'users.id')
            ->where('gifts.id', $id)
            ->select(
                'gifts.id',
                'gifts.name',
                'gifts.expected_value',
                'gifts.spent_value',
                'gifts.user_id',
                'users.name as user_name'
            )
            ->first();

        $users = $this->getAllUsers();

        return view('gifts.editgift', compact('giftInfo', 'users'));
    }


    public function updateGift(Request $request) {

        // validar os dados
        $request->validate([
            'name' => 'required|string|max:50',
            'expected_value' => 'required|numeric|min:0',
            'spent_value' => 'nullable|numeric|min:0',
            'user_id' => 'required|exists:users,id'
        ]);

        // actualizar na base de dados
        Gift::where('id', $request->id)->update([
            'name' => $request->name,
            'expected_value' => $request->expected_value,
            'spent_value' => $request->spent_value,
            'user_id' => $request->user_id
        ]);

        return redirect()->route('gifts.all')->with('message', 'Prenda actualizada com sucesso!');
    }


    public function deleteGifts(int $id) {
        Gift::where('id', $id)->delete();

        return back();
    }
    
}
