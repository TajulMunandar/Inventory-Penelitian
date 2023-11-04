<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\Unit;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $units = Unit::all();
        return view('dashboard.index')->with(compact('units'));
    }
}
