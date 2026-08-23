<?php

declare(strict_types=1);

namespace App\Exercise03\PartC;

class EventPublisher
{
    /** @var array<string, SubscriberInterface> */
    private array $subscribers = [];

    public function subscribe(SubscriberInterface $subscriber): void
    {
        $hash = spl_object_hash($subscriber);
        $this->subscribers[$hash] = $subscriber;
    }

    public function unsubscribe(SubscriberInterface $subscriber): void
    {
        $hash = spl_object_hash($subscriber);
        unset($this->subscribers[$hash]);
    }

    /**
     * @param string $event
     * @param array<string, mixed> $data
     */
    public function notify(string $event, array $data = []): void
    {
        foreach ($this->subscribers as $subscriber) {
            $subscriber->update($event, $data);
        }
    }
}
