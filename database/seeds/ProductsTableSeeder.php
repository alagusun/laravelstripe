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
        DB::table('products')->insert([
            'name' => 'ABC',
            'price' => 12,
            'description' => 'ABC Description',
        ]);
		 DB::table('products')->insert([
            'name' => 'XYZ',
            'price' => 10,
            'description' => 'XYZ Description',
        ]);
    }
}
