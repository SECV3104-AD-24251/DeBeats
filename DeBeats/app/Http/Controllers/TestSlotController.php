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
use Illuminate\Support\Facades\DB;

class TestSlotController extends Controller
{
    public function loadAllTestSlots()
    {
        $testSlots = TestSlot::where('UTMID', Auth::id())->get(); // Filter by the authenticated user
    
        return view('test_list', compact('testSlots'));
    
}


public function loadAddTestSlotForm()
    {
        // Get the logged-in lecturer
        $lecturer = Lecturer::where('UTMID', auth()->user()->UTMID)->first();

        if (!$lecturer) {
            return redirect()->back()->with('error', 'Lecturer not found!');
        }

        // Fetch course details from the courses table using the course_code
        $course = Course::where('course_code', $lecturer->course_code)->first();

        if (!$course) {
            return redirect()->back()->with('error', 'Course not found for the lecturer!');
        }

        // Pass the combined data to the view
        return view('add-test-slot', [
            'course_code' => $lecturer->course_code,
            'course_name' => $course->course_name,
            'capacity' => $course->capacity,
        ]);
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
        'duration' => 'required|in:1:00,1:30,2:00,2:30,3:00',
        'selected_time' => 'required|string',
        'exam_type' => 'required|string|in:Test 1,Test 2,Lab Test',
        'type' => 'required|in:bilik kuliah,makmal',
        'venues' => 'required|array',
        'venues.*' => 'string',
        'file' => 'required|file|mimes:pdf,jpg,jpeg,png,docx|max:10240',
    ]);

    $courseCapacity = $request->capacity;

    // Calculate total capacity of selected venues
    $totalVenueCapacity = Venue::whereIn('venue_short', $request->venues)->sum('capacity');
    if ($totalVenueCapacity < $courseCapacity) {
        return redirect()->back()->with('fail', 'The total capacity of selected venues is less than the course capacity.');
    }

    // Fetch students registered for this course
    $studentsTakingCourse = DB::table('student_registrations')
        ->where('course_code', $request->course_code)
        ->pluck('UTMID');

    // Fetch all tests for these students
    $allTests = TestSlot::whereIn('course_code', function ($query) use ($studentsTakingCourse) {
        $query->select('course_code')
            ->from('student_registrations')
            ->whereIn('UTMID', $studentsTakingCourse);
    })->get();

    // 1. Check for time clashes
    foreach ($allTests as $test) {
        if ($test->exam_date === $request->exam_date && $test->selected_time === $request->selected_time) {
            return redirect()->back()->with('fail', 'Your students have a test at the same time. Please choose a different time.');
        }
    }

    // 2. Check for same-day test conflicts
    foreach ($allTests as $test) {
        if ($test->exam_date === $request->exam_date) {
            return redirect()->back()->with('fail', 'Your students already have a test on this date. Please choose a different date.');
        }
    }
// 3. Check for venue clashes
$venueClashes = TestSlot::where('exam_date', $request->exam_date)
->where('selected_time', $request->selected_time)
->whereIn('venue_short', $request->venues)
->exists();

if ($venueClashes) {
return redirect()->back()->with('fail', 'One or more selected venues are already booked for this time.');
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
        $testSlot->selected_time = $request->selected_time;
        $testSlot->exam_type = $request->exam_type;
        $testSlot->type = $request->type;
        $testSlot->venue_short = implode(',', $request->venues);
        $testSlot->file_path = $filePath;
        $testSlot->UTMID = Auth::id();
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


public function fetchAvailableSlots(Request $request)
{
    try {
        // Validate the request
        $validated = $request->validate([
            'course_code' => 'required|string',
            'exam_date' => 'required|date',
            'duration' => 'required|string'
        ]);

        // Parse the exam date to get day of week
        $examDate = Carbon::parse($validated['exam_date']);
        $dayOfWeek = $examDate->format('l');

        // Get all course codes that the students in this course are taking
        $studentCourses = DB::table('student_registrations')
            ->where('course_code', $validated['course_code'])
            ->pluck('UTMID')
            ->flatMap(function ($utmId) {
                return DB::table('student_registrations')
                    ->where('UTMID', $utmId)
                    ->pluck('course_code');
            })
            ->unique();

        \Log::info('Student courses:', ['courses' => $studentCourses]);

        // Get busy time slots from student_timetable for all related courses
        $busySlots = DB::table('student_timetable')
            ->whereIn('course_code', $studentCourses)
            ->where('day', $dayOfWeek)
            ->get(['start_time', 'end_time']);

        \Log::info('Busy slots:', ['slots' => $busySlots]);

        // Define all possible time slots
        $possibleSlots = [
            '09:00', '10:00', '11:00', '12:00', '14:00', 
            '15:00', '16:00', '17:00', '18:00', '20:00'
        ];

        // Parse duration into minutes
        list($hours, $minutes) = explode(':', $validated['duration']);
        $durationInMinutes = ($hours * 60) + intval($minutes);

        $availableSlots = [];
        
        foreach ($possibleSlots as $slot) {
            $proposedStart = Carbon::parse($slot);
            $proposedEnd = (clone $proposedStart)->addMinutes($durationInMinutes);
            $isAvailable = true;

            foreach ($busySlots as $busySlot) {
                $busyStart = Carbon::parse($busySlot->start_time);
                $busyEnd = Carbon::parse($busySlot->end_time);

                // Check for any overlap
                if ($proposedStart->lt($busyEnd) && $proposedEnd->gt($busyStart)) {
                    $isAvailable = false;
                    break;
                }
            }

            if ($isAvailable) {
                $availableSlots[] = $slot;
            }
        }

        // Always ensure 9 PM is available
        if (!in_array('20:00', $availableSlots)) {
            $availableSlots[] = '20:00';
        }

        // Sort the available slots
        sort($availableSlots);

        
        \Log::info('Available slots:', ['slots' => $availableSlots]);

        return response()->json($availableSlots);

    } catch (\Exception $e) {
        \Log::error('Error in fetchAvailableSlots:', [
            'message' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile()
        ]);
        
        return response()->json([
            'error' => 'Failed to fetch available slots: ' . $e->getMessage()
        ], 500);
    }
}

public function suggestVenues(Request $request)
{
    $requiredCapacity = $request->input('capacity');
    $type = $request->input('type');

    // Retrieve venues of the specified type, and shuffle them to randomize the order
    $venues = Venue::where('type', $type)->get()->shuffle();

    // Case 1: Find a single venue that meets or exceeds the required capacity
    $singleVenue = $venues->firstWhere('capacity', '>=', $requiredCapacity);

    if ($singleVenue) {
        return response()->json([
            'venues' => [$singleVenue], // Return only one venue
        ]);
    }

    // Case 2: No single venue can accommodate, suggest multiple venues
    $suggestedVenues = [];
    $remainingCapacity = $requiredCapacity;

    foreach ($venues as $venue) {
        if ($remainingCapacity > 0) {
            $suggestedVenues[] = $venue;
            $remainingCapacity -= $venue->capacity;
        } else {
            break;
        }
    }

    // Return suggested venues (multiple) for insufficient individual capacity
    return response()->json([
        'venues' => $suggestedVenues,
    ]);
}



}
