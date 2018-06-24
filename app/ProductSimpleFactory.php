<?php

namespace App;

use App\Models\Product;

class ProductSimpleFactory
{
    public function createProduct(): Product
    {
        return new Product();
    }
}