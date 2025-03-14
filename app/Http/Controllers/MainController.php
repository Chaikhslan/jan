<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index()
    {
        $user = Auth::getUser();
        $initials = strtoupper(substr($user->name, 0, 1)) . strtoupper(substr(strrchr($user->name, ' '), 1, 1));
        return view('panel.main_panel', compact('user', 'initials'));
    }
}
