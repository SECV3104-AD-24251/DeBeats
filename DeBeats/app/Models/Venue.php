<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    // Specify the table name if it's not the default "venues"
    protected $table = 'venues';

    // Specify fillable fields if you're using mass assignment
    protected $fillable = ['unit_number', 'venue_name', 'venue_short', 'type', 'capacity'];

    public function examSlots()
    {
        return $this->hasMany(ExamSlot::class, 'venue_short', 'venue_short');
    }
}

