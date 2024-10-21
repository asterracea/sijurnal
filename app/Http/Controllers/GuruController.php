<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class GuruController extends Controller
{
    function index()
    {
        $user = Auth::user();
        $profile = $user->profile; 
        return view('guru.dashboard',  compact('user', 'profile'));
        return view('includes.header',  compact('user', 'profile'));
    }
}
