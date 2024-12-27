<?php

namespace App\Http\Controllers;

use App\Models\Venue; 
use App\Models\TestVenues; 
use Illuminate\Http\Request;

class LecturerDashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.lecturerDash');
    }

    public function testList()
    {
        $all_users = User::all(); // Ensure the User model is imported
        return view('lecturerdash', compact('all_users'));
    }
    public function showVenues()
{
    $venues = Venue::all(); // Ensure you have a Venue model and data in your database.
    return view('venues.index', ['venues' => $venues]);
}

public function showTestVenues()
{
    $test_venues = TestVenues::all(); // Ensure you have a Venue model and data in your database.
    return view('TestVenues.index', ['test_venues' => $test_venues]);
}
}
