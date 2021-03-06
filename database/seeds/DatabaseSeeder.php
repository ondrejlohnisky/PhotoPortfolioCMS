<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(FolderSeeder::class);
        $this->call(ImageSeeder::class);
        $this->call(SocialLinksSeeder::class);
        $this->call(PropertySeeder::class);
        

    }
}
