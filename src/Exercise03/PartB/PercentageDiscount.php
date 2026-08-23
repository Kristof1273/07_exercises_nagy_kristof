<?php

declare(strict_types=1);

namespace App\Exercise03\PartB;

class PercentageDiscount implements DiscountStrategyInterface
{
    public function __construct(private float $percentage)
    {
    }

    public function calculateDiscount(float $price): float
    {
        return $price - ($price * ($this->percentage / 100));
    }
}
