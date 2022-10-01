<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::create([
            'institution_id' => 1,
            'name' => 'Alex Ferman',
            'username' => "ET5694",
            'email' => 'alexjferman@gmail.com',
            'password' => Hash::make('Asd@#3312'),
            'type' => 'main',
            'status' => 'active',
            'is_admin' => true,
        ]);
    }
}
