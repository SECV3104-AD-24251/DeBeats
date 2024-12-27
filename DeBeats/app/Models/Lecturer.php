<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    use HasFactory;

    // Specify the table name if it's not the default "venues"
    protected $table = 'lecturer';

    // Specify fillable fields if you're using mass assignment
    protected $fillable = ['name','UTMID', 'course_code'];

    

   
}

