<?php

declare(strict_types=1);

namespace App\Exercise03\PartC;

interface SubscriberInterface
{
    /**
     * @param string $event
     * @param array<string, mixed> $data
     */
    public function update(string $event, array $data): void;
}
