<?php

declare(strict_types=1);

namespace App\Exercise01;

readonly class OrderResult
{
    public function __construct(
        public float $subtotal,
        public float $tax,
        public float $total
    ) {
    }
}
