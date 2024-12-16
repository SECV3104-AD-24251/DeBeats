<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Table associated with the model
    protected $table = 'users';

    // Mass assignable attributes
    protected $fillable = [
        'name',
        'UTMID',
        'email',
        'password',
        'role',
    ];

    // Attributes that should be hidden for arrays (like password)
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Cast attributes to native types
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     // Add this if you want to define the reverse relationship
     public function studentRegistrations()
     {
         return $this->hasMany(StudentRegistration::class, 'UTMID', 'UTMID');
     }

     public function clashReports()
     {
         return $this->hasMany(ClashReport::class, 'UTMID', 'UTMID');
     }
     

 

}
