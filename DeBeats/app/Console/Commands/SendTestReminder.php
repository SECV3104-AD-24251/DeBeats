<?php

namespace App\Console\Commands;

use App\Models\TestSlot; 
use App\Models\StudentRegistration;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendTestReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:test-reminder {date?}'; // Optional date argument

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder emails for tests scheduled on a specific date or tomorrow by default';

    /**
     * Create a new command instance.
     */
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

        $this->info('Fetching tests scheduled for: ' . $testDate);

        // Fetch tests scheduled for the specified date
        $testSlots = TestSlot::whereDate('exam_date', $testDate)->get();

        if ($testSlots->isEmpty()) {
            $this->info('No tests found for the specified date.');
            return;
        }

        foreach ($testSlots as $test) {
            $testName = $test->course_name ?? 'Unnamed Test';
            $testTime = $test->selected_time ?? 'No time provided';

            $this->info('Test found: ' . $testName . ' at ' . $testTime);

            // Get students registered for the subject
            $students = StudentRegistration::where('course_code', $test->course_code)
                ->join('users', 'student_registrations.UTMID', '=', 'users.UTMID') // Join with the User table
                ->select('users.email', 'users.name') // Select the email and name columns from the User table
                ->get();

            if ($students->isEmpty()) {
                $this->info('No students found for subject: ' . $test->course_code);
                continue;
            }

            foreach ($students as $student) {
                // Send email to each student
                Mail::to('natashaqila00@gmail.com')->send(new \App\Mail\TestReminder($test, $student));

                // Add a delay to avoid hitting rate limits
                usleep(500000); // 0.5 seconds
            }
        }

        $this->info('Test reminders sent successfully.');
    }
}
