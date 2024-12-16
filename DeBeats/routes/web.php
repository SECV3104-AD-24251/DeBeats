<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExamSlotController;
use App\Http\Controllers\StaffDashboardController;
use App\Http\Controllers\LecturerDashboardController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\StudExamListController;

Route::get('/', function () {
    return view('welcome');
});

// Login route
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Staff dashboard route
Route::get('/dashboard/staffDash', [StaffDashboardController::class, 'index'])->name('dashboard.staff');

// Other dashboard routes (if needed for student or lecturer)
Route::get('/dashboard/studentDash', [StudentDashboardController::class, 'index'])->name('dashboard.student');
Route::get('/dashboard/lecturerDash', [LecturerDashboardController::class, 'index'])->name('dashboard.lecturer');

// Exam slot routes
// Show all exam slots
Route::get('/exam_list', [ExamSlotController::class, 'loadAllExamSlots']);
Route::get('/add/exam', [ExamSlotController::class, 'loadAddExamSlotForm']);

Route::post('/add/exam', [ExamSlotController::class, 'AddExamSlot'])->name('AddExamSlot');

// Edit an exam slot
Route::get('/edit/{id}', [ExamSlotController::class, 'loadEditForm']);
// Delete an exam slot
Route::get('/delete/{id}', [ExamSlotController::class, 'deleteExamSlot']);

Route::post('/edit/exam', [ExamSlotController::class, 'EditExamSlot'])->name('EditExamSlot');

Route::get('/dashboard/staff/information', function () {
    return view('information.index');
})->name('dashboard.staff.information');

Route::get('/dashboard/staff/venues', [StaffDashboardController::class, 'showVenues'])->name('dashboard.staff.venues');
Route::get('/dashboard/staff/courses', [StaffDashboardController::class, 'showCourses'])->name('dashboard.staff.courses');
Route::get('/dashboard/staff/student-registrations', [StaffDashboardController::class, 'showStudentRegistrations'])->name('dashboard.staff.student-registrations');
Route::get('staff/student-registrations', [StaffDashboardController::class, 'showStudentRegistrations'])->name('staff.student-registrations');
Route::get('staff/student-registrations/search', [StaffDashboardController::class, 'searchStudentRegistrations'])->name('staff.student-registrations.search');

Route::get('/add-exam-slot', function () {return view('add-exam-slot');})->name('add.exam.slot');

Route::get('/calendar', function(){
    return view('calendar');
});

//Route to redirect to exam slot form by clicking on calendar date block
Route::get('/add-exam-slot/{date}', [ExamSlotController::class, 'loadAddExamSlotFormWithDate'])->name('add.exam.slot.date');

// Route to fetch exam slots for a specific month
Route::get('/exam-slots/{month}/{year}', [ExamSlotController::class, 'getExamSlotsForDate']);

Route::get('/validate-course-code', [ExamSlotController::class, 'validateCourseCode']);

// Add this route in web.php
Route::get('/get-course-name', [ExamSlotController::class, 'getCourseName']);
Route::post('/get-course-name', [ExamSlotController::class, 'getCourseName']);


// Student Exam Listroute
Route::get('/student-exam-list', [StudExamListController::class, 'getStudentExamList'])->name('getStudentExamList');

// Student clash report
Route::get('/clash-report', [StudExamListController::class, 'getClashReport'])->name('getClashReport');
Route::post('/clash-report', [StudExamListController::class, 'store'])->name('status.clash.report');

// Student Status Clash Report
Route::get('/status-clash-report', [StudExamListController::class, 'getStatusClashReport'])->name('getStatusClashReport');
 
Route::post('/submit-clash-report', [StudExamListController::class, 'store'])->name('status.clash.report');

// Student Course Registration Slip
Route::get('/course-registration-slip', [StudExamListController::class, 'getCourseRegistrationSlip'])->name('getCourseRegistrationSlip');

// Staff Conflict Management
Route::get('/conflict-management', [ExamSlotController::class, 'getConflictManagement'])->name('getConflictManagement');


Route::match(['get', 'post'], '/status-clash-report', [StudExamListController::class, 'getStatusClashReport'])->name('status.clash.report');


Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');