<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Objection extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'nik',
        'phone_number',
        'passport_number',
        'address',
        'status',
        'document_path',
        'description',
        'verification_status',
        'admin_notes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
