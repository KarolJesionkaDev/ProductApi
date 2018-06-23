<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function getAll()
    {
        return Product::all();
    }

    public function getMoreThan(int $amount)
    {
        return Product::where('amount', '>', $amount)->get();
    }

    public function getLessThan(int $amount)
    {
        return Product::where('amount', '<', $amount)->get();
    }

    public function getJust(int $amount)
    {
        return Product::where('amount', $amount)->get();
    }

    public function getById(int $id): Product
    {
        return Product::findOrFail($id);
    }
}