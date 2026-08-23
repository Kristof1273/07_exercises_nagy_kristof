<?php

declare(strict_types=1);

namespace App\Exercise03\PartB;

class NoDiscount implements DiscountStrategyInterface
{
    public function calculateDiscount(float $price): float
    {
        return $price;
    }
}
