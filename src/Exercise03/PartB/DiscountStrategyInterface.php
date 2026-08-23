<?php
declare(strict_types=1);

namespace App\Exercise03\PartB;

interface DiscountStrategyInterface
{
    public function calculateDiscount(float $price): float;
}