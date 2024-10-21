<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = $user->profile; 
        return view('admin.dashboard',  compact('user', 'profile'));
        return view('includes.header',  compact('user', 'profile'));
    }
    public function dataguru()
    {
        $user = Auth::user();
        $profile = $user->profile; 
        return view('admin.dataguru',compact('user', 'profile'));
        return view('includes.header',  compact('user', 'profile'));
    }
}
