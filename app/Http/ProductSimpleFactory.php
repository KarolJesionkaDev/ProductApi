<?php

namespace App\Http;

use App\Models\Product;

class ProductSimpleFactory
{
    public function createProduct(): Product
    {
        return new Product();
    }
}