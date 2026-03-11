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
            ['email' => 'admin@koimajesty.com'],
            [
                'name'     => 'Admin',
                'password' => Hash::make('Admin@1234'),
                'is_admin' => true,
            ]
        );

        $this->command->info('✅  Admin user created: admin@koimajesty.com / Admin@1234');
    }
}
