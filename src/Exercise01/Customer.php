<?php

namespace App\Exercise01;

readonly class Customer
{
    public function __construct(
        public string $name,
        public string $email,
        public string $phone,
        public string $address,
        public string $city,
        public string $zip
    ) {
    }
}
