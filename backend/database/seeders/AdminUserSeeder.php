<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Rokan Chowdhury Onick',
            'email' => 'hello@rokanbd.cf',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
    }
}
