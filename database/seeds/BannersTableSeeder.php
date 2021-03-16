<?php

use Illuminate\Database\Seeder;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banner = [
    		['id' => 1, 'image' => 'banner.jpg', 'slug' => 'banner', 'type' => '1', 'state' => '1']
    	];
    	DB::table('banners')->insert($banner);
    }
}
