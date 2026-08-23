<?php

declare(strict_types=1);

namespace App\Exercise03\PartB;

class Order
{
    public function __construct(private DiscountStrategyInterface $discountStrategy)
    {
    }

    public function getTotal(float $basePrice): float
    {
        return $this->discountStrategy->calculateDiscount($basePrice);
    }
}
