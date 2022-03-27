<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::create(['name' => 'Umer Zahid', 'email' => 'umer.zahid1993@gmail.com', 'password' => Hash::make('Qwerty!23456')]);
        $user->assignRole('Super Admin');
    }
}
