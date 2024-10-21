<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GuruPiketController extends Controller
{
    function index()
    {
        $user = Auth::user();
        $profile = $user->profile; 
        return view('guru_piket.dashboard',  compact('user', 'profile'));
        return view('includes.header',  compact('user', 'profile'));
    }
}
