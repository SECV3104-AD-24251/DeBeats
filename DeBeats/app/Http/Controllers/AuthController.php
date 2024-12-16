<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login'); // For non-SPA apps
    }

    // Handle login
    public function login(Request $request)
{
    // Validate the login inputs
    $validatedData = $request->validate([
        'UTMID' => 'required|string',
        'password' => 'required|string',
    ]);

    // Attempt to log the user in using the validated data
    if (Auth::attempt(['UTMID' => $validatedData['UTMID'], 'password' => $validatedData['password']])) {
        // Regenerate the session to prevent session fixation attacks
        $request->session()->regenerate();

        // Redirect to the appropriate dashboard route based on user role
        return redirect($this->getDashboardRoute());
    }

    // Handle failed login
    return back()->withErrors(['UTMID' => 'Invalid UTM ID or password.']);
}


    // Determine and return the dashboard route for the user
    private function getDashboardRoute()
    {
        $user = Auth::user();
    
        switch ($user->role) {
            case 'student':
                return route('dashboard.student');
            case 'staff':
                return route('dashboard.staff');
            case 'lecturer':
                return route('dashboard.lecturer');
            default:
                return '/'; // Default route for unmatched roles
        }
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout(); // Log the user out
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate CSRF token

        // Redirect to login page after logging out
        return redirect('/login');
    }
}
