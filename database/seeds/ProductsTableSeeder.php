<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $description="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.";

        $products = [
        	['id' => 1, 'name' => 'Pizza con Peperoni', 'slug' => 'pizza-con-peperoni', 'description' => $description, 'price' => 4000, 'qty' => 25, 'discount' => 0, 'min' => 12, 'max' => 20, 'state' => '1', 'category_id' => 1],
            ['id' => 2, 'name' => 'Hamburguesa Doble', 'slug' => 'hamburguesa-doble', 'description' => $description, 'price' => 7600, 'qty' => 10, 'discount' => 0, 'min' => 0, 'max' => 0, 'state' => '1', 'category_id' => 3],
            ['id' => 3, 'name' => 'Pizza Hahuaiana', 'slug' => 'pizza-hahuaiana', 'description' => $description, 'price' => 2600, 'qty' => 20, 'discount' => 0, 'min' => 0, 'max' => 0, 'state' => '1', 'category_id' => 1],
            ['id' => 4, 'name' => 'Pizza Vegetariana', 'slug' => 'pizza-vegetariana', 'description' => $description, 'price' => 1900, 'qty' => 20, 'discount' => 0, 'min' => 0, 'max' => 0, 'state' => '1', 'category_id' => 1],
            ['id' => 5, 'name' => 'Pastel de Chocolate', 'slug' => 'pastel-de-chocolate', 'description' => $description, 'price' => 700, 'qty' => 30, 'discount' => 0, 'min' => 0, 'max' => 0, 'state' => '1', 'category_id' => 7],
            ['id' => 6, 'name' => 'Agua Mineral', 'slug' => 'agua-mineral', 'description' => $description, 'price' => 3200, 'qty' => 15, 'discount' => 0, 'min' => 0, 'max' => 0, 'state' => '1', 'category_id' => 5],
            ['id' => 7, 'name' => 'Rollo California', 'slug' => 'rollo-california', 'description' => $description, 'price' => 4000, 'qty' => 10, 'discount' => 0, 'min' => 0, 'max' => 0, 'state' => '1', 'category_id' => 4],
            ['id' => 8, 'name' => 'Refresco', 'slug' => 'refresco', 'description' => $description, 'price' => 3600, 'qty' => 5, 'discount' => 0, 'min' => 0, 'max' => 0, 'state' => '1', 'category_id' => 5],
            ['id' => 9, 'name' => 'Pollo Asado', 'slug' => 'pollo-asado', 'description' => $description, 'price' => 1750, 'qty' => 24, 'discount' => 0, 'min' => 0, 'max' => 0, 'state' => '1', 'category_id' => 2],
            ['id' => 10, 'name' => 'Malteada', 'slug' => 'malteada', 'description' => $description, 'price' => 2000, 'qty' => 30, 'discount' => 0, 'min' => 0, 'max' => 0, 'state' => '1', 'category_id' => 5],
            ['id' => 11, 'name' => 'Hamburguesa de Queso', 'slug' => 'hamburguesa-de-queso', 'description' => $description, 'price' => 3500, 'qty' => 40, 'discount' => 0, 'min' => 0, 'max' => 0, 'state' => '1', 'category_id' => 3]

        ];
        DB::table('products')->insert($products);
        
        factory(App\ImageProduct::class, 11)->create();
    }
}
