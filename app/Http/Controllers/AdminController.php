<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $accountname = $user->profile; 
        return view('admin.dashboard',  compact('user', 'accountname'));
        return view('includes.header',  compact('user', 'accountname'));
    }
    public function dataguru()
    {
        $user = Auth::user();
        $accountname = $user->profile; 
        return view('admin.dataguru',compact('user', 'accountname'));
    }
    public function viewjurnal(){
        $user = Auth::user();
        $accountname = $user->profile; 
        return view('admin.datajurnal', compact('accountname'));
    }
}
