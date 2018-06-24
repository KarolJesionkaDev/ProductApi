<?php

namespace App\Http;

use App\Http\StrategyInterface;
use App\Repositories\ProductRepository;

class StrategyLessThan implements StrategyInterface
{
    public function getProducts(int $amount)
    {
        $productRepo = new ProductRepository();
        return $productRepo->getLessThan($amount);
    }
}