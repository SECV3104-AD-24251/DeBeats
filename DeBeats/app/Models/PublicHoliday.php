<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Example model for public holidays
class PublicHoliday extends Model
{
    protected $table = 'public_holidays'; // Assuming a table for public holidays

    protected $fillable = ['date', 'name'];
}
