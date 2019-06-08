<?php

use Illuminate\Database\Seeder;
use App\Property;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $property = new Property;
        $property->name='globalFoldersPassword';
        $property->value='';
        $property->save();
    }
}
