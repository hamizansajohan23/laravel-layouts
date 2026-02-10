<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ListController extends Controller
{
    //

    public function index()
    {
        $user = User::with('posts')->find(1);

        return view('list.index');
    }
}
