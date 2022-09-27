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
            'username' => 'RA' . rand(),
            'cpf' =>  '001.666.952-54',
            'email' => 'alexjferman@gmail.com',
            'password' => Hash::make('Asd@33312'),
            'is_admin' => true,
        ]);
    }
}
