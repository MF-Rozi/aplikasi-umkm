<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use View;

class UserController extends Controller
{
    public function index()
    {
        return view('backend.user', [
            'title' => 'User Table',
            'user' => Auth::user()
        ]);
    }
}
