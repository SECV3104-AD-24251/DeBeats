<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LecturerDashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.lecturerDash');
    }
}
