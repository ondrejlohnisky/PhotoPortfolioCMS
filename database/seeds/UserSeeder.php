<?php

use Illuminate\Database\Seeder;
use App\User;

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
            'name' => 'Ondřej Lohniský',
            'email' => 'ondra.lohnisky@gmail.com',
            'password' => Hash::make('ondra123'),
            'api_token' => str_random(60),
        ]);
    }
}
