<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //
    public function show() {

    }

    //  get the real loggedin user
    public function getOrders(Request $req, $id) {
        // $user = auth()->user();
        // if($user->is_super || $user->id == $id)  {
            $user = User::find($id);
            return $user->orders();
        // }
    }
    public function getPoints(Request $req, $id) {
        // 
        $user = User::find($id);
        return $user->points();
    }
    public function getMessages(Request $req, $id) {
        // 
        $user = User::find($id);
        return $user->messages();
    }

    public function getFootprints(Request $req, $id) {
        
        $user = User::find($id);
        return $user->footprints();
    }

    public function getBills(Request $req, $id) {
        
        $user = User::find($id);
        return $user->bills();
    }



}
