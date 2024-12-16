<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ExamSlot extends Model
{
    use HasFactory;

    // Define the table associated with the model (optional if it's the plural of the model name)
    protected $table = 'exam_list';

    // Define the fillable attributes (to prevent mass-assignment exceptions)
    protected $fillable = ['course_code, course_name', 'exam_date', 'start_time', 'end_time', 'capacity', 'venue_short'];

    public function studentRegistrations()
    {
        return $this->hasMany(StudentRegistration::class, 'course_code', 'course_code');
    }
    public function course()
{
    return $this->belongsTo(Course::class, 'course_code', 'course_code'); 
}

    
}
