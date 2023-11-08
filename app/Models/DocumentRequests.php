<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class DocumentRequests extends Model
{
    protected $table = 'document_requests';
   
    protected $fillable = [
        'user_id',
        'document_id',
        'request_status',
        'number_of_copies',
        'purpose',
        'appointment_date_time',
        'acknowledgment_receipt',
        'id_picture',
    ];

    protected $primaryKey = 'document_request_id';

    public function users()
    {
        return $this->belongsTo(Users::class, 'user_id', 'user_id');
    }

    public function documents()
    {
        return $this->belongsTo(Documents::class, 'document_id', 'document_id');
    }

    use HasFactory;
}
