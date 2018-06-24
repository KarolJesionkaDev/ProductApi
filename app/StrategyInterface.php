<?php

namespace App;

interface StrategyInterface
{
    public function getProducts(int $amount);
}