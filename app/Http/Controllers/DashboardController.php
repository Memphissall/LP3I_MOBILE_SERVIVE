<?php

namespace App\Http\Controllers;

// PASTIKAN MENGGUNAKAN INI
use Illuminate\Routing\Controller; 
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard'); 
    }
}