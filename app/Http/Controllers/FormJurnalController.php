<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FormJurnalController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $accountname = $user->profile; 
        return view('formjurnal','accountname'); // Nama view untuk form jurnal
    }
}
