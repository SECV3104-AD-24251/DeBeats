<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestVenues extends Model
{
    use HasFactory;

    // Specify the table name if it's not the default "venues"
    protected $table = 'test_venues';

    // Specify fillable fields if you're using mass assignment
    protected $fillable = ['unit_number', 'venue_name', 'venue_short', 'type', 'capacity', 'available_pc', 'PICname', 'PICphone_number'];

   
}

