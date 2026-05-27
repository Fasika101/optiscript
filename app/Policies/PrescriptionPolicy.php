<?php

namespace App\Policies;

use App\Models\Prescription;
use App\Models\User;

class PrescriptionPolicy
{
    public function view(User $user, Prescription $prescription): bool
    {
        return $user->id === $prescription->user_id;
    }

    public function update(User $user, Prescription $prescription): bool
    {
        return $user->id === $prescription->user_id;
    }

    public function delete(User $user, Prescription $prescription): bool
    {
        return $user->id === $prescription->user_id;
    }
}
