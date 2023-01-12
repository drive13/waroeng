<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        return "ini dashboard";
        // return view('dashboard.index', [
        //     'title' => 'Dashboard',
        // ]);
    }
}
