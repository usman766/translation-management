<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminEmail = 'user@user.com';
        $adminExists = DB::table('users')->where('email', $adminEmail)->exists();

        if (!$adminExists) {
            DB::table('users')->insert([
                'name' => 'User',
                'email' => $adminEmail,
                'password' => Hash::make('user'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
