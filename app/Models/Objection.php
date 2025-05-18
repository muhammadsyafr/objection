<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

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
        'admin_notes',
        'uuid'
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($objection) {
            $objection->uuid = (string) Str::uuid();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
