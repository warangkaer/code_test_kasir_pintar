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
        User::create([
            'name' => 'Doni',
            'email' => 'doni@gmail.com',
            'nip' => '1234',
            'degree' => 'director',
            'password' => Hash::make('123456')
        ]);

        User::create([
            'name' => 'Dono',
            'email' => 'dono@gmail.com',
            'nip' => '1235',
            'degree' => 'director',
            'password' => Hash::make('123456')
        ]);

        User::create([
            'name' => 'Dona',
            'email' => 'dona@gmail.com',
            'nip' => '1236',
            'degree' => 'director',
            'password' => Hash::make('123456')
        ]);
    }
}
