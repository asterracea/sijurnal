<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccUserController extends Controller
{
    public function index()
    {
        return view('/admin/account_user');
    }
}
