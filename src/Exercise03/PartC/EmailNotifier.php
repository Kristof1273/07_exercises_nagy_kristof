<?php

declare(strict_types=1);

namespace App\Exercise03\PartC;

class EmailNotifier implements SubscriberInterface
{
    /**
     * @param string $event
     * @param array<string, mixed> $data
     */
    public function update(string $event, array $data): void
    {
        echo "[EmailNotifier] Email prepared for event '{$event}'. Recipient: {$data['email']}\n";
    }
}
