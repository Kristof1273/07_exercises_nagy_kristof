<?php

declare(strict_types=1);

namespace App\Exercise03\PartC;

class AuditLogger implements SubscriberInterface
{
    /** @var array<int, array<string, mixed>> */
    private array $logs = [];

    /**
     * @param string $event
     * @param array<string, mixed> $data
     */
    public function update(string $event, array $data): void
    {
        $this->logs[] = [
            'event' => $event,
            'data' => $data,
            'timestamp' => date('Y-m-d H:i:s')
        ];
        echo "[AuditLogger] Event '{$event}' securely logged. (Total logs: " . count($this->logs) . ")\n";
    }
}
