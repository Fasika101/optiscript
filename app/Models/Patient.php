<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'date_of_birth',
        'gender',
        'phone',
        'email',
        'address',
        'medical_notes',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'user_id' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }

    public function getAgeAttribute(): ?int
    {
        return $this->date_of_birth ? $this->date_of_birth->age : null;
    }

    public function latestPrescription()
    {
        return $this->hasOne(Prescription::class)->latestOfMany('prescription_date');
    }
}
