<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Model;

class Users extends Model
{
    protected $table = 'users';
   
    protected $fillable = [
        'email',
        'password',
        'type',
        'first_name',
        'middle_name',
        'last_name',
        'date_of_birth',
        'gender',
        'contact_number',
        'complete_address',
        'grade_level',
        'student_type',
        'act_status',
        'section',
        'learner_reference_number',
        'graduation_year',
        'last_grade_attended',
        'adviser_name',
        'adviser_section',
        'guardian_full_name',
        'guardian_contact_number',
        'profile_picture',
    ];

    protected $primaryKey = 'user_id';

    use HasFactory;
}
