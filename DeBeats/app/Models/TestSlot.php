<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class TestSlot extends Model
{
    use HasFactory;

    // Define the table associated with the model (optional if it's the plural of the model name)
    protected $table = 'test_list';

    // Define the fillable attributes (to prevent mass-assignment exceptions)
    protected $fillable = ['course_code, course_name', 'capacity', 'exam_date', 'duration', 'type', 'venue_short'];

    
}
