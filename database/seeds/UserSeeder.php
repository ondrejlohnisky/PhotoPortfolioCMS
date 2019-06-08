<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_owner = Role::where('name','Owner')->first();
        $role_admin  = Role::where('name','Admin')->first();

        $user = new User();
        $user->name = 'Ondřej Lohniský';
        $user->email = 'ondra.lohnisky@gmail.com';
        $user->password = Hash::make('ondra123');
        $user->api_token = str_random(60);
        $user->save();
        $user->roles()->attach($role_owner);

        $user = new User();
        $user->name = 'Petr Smille';
        $user->email = 'petr.smille@gmail.com';
        $user->password = Hash::make('petr123');
        $user->api_token = str_random(60);
        $user->save();
        $user->roles()->attach($role_admin);

        $user = new User();
        $user->name = 'Nekdo';
        $user->email = 'nekdo.nekdo@gmail.com';
        $user->password = Hash::make('nekdo123');
        $user->api_token = str_random(60);
        $user->save();
        $user->roles()->attach($role_admin);

    }
}
