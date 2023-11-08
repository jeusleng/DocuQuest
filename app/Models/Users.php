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
    ];

    protected $primaryKey = 'user_id';

    use HasFactory;
}
