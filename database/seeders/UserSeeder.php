<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $User = User::updateOrCreate([
            'email' => 'soporte@ninacode.mx',
        ],
        [
            'name' => 'Soporte Nina Code',
            'email' => 'soporte@ninacode.mx',
            'password' => Hash::make('123Pormi*'),
            'email_verified_at' => now(),
        ]);

        $User->createToken('api-token', ['portfolios:*', 'services:*', 'teams:*', 'users:*']);
    }
}
