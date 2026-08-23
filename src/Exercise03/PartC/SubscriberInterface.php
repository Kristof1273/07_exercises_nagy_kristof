<?php
declare(strict_types=1);

namespace App\Exercise03\PartC;

interface SubscriberInterface
{
    public function update(string $event, array $data): void;
}