<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class StudentRegistration extends Model
{
    use HasFactory;

    protected $fillable = ['UTMID', 'course_code'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_code', 'course_code');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'UTMID', 'UTMID');
    }
}
