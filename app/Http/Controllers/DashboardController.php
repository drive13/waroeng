<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        return view('dashboard.index', [
            'title' => 'Dashboard',
        ]);
    }
}
