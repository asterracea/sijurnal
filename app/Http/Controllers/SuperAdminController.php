<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    function index()
    {
        $user = Auth::user();
        $profile = $user->profile; 
        return view('super_admin.dashboard',  compact('user', 'profile'));
        return view('includes.header',  compact('user', 'profile'));
    }
}
