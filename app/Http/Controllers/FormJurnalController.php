<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormJurnalController extends Controller
{
    public function index()
    {
        return view('formjurnal'); // Nama view untuk form jurnal
    }
}
