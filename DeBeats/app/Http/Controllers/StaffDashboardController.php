<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Venue; 
use App\Models\Course;
use App\Models\StudentRegistration; 



use Illuminate\Http\Request;

class StaffDashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.staffDash');
    }
    public function examList()
{
    $all_users = User::all(); // Ensure the User model is imported
    return view('staffdash', compact('all_users'));
}
public function showCourses()
{
    $courses = Course::all(); // Fetch all courses 
    return view('courses.index', ['courses' => $courses]); // Pass courses to the view
}

public function showVenues()
{
    $venues = Venue::all(); // Ensure you have a Venue model and data in your database.
    return view('venues.index', ['venues' => $venues]);
}

public function searchStudentRegistrations(Request $request)
{
    // Validate the input UTMID
    $request->validate([
        'UTMID' => 'required|exists:users,UTMID', // Ensure UTMID exists in the 'users' table
    ]);

    // Fetch the student's data
    $student = User::where('UTMID', $request->UTMID)->first();

    if ($student) {
        // Fetch the student's registered courses
        $registrations = StudentRegistration::where('UTMID', $student->UTMID)->get();
        $courses = $registrations->map(function ($registration) {
            return [
                'course_code' => $registration->course->course_code,
                'course_name' => $registration->course->course_name,
            ];
        });

        // Pass the data to the view
        $studentCourses = [
            'student_name' => $student->name,
            'UTMID' => $student->UTMID,
            'courses' => $courses,
        ];

        return view('student-registrations.index', compact('studentCourses'))->with('courses', $this->getAllCourses());
    }

    return redirect()->back()->with('error', 'Student not found!');
}

public function showStudentRegistrations()
{
    $courses = $this->getAllCourses();
    return view('student-registrations.index', ['courses' => $courses]);
}

private function getAllCourses()
{
    $courses = Course::with(['studentRegistrations.student'])->get();
    return $courses->map(function ($course) {
        return [
            'course_code' => $course->course_code,
            'course_name' => $course->course_name,
            'students' => $course->studentRegistrations->map(function ($registration) {
                return [
                    'student_name' => $registration->student->name,
                    'UTMID' => $registration->student->UTMID,
                ];
            }),
        ];
    });
}





}
