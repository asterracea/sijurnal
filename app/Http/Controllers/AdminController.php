<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Tahun;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $guruCount = User::where('role', 'guru')->count(); // Jumlah guru
        $guruPiketCount = User::where('role', 'guru_piket')->count();
        $user = Auth::user();
        $accountname = $user->profile;
        $tahun = Tahun::where('status', 'Aktif')->first();
        return view('admin.dashboard',  compact('user', 'accountname', 'tahun', 'guruCount', 'guruPiketCount'));
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
