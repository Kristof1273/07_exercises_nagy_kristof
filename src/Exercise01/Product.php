<?php

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
