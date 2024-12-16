<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExamSlot;
use App\Models\StudentRegistration;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\ClashReport;

class StudExamListController extends Controller
{
    public function getStudentExamList()
    { 
        // Get the currently authenticated student
        $student = Auth::user();

        // Get the courses the student is registered for
        $registeredCourses = StudentRegistration::where('UTMID', $student->UTMID)
                                                ->pluck('course_code'); // Get all course_codes for the logged-in student

        // Fetch the exam slots that match the registered courses
        $examSlots = ExamSlot::whereIn('course_code', $registeredCourses)->get();

        // Find clashes based on the date, start time, and end time
        $clashes = [];
        foreach ($examSlots as $examSlot) {
            $clashes[$examSlot->exam_date][$examSlot->start_time][$examSlot->end_time][] = $examSlot;
        }

        // Flatten the clash array to only include actual clashes (i.e., multiple exams in the same time slot)
        $clashNotifications = [];
        foreach ($clashes as $date => $startTimes) {
            foreach ($startTimes as $startTime => $endTimes) {
                foreach ($endTimes as $endTime => $exams) {
                    if (count($exams) > 1) {
                        $clashNotifications[] = [
                            'date' => $date,
                            'start_time' => $startTime,
                            'end_time' => $endTime,
                            'exams' => $exams
                        ];
                    }
                }
            }
        }

        return view('student-exam-list', compact('examSlots', 'clashNotifications'));
    }

    public function getClashReport()
    {
        $student = Auth::user();

        // Get the courses the student is registered for
        $registeredCourses = StudentRegistration::where('UTMID', $student->UTMID)
                                                ->pluck('course_code'); // Get all course_codes for the logged-in student

        // Fetch the exam slots that match the registered courses
        $examSlots = ExamSlot::whereIn('course_code', $registeredCourses)->get();

        // Find clashes based on the date, start time, and end time
        $clashes = [];
        foreach ($examSlots as $examSlot) {
            $clashes[$examSlot->exam_date][$examSlot->start_time][$examSlot->end_time][] = $examSlot;
        }

        // Flatten the clash array to only include actual clashes (i.e., multiple exams in the same time slot)
        $clashNotifications = [];
        foreach ($clashes as $date => $startTimes) {
            foreach ($startTimes as $startTime => $endTimes) {
                foreach ($endTimes as $endTime => $exams) {
                    if (count($exams) > 1) {
                        // Store clash details in the database
                        foreach ($exams as $exam) {
                            ClashReport::create([
                                'UTMID' => $student->UTMID,
                                'date' => $date,
                                'start_time' => $startTime,
                                'end_time' => $endTime,
                                'course_code' => $exam->course_code,
                                'status' => 'pending', // You can update the status as needed
                            ]);
                        }

                        // Collect clash notification data
                        $clashNotifications[] = [
                            'date' => $date,
                            'start_time' => $startTime,
                            'end_time' => $endTime,
                            'exams' => $exams,
                            'status' => $exam->status
                        ];
                    }
                }
            }
        }
        // Pass the clash notifications to the view
        return view('clash-report', compact('clashNotifications'));
    }


    public function getCourseRegistrationSlip()
    {
        // Get the logged-in student's information
        $student = Auth::user();  // Fetch the logged-in user
    
        // Get the student's name
        $studentName = $student->name;  // Assuming 'name' is stored in 'users' table
        $UTMID = $student->UTMID; 
    
        // Get the courses the student is registered for
        $registeredCourses = StudentRegistration::where('UTMID', $student->UTMID)
                                                ->pluck('course_code'); // Get all course_codes for the logged-in student
    
        // Fetch course details (e.g., course title) from 'courses' table
        $courses = \DB::table('courses')
                      ->whereIn('course_code', $registeredCourses)
                      ->get();
    
        // Pass the data (student name and courses) to the view
        return view('course-registration-slip', compact('studentName','UTMID', 'courses'));
    }

    public function getStatusClashReport()
    {
        // Get the currently authenticated student
        $student = Auth::user();
    
        // Check if the student has submitted a report
        $hasSubmittedReport = ClashReport::where('UTMID', $student->UTMID)->exists();
    
        $clashNotifications = [];
        if ($hasSubmittedReport) {
            // If a report is submitted, fetch the clash notifications
            $registeredCourses = StudentRegistration::where('UTMID', $student->UTMID)
                                                    ->pluck('course_code');
    
            $examSlots = ExamSlot::whereIn('course_code', $registeredCourses)->get();
    
            $clashes = [];
            foreach ($examSlots as $examSlot) {
                $clashes[$examSlot->exam_date][$examSlot->start_time][$examSlot->end_time][] = $examSlot;
            }
    
            foreach ($clashes as $date => $startTimes) {
                foreach ($startTimes as $startTime => $endTimes) {
                    foreach ($endTimes as $endTime => $exams) {
                        if (count($exams) > 1) {
                            $clashNotifications[] = [
                                'date' => $date,
                                'start_time' => $startTime,
                                'end_time' => $endTime,
                                'exams' => $exams
                            ];
                        }
                    }
                }
            }
        }
    
        return view('status-clash-report', compact('clashNotifications', 'hasSubmittedReport'));
    }
     

    // Store clash report in the database
    public function store(Request $request)
    {
        // Handle the form submission
    // You can save the report data to a database or handle it as needed
    $data = $request->all();
    // Example: Save to database (adjust to your model)
    ClashReport::create([
        'name' => $data['name'],
        'utmid' => $data['utmid'],
        'clash_details' => $data['clash_details'] // or process the clash details accordingly
    ]);

    // Redirect or return a success message
    return redirect()->route('status.clash.report')->with('success', 'Clash report submitted successfully.');
    }
    
}