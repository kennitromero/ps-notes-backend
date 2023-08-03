<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Kennit Ruz',
            'email' => 'kennitromero@gmail.com',
            'password' => 'kilo1212',
        ]);
    }
}
