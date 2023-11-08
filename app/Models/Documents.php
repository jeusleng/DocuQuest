<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Model;

class Documents extends Model
{
    protected $table = 'documents';
   
    protected $fillable = [
        'document_type',
        'requirements',
    ];

    protected $primaryKey = 'document_id';

    use HasFactory;
}
