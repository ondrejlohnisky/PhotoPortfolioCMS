<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role_manager = new Role();
        $role_manager->name = 'Owner';
        $role_manager->description = 'Vlastník stránky. Může pozvat k registraci Adminy. Může smazat adminy';
        $role_manager->save();

        $role_employee = new Role();
        $role_employee->name = 'Admin';
        $role_employee->description = 'Uživatel s oprávněním administrátora. Nemůže pozvat k registraci Adminy. Nemůže smazat adminy.';
        $role_employee->save();
    }
}
