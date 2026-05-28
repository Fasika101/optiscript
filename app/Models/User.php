<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'role',
        'email',
        'email_verified_at',
        'password',
        'clinic_name',
        'license_number',
        'phone',
        'address',
        'specialty',
        'logo_path',
        'signature_path',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }
}
