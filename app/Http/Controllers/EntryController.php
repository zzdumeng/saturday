<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EntryController extends Controller
{ //
    public function login(Request $req)
    {
        $name = $req->input('name');
        $password = $req->input('password');

        $user = User::where('name', $name)->get()->first();
        $message = 'username or password not match';
        if (!$user) {
            return ['error' => 1, 'message' => $message];
        }
        if (Hash::check($password, $user->password)) {
            // return a token;
            $arr = $user->toArray();
            unset($arr['password']);
            $arr['token'] = '';
            return $arr;
        }
        return ['error' => 1, 'message' => $message];

    }

    public function signup()
    {
        $name = $req->input('name');
        $password = $req->input('password');

        $user = User::where('name', $name)->get()->first();
        if ($user) {
            return ['error' => 1, 'message' => 'name already be taken'];
        }
        $newUser = new User(['name' => $name, 'password' =>
            Hash::make($password)]);
        $newUser->save();
        return ['success' => true, 'id' => $newUser->id];
    }

    public function retrievePassword()
    {

    }
}
