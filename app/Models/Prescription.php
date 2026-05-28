<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'patient_id',
        'prescription_date',
        'od_sphere', 'od_cylinder', 'od_axis', 'od_add', 'od_va', 'od_prism', 'od_base',
        'os_sphere', 'os_cylinder', 'os_axis', 'os_add', 'os_va', 'os_prism', 'os_base',
        'pd_far', 'pd_near', 'pd_right', 'pd_left',
        'diagnosis', 'lens_type', 'recommendation', 'notes', 'next_visit',
    ];

    protected $casts = [
        'prescription_date' => 'date',
        'next_visit' => 'date',
        'user_id' => 'integer',
        'patient_id' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function getLensTypeLabelAttribute(): string
    {
        return match($this->lens_type) {
            'single_vision'   => 'Single Vision',
            'bifocal'         => 'Bifocal',
            'progressive'     => 'Progressive',
            'contact_lens'    => 'Contact Lens',
            'reading_glasses' => 'Reading Glasses',
            default           => 'N/A',
        };
    }

    public function formatValue($value, bool $showSign = true): string
    {
        if ($value === null || $value === '') return '—';
        $num = (float) $value;
        if ($showSign && $num > 0) return '+' . number_format($num, 2);
        return number_format($num, 2);
    }
}
