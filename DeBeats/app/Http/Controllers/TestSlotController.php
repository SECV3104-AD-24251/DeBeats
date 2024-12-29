<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Course;
use App\Models\Venue;
use App\Models\ClashReport;
use App\Models\TestSlot;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestSlotController extends Controller
{
    public function loadAllTestSlots()
    {
        $testSlots = TestSlot::where('UTMID', Auth::id())->get(); // Filter by the authenticated user
    
        return view('test_list', compact('testSlots'));
    
}


public function loadAddTestSlotForm()
{
    $date = $request->query('date', null); // Retrieve selected date from query string
    // Pass the course code to the view
    return view('add-test-slot', compact('date'));
}
public function getStaffTestList()
{ 
    $testSlots = TestSlot::all();  

    return view('staff-test-list', compact('testSlots'));
}


public function AddTestSlot(Request $request)
{
    $validated = $request->validate([
        'course_code' => 'required|string',
        'course_name' => 'required|string',
        'capacity' => 'required|integer',
        'exam_date' => 'required|date',
        'duration' => 'required|in:20:00-22:00,20:00-22:30,20:00-23:00',
        'exam_type' => 'required|string|in:Test 1,Test 2,Lab Test', 
        'type' => 'required|in:bilik kuliah,makmal',
        'venues' => 'required|array',
        'venues.*' => 'string',
        'file' => 'required|file|mimes:pdf,jpg,jpeg,png,docx|max:10240', // File validation
    ]);

    $courseCapacity = $request->capacity;

    // Calculate total capacity of selected venues
    $totalVenueCapacity = Venue::whereIn('venue_short', $request->venues)->sum('capacity');

    if ($totalVenueCapacity < $courseCapacity) {
        return redirect()->back()->with('fail', 'The total capacity of selected venues is less than the course capacity.');
    }

    try {
        // Handle file upload
        $filePath = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('test_slots', 'public');
        }

        // Save the test slot
        $testSlot = new TestSlot();
        $testSlot->course_code = $request->course_code;
        $testSlot->course_name = $request->course_name;
        $testSlot->capacity = $request->capacity;
        $testSlot->exam_date = $request->exam_date;
        $testSlot->duration = $request->duration;
        $testSlot->exam_type = $request->exam_type;
        $testSlot->type = $request->type;
        $testSlot->venue_short = implode(',', $request->venues);
        $testSlot->file_path = $filePath;  // Save the file path in the database
        $testSlot->UTMID = Auth::id(); // Store the user's ID
        $testSlot->save();

        return redirect('/test_list')->with('success', 'Test Slot Added Successfully');
    } catch (\Exception $e) {
        return redirect('/add/test')->with('fail', 'Failed to add test slot. Error: ' . $e->getMessage());
    }
}
   
   
public function uploadFile(Request $request, $id)
{
    // Validate the file upload
    $request->validate([
        'file' => 'required|file|mimes:pdf,jpg,jpeg,png,docx|max:10240',
    ]);

    try {
        // Store the file in the 'public/test_slots' folder
        $file = $request->file('file');
        $filePath = $file->store('test_slots', 'public'); // Saves the file in storage/app/public/test_slots

        // Update the file path in the database
        $testSlot = TestSlot::findOrFail($id);
        $testSlot->file_path = $filePath; // Store only the relative path
        $testSlot->save();

        return redirect()->back()->with('success', 'File uploaded successfully!');
    } catch (\Exception $e) {
        return redirect()->back()->with('fail', 'File upload failed. Error: ' . $e->getMessage());
    }
}



public function getCourseDetails($course_code)
{
    // Find the course by its code
    $course = Course::where('course_code', $course_code)->first();

    if ($course) {
        // Return the course name and capacity as JSON
        return response()->json([
            'course_name' => $course->course_name,
            'capacity' => $course->capacity
        ]);
    } else {
        return response()->json([
            'course_name' => '',
            'capacity' => ''
        ]);
    }
}

public function getVenuesByType($type)
{
    $venues = Venue::where('type', $type)->get(['venue_short', 'venue_name', 'capacity']);
    return response()->json($venues);
}

  // Delete an test slot
  public function deleteTestSlot($id){
    try {
        TestSlot::where('id', $id)->delete();
        return redirect('/test_list')->with('success', 'Test Slot Deleted Successfully!');
    } catch (\Exception $e) {
        return redirect('/test_list')->with('fail', $e->getMessage());
    }
}

public function getBookedDates()
{
    $bookedDates = TestSlot::pluck('exam_date')->toArray(); // Fetch all booked dates
    return response()->json($bookedDates);
}

//calendar test slot
public function fetchTests(Request $request)
{
    $month = $request->input('month');  // Month as 1-based index
    $year = $request->input('year');
    
    // Fetch the test slots for the given month and year
    $tests = TestSlot::whereYear('exam_date', $year)
                     ->whereMonth('exam_date', $month)
                     ->get();
    
    // Return the test slots as JSON response
    return response()->json($tests);
}

}
