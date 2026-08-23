<?php

declare(strict_types=1);

namespace App\Exercise01;

readonly class Product
{
    public function __construct(
        public string $id,
        public string $name,
        public float $price
    ) {
    }
}
