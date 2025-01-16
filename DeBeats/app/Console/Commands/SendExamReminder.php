<?php

namespace App\Console\Commands;

use App\Models\ExamSlot;
use App\Models\StudentRegistration;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendExamReminder extends Command
{
    protected $signature = 'send:exam-reminder {date?}'; // Optional date argument
    protected $description = 'Send reminder emails for exams scheduled on a specific date';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get the date argument or default to tomorrow
        $testDate = $this->argument('date') 
            ? Carbon::parse($this->argument('date'))->format('Y-m-d') 
            : Carbon::tomorrow()->format('Y-m-d');
            
        $this->info('Fetching exams scheduled for: ' . $testDate);

        // Fetch exams scheduled for the specified date
        $examSlots = ExamSlot::whereDate('exam_date', $testDate)->get();

        if ($examSlots->isEmpty()) {
            $this->info('No exams found for the specified date.');
            return;
        }

        foreach ($examSlots as $exam) {
            // Replace 'course_name' with the actual column name in your ExamSlot model
            $examName = $exam->course_name ?? 'Unnamed Exam'; 
            $examTime = $exam->start_time ?? 'No time provided';

            $this->info('Exam found: ' . $examName . ' at ' . $examTime);

            // Get students registered for the subject
            $students = StudentRegistration::where('course_code', $exam->course_code)
                ->join('users', 'student_registrations.UTMID', '=', 'users.UTMID') // Join with the User table
                ->select('users.email', 'users.name') // Select the email column from the User table
                ->get();

            if ($students->isEmpty()) {
                $this->info('No students found for subject: ' . $exam->course_code);
                continue;
            }

            foreach ($students as $student) {
                // Send email to each student
                Mail::to('natashaqila00@gmail.com')->send(new \App\Mail\ExamReminder($exam, $student));

                // Add a delay to respect Mailtrap's rate limit
                usleep(1000000); // 500ms = 0.5 seconds
            }
        }

        $this->info('Exam reminders sent successfully.');
    }
}
