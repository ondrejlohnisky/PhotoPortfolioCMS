<?php

use Illuminate\Database\Seeder;
use App\Folder;

class FolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $image = new Folder;
        $image->title="Složka 1";
        $image->description="folderdeskripcefolderdeskripcefolderdeskripcefolderdeskripcefolderdeskripcefolderdeskripce";
        $image->public_image="https://www.boxmotions.com/blog/wp-content/uploads/2017/06/1458593290-timbercraft-tiny-home-2.jpg";
        $image->save();

        $image = new Folder;
        $image->title="Složka 2";
        $image->description="folderdeskripcefolderdeskripcefolderdeskripcefolderdeskripcefolderdeskripcefolderdeskripce";
        $image->public_image="https://www.boxmotions.com/blog/wp-content/uploads/2017/06/1458593290-timbercraft-tiny-home-2.jpg";
        $image->password=str_random(8);
        $image->save();
    }
}
