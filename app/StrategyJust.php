<?php

namespace App;

use App\StrategyInterface;
use App\Repositories\ProductRepository;

class StrategyJust implements StrategyInterface
{
    public function getProducts(int $amount)
    {
        $productRepo = new ProductRepository();
        return $productRepo->getJust($amount);
    }
}