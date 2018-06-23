<?php

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();

        $products = [
            ['Product 1', 4],
            ['Product 2', 12],
            ['Product 5', 0],
            ['Product 7', 6],
            ['Product 8', 2],
        ];

        foreach($products as $product) {
            Product::create([
                'name' => $product[0],
                'amount' => $product[1]
            ]);
        }
    }
}
