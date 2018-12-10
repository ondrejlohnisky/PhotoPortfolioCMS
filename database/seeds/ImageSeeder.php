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
        for ($i=0; $i < 6; $i++) { 
            $image = new Image;
            $image->title="fotka 1";
            $image->description="deskripcedeskripcedeskripcedeskripce !deskripce!";
            $image->src="https://www.boxmotions.com/blog/wp-content/uploads/2017/06/1458593290-timbercraft-tiny-home-2.jpg";
            $image->folder_id=1;
            $image->save();

            $image = new Image;
            $image->title="fotka 2";
            $image->description="deskripcedeskripcedeskripcedeskripce !deskripce!";
            $image->src="https://www.boxmotions.com/blog/wp-content/uploads/2017/06/1458593290-timbercraft-tiny-home-2.jpg";
            $image->folder_id=1;
            $image->save();

            $image = new Image;
            $image->title="fotka 3";
            $image->description="deskripcedeskripcedeskripcedeskripce !deskripce!";
            $image->src="https://www.boxmotions.com/blog/wp-content/uploads/2017/06/1458593290-timbercraft-tiny-home-2.jpg";
            $image->folder_id=1;
            $image->save();

            $image = new Image;
            $image->title="fotka 4";
            $image->description="deskripcedeskripcedeskripcedeskripce !deskripce!";
            $image->src="https://www.boxmotions.com/blog/wp-content/uploads/2017/06/1458593290-timbercraft-tiny-home-2.jpg";
            $image->folder_id=2;
            $image->save();

            $image = new Image;
            $image->title="fotka 5";
            $image->description="deskripcedeskripcedeskripcedeskripce !deskripce!";
            $image->src="https://www.boxmotions.com/blog/wp-content/uploads/2017/06/1458593290-timbercraft-tiny-home-2.jpg";
            $image->folder_id=2;
            $image->save();
        }
    }
}
