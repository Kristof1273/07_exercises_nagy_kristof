<?php
declare(strict_types=1);

namespace App\Exercise03\PartB;

class FixedAmountDiscount implements DiscountStrategyInterface
{
    public function __construct(private float $discountAmount) {}

    public function calculateDiscount(float $price): float
    {
        return max(0.0, $price - $this->discountAmount);
    }
}