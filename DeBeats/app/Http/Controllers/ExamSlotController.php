<?php


namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\Course;
use App\Models\Venue;
use App\Models\ClashReport;
use App\Models\ExamSlot; // Import the ExamSlot model
use Illuminate\Http\Request;


class ExamSlotController extends Controller
{
    // Load all exam slots for the Exam List page
    public function loadAllExamSlots(){
        $examSlots = ExamSlot::all(); // Retrieve all exam slots from the database
        return view('exam_list', compact('examSlots')); // Return the view with exam slots data
    }


    // Show the form for creating a new exam slot
    public function loadAddExamSlotForm(){
        return view('add-exam-slot');
    }
   
    public function AddExamSlot(Request $request)
{
    $request->validate([
        'course_code' => 'required|string',
        'course_name' => 'required|string',
        'exam_date' => 'required|date',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i',
        'capacity' => 'required|integer',
        'venue_short' => 'required|string',
    ]);
 // Check if an exam slot already exists for the course
 $existingExamSlot = ExamSlot::where('course_code', $request->course_code)->first();
    
 if ($existingExamSlot) {        return redirect()->back()->with('fail', 'An exam slot for this course already exists.');
 }

    try {
        $sectionsJson = json_encode($request->section);
        // Create a new exam slot and save it
        $examSlot = new ExamSlot;
        $examSlot->course_code = $request->course_code;
        $examSlot->course_name = $request->course_name;
        $examSlot->exam_date = $request->exam_date;
        $examSlot->start_time = $request->start_time;
        $examSlot->end_time = $request->end_time;
        $examSlot->capacity = $request->capacity;
        $examSlot->venue_short = $request->venue_short;
        $examSlot->save();


        // Redirect back to the exam slots list with success message
        return redirect('/exam_list')->with('success', 'Exam Slot Added Successfully');
    } catch (\Exception $e) {
        return redirect('/add/exam')->with('fail', 'Failed to add exam slot: ' . $e->getMessage());
    }
}


 // Show the form for editing an existing exam slot
 public function loadEditForm($id)
{
    $exam_slot = ExamSlot::find($id);

    if (!$exam_slot) {
        return redirect('/exam_list')->with('fail', 'Exam slot not found.');
    }

    $exam_slot->start_time = Carbon::parse($exam_slot->start_time)->format('H:i');
    $exam_slot->end_time = Carbon::parse($exam_slot->end_time)->format('H:i');

    // Fetch the course to check its capacity
    $course = Course::where('course_code', $exam_slot->course_code)->first();

    // Fetch all suitable venues based on the course capacity
    $venuesQuery = Venue::where('capacity', '>=', $course->capacity);

    // Exclude venues that conflict with other exams, but include the current venue
    $venuesQuery->whereDoesntHave('examSlots', function ($query) use ($exam_slot) {
        $query->where('exam_date', $exam_slot->exam_date)
            ->where(function ($q) use ($exam_slot) {
                $q->whereBetween('start_time', [$exam_slot->start_time, $exam_slot->end_time])
                    ->orWhereBetween('end_time', [$exam_slot->start_time, $exam_slot->end_time])
                    ->orWhere(function ($q2) use ($exam_slot) {
                        $q2->where('start_time', '<=', $exam_slot->start_time)
                            ->where('end_time', '>=', $exam_slot->end_time);
                    });
            });
    });

    $venues = $venuesQuery->get();

    // Ensure the current venue is included in the list
    if ($venues->where('venue_short', $exam_slot->venue_short)->isEmpty()) {
        $currentVenue = Venue::where('venue_short', $exam_slot->venue_short)->first();
        if ($currentVenue) {
            $venues->push($currentVenue);
        }
    }

    return view('edit-exam-slot', compact('exam_slot', 'venues'));
}


    // Edit an existing exam slot
    public function EditExamSlot(Request $request){
       
        // Form validation and updating exam slot logic
        $request->validate([
            'course_code' => 'required|string',
            'course_name' => 'required|string',
            'exam_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'capacity' => 'required|integer',
            'venue_short' => 'required|string',
        ]);
       
       
        try {
              // Check for conflicting schedules
              $conflictingSlot = ExamSlot::where('exam_date', $request->exam_date)
              ->where('venue_short', $request->venue_short)
              ->where(function ($q) use ($request) {
                  $q->whereBetween('start_time', [$request->start_time, $request->end_time])
                    ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                    ->orWhere(function ($q2) use ($request) {
                        $q2->where('start_time', '<=', $request->start_time)
                           ->where('end_time', '>=', $request->end_time);
                    });
              })
              ->where('id', '!=', $request->exam_slot_id) // Exclude the current exam slot
              ->first();
  
          if ($conflictingSlot) {
              return redirect()->back()->with('fail', 'Venue is already booked for another course at the same time.');
          }
            $update_exam_slot = ExamSlot::where('id', $request->exam_slot_id)->update([
                'course_code' => $request->course_code, //
                'course_name' => $request->course_name, //
                'exam_date' => $request->exam_date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'capacity' => $request->capacity,
                'venue_short' => $request->venue_short,
            ]);
        if ($update_exam_slot ){
            return redirect('/exam_list')->with('success', 'Exam Slot Updated Successfully');
        }
        } catch (\Exception $e) {
            return redirect('/edit/exam')->with('fail', $e->getMessage());
        }
    }


     




    // Delete an exam slot
    public function deleteExamSlot($id){
        try {
            ExamSlot::where('id', $id)->delete();
            return redirect('/exam_list')->with('success', 'Exam Slot Deleted Successfully!');
        } catch (\Exception $e) {
            return redirect('/exam_list')->with('fail', $e->getMessage());
        }
    }


   // In ExamSlotController.php
   public function getCourseName(Request $request)
{
    $courseCode = $request->input('course_code');
    $examDate = $request->input('exam_date', null); // Default to null
    $startTime = $request->input('start_time', null);
    $endTime = $request->input('end_time', null);


    // Fetch the course
    $course = Course::where('course_code', $courseCode)->first();


    if ($course) {
        // Query for available venues
        $venueQuery = Venue::where('capacity', '>=', $course->capacity);


        if ($examDate && $startTime && $endTime) {
            $venueQuery->whereDoesntHave('examSlots', function ($query) use ($examDate, $startTime, $endTime) {
                $query->where('exam_date', $examDate)
                      ->where(function ($q) use ($startTime, $endTime) {
                          $q->whereBetween('start_time', [$startTime, $endTime])
                            ->orWhereBetween('end_time', [$startTime, $endTime])
                            ->orWhere(function ($q2) use ($startTime, $endTime) {
                                $q2->where('start_time', '<=', $startTime)
                                   ->where('end_time', '>=', $endTime);
                            });
                      });
            });
        }


        $availableVenues = $venueQuery->get();


        return response()->json([
            'success' => true,
            'course_name' => $course->course_name,
            'capacity' => $course->capacity,
            'venues' => $availableVenues,
        ]);
    } else {
        return response()->json([
            'success' => false,
        ]);
    }
}




public function getExamSlotsForDate($month, $year)
{
    $examSlots = ExamSlot::whereMonth('exam_date', $month)
        ->whereYear('exam_date', $year)
        ->get();


    return response()->json($examSlots);
}




public function getConflictManagement()
{
    // Fetch all clash reports from the database
    $clashReports = ClashReport::all(); // Get all the clash reports

    // Pass the clash reports to the view
    return view('conflict-management', compact('clashReports'));
}


public function validateCourseCode(Request $request)
{
    $courseCode = $request->input('course_code');

    // Validate the course code
    $course = Course::where('code', $courseCode)->first();

    if ($course) {
        return response()->json([
            'success' => true,
            'course_name' => $course->name,
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Invalid course code. Please try again.',
        ]);
    }
}




   
}
