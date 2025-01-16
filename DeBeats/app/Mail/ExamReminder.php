<?php

namespace App\Mail;

use App\Models\ExamSlot;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ExamReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $exam;
    public $student;

    /**
     * Create a new message instance.
     */
    public function __construct($exam, $student)
    {
        $this->exam = $exam;
        $this->student = $student;
    }


    public function build()
    {
        return $this->subject('Exam Reminder: ' . $this->exam->course_name)
                    ->view('emails.exam_reminder')
                    ->with([
                        'exam' => $this->exam,
                        'student' => $this->student,
                    ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
