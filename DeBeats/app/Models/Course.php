<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    // Specify the table name if it's not the default "venues"
    protected $table = 'courses';

    // Specify fillable fields if you're using mass assignment
    protected $fillable = ['course_name', 'course_code', 'capacity'];
// Define the reverse relationship to StudentRegistration
public function studentRegistrations()
{
    return $this->hasMany(StudentRegistration::class, 'course_code', 'course_code');
}

public function clashReports()
{
    return $this->hasMany(ClashReport::class, 'course_code', 'course_code');
}




}

