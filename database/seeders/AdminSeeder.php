<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@ethioeye.com'],
            [
                'name'     => 'Super Admin',
                'role'     => 'admin',
                'password' => Hash::make('Admin@1234'),
            ]
        );
    }
}
