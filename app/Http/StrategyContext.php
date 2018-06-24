<?php

namespace App\Http;

class StrategyContext
{
    private $strategy = null;

    public function __construct(int $strategyId)
    {
        switch ($strategyId)
        {
            case -1:
                $this->strategy = new StrategyLessThan();
                break;
            case 1:
                $this->strategy = new StrategyMoreThan();
                break;
            default:
                $this->strategy = new StrategyJust();
                break;
        }
    }

    public function getFilteredProducts(int $amount)
    {
        return $this->strategy->getProducts($amount);
    }
}