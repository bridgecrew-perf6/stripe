<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function index() {

        $users = User::all();
        $user="";
        return view('utilisateur-list', compact('users','user'));
    }
}