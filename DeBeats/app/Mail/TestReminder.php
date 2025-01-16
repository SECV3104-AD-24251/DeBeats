<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TestReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $test;
    public $student;

    /**
     * Create a new message instance.
     */
    public function __construct($test, $student)
    {
        $this->test = $test;
        $this->student = $student;
    }

    public function build()
    {
        return $this->subject('Test Reminder: ' . $this->test->course_name)
                    ->view('emails.test_reminder');
                    
                    
    }

 


}
