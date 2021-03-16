<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['id' => 1, 'name' => 'Pizzas', 'slug' => 'pizzas', 'state' => '1', 'image' => 'pizzas.jpg'],
            ['id' => 2, 'name' => 'Pollo', 'slug' => 'pollo', 'state' => '1', 'image' => 'pollo.jpg'],
            ['id' => 3, 'name' => 'Hamburguesas', 'slug' => 'hamburguesas', 'state' => '1', 'image' => 'hamburguesas.jpg'],
            ['id' => 4, 'name' => 'Sushi', 'slug' => 'sushi', 'state' => '1', 'image' => 'sushi.jpg'],
            ['id' => 5, 'name' => 'Bebidas', 'slug' => 'bebidas', 'state' => '1', 'image' => 'bebidas.jpg'],
            ['id' => 6, 'name' => 'Alitas', 'slug' => 'alitas', 'state' => '1', 'image' => 'alitas.jpg'],
            ['id' => 7, 'name' => 'Postres', 'slug' => 'postres', 'state' => '1', 'image' => 'postres.jpg'],
            ['id' => 8, 'name' => 'Perros', 'slug' => 'perros', 'state' => '1', 'image' => 'perros.jpg']
    	];
    	DB::table('categories')->insert($categories);
    }
}
