<?php

use Illuminate\Database\Seeder;
use App\Image;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($j=0;$j<8;$j++){
            for ($i=1; $i < 5; $i++) { 
                $image = new Image;
                $image->title="fotka 1";
                $image->description="deskripcedeskripcedeskripcedeskripce !deskripce!";
                $image->src="https://www.boxmotions.com/blog/wp-content/uploads/2017/06/1458593290-timbercraft-tiny-home-2.jpg";
                $image->folder_id=$i;
                $image->save();
            }
        }
    }
}
