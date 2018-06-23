<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository
{
    public function getAll(): Collection
    {
        return Product::all();
    }

    public function getMoreThan(int $amount): Collection
    {
        return Product::where('amount', '>', $amount)->get();
    }

    public function getLessThan(int $amount): Collection
    {
        return Product::where('amount', '<', $amount)->get();
    }

    public function getJust(int $amount): Collection
    {
        return Product::where('amount', $amount)->get();
    }

    public function getById(int $id): Product
    {
        return Product::findOrFail($id);
    }
}