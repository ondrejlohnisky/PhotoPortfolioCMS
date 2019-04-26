<?php

use Illuminate\Database\Seeder;
use App\social_link;

class SocialLinksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $link=new social_link;
        $link->name="facebook";
        $link->link="/";
        $link->save();

        $link=new social_link;
        $link->name="instagram";
        $link->link="/";
        $link->save();

        $link=new social_link;
        $link->name="youtube";
        $link->link="/";
        $link->save();
    }
}
