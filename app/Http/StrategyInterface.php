<?php

namespace App\Http;

interface StrategyInterface
{
    public function getProducts(int $amount);
}