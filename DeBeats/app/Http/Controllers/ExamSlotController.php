<?php


namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Course;
use App\Models\Venue;
use App\Models\ClashReport;
use App\Models\ExamSlot;
use Illuminate\Http\Request;




class ExamSlotController extends Controller
{
 
    // Load all exam slots for the Exam List page
    public function loadAllExamSlots()
    {
        $examSlots = ExamSlot::all();
        $clashNotifications = [];
        $trackedClashes = [];
    
        foreach ($examSlots as $examSlot) {
            $students = \App\Models\StudentRegistration::where('course_code', $examSlot->course_code)->get();
            $isClashing = false;
            $clashingCourseCode = null;
            $clashingCourseName = null;
    
            foreach ($students as $student) {
                $clash = ExamSlot::where('exam_date', $examSlot->exam_date)
                    ->where(function ($query) use ($examSlot) {
                        $query->whereBetween('start_time', [$examSlot->start_time, $examSlot->end_time])
                            ->orWhereBetween('end_time', [$examSlot->start_time, $examSlot->end_time])
                            ->orWhere(function ($q2) use ($examSlot) {
                                $q2->where('start_time', '<=', $examSlot->start_time)
                                    ->where('end_time', '>=', $examSlot->end_time);
                            });
                    })
                    ->whereHas('studentRegistrations', function ($query) use ($student) {
                        $query->where('UTMID', $student->UTMID);
                    })
                    ->where('id', '!=', $examSlot->id)
                    ->first();
    
                    if ($clash) {
                        $uniqueClashKey = $examSlot->course_code . '-' . $clash->course_code;
        
                        if (!in_array($uniqueClashKey, $trackedClashes)) {
                            $trackedClashes[] = $uniqueClashKey; // Mark as processed
                            $clashNotifications[] = [
                                'currentCourseCode' => $examSlot->course_code,
                                'currentCourseName' => $examSlot->course_name,
                                'clashingCourseCode' => $clash->course_code,
                                'clashingCourseName' => $clash->course_name,
                            ];
                        }
        
                        $isClashing = true;
                    }
                }
        
                $examSlot->is_clashing = $isClashing;
            }
    
        return view('exam_list', compact('examSlots', 'clashNotifications'));
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


        $request->merge([
            'start_time' => Carbon::createFromFormat('H:i', $request->start_time)->format('H:i'),
            'end_time' => Carbon::createFromFormat('H:i', $request->end_time)->format('H:i'),
        ]);
   
        // Check if an exam slot already exists for the course
        $existingExamSlot = ExamSlot::where('course_code', $request->course_code)->first();
   
        if ($existingExamSlot) {
            return redirect()->back()->with('fail', 'An exam slot for this course already exists.');
        }
   
        try {
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
   
            return redirect('/exam_list')->with('success', 'Exam Slot Added Successfully');
        } catch (\Exception $e) {
            return redirect('/add/exam')->with('fail', 'Failed to add exam slot: ' . $e->getMessage());
        }
    }
   
   

    public function EditExamSlot(Request $request)
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


  //      $request->merge([
    //        'start_time' => Carbon::createFromFormat('H:i', $request->start_time)->format('H:i'),
      //      'end_time' => Carbon::createFromFormat('H:i', $request->end_time)->format('H:i'),
        //]);
   
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
            // Update the exam slot
            $update_exam_slot = ExamSlot::where('id', $request->exam_slot_id)->update([
                'course_code' => $request->course_code,
                'course_name' => $request->course_name,
                'exam_date' => $request->exam_date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'capacity' => $request->capacity,
                'venue_short' => $request->venue_short,
            ]);
   
            if ($update_exam_slot) {
                return redirect('/exam_list')->with('success', 'Exam Slot Updated Successfully');
            }
        } catch (\Exception $e) {
            return redirect('/edit/exam')->with('fail', $e->getMessage());
        }
    }
   
 
    public function loadEditForm($id)
{
    // Fetch the exam slot by ID
    $examSlot = ExamSlot::find($id);


    // Check if the exam slot exists
    if (!$examSlot) {
        return redirect('/exam_list')->with('fail', 'Exam slot not found.');
    }
    $examSlot->start_time = Carbon::parse($examSlot->start_time)->format('H:i');
    $examSlot->end_time = Carbon::parse($examSlot->end_time)->format('H:i');

    // Fetch all venues
   // $venues = Venue::all();
   $course = Course::where('course_code', $examSlot->course_code)->first();

    // Fetch all suitable venues based on the course capacity
    $venuesQuery = Venue::where('capacity', '>=', $course->capacity);

    // Exclude venues that conflict with other exams, but include the current venue
    $venuesQuery->whereDoesntHave('examSlots', function ($query) use ($examSlot) {
        $query->where('exam_date', $examSlot->exam_date)
            ->where(function ($q) use ($examSlot) {
                $q->whereBetween('start_time', [$examSlot->start_time, $examSlot->end_time])
                    ->orWhereBetween('end_time', [$examSlot->start_time, $examSlot->end_time])
                    ->orWhere(function ($q2) use ($examSlot) {
                        $q2->where('start_time', '<=', $examSlot->start_time)
                            ->where('end_time', '>=', $examSlot->end_time);
                    });
            });
    });

    $venues = $venuesQuery->get();

    // Ensure the current venue is included in the list
    if ($venues->where('venue_short', $examSlot->venue_short)->isEmpty()) {
        $currentVenue = Venue::where('venue_short', $examSlot->venue_short)->first();
        if ($currentVenue) {
            $venues->push($currentVenue);
        }
    }


    // Pass the data to the edit form view
    return view('edit-exam-slot',  [
        'exam_slot' => $examSlot,
        'venues' => $venues, // Pass venues to the view
    ]);
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
