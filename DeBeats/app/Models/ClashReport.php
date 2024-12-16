<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClashReport extends Model
{
    use HasFactory;

    // Define the table name if it's not following the convention
    protected $table = 'clash_reports'; 

    // Allow mass assignment for the fields
    // ClashReport.php model

    protected $fillable = [
        'UTMID', 'date', 'start_time', 'end_time', 'course_code', 'course_name', 'status'
    ];
    public function student()
{
    return $this->belongsTo(User::class, 'UTMID', 'UTMID'); // Assuming 'utmid' is the foreign key
}
public function course()
{
    return $this->belongsTo(Course::class, 'course_code', 'course_code');
}


}



