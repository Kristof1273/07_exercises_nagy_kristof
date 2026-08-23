<?php
declare(strict_types=1);

namespace App\Exercise04;

enum OrderStatus: int
{
    case COMPLETED = 1;
    case PENDING = 2;
}

class OrderProcessor
{
    private const DISCOUNT_THRESHOLD = 100.0;
    private const DISCOUNT_MULTIPLIER = 0.9;

    /**
     * @param array $orders
     * @param string $category
     * @param bool $isActive
     * @param bool $applyDiscount
     * @return array
     */
    public function processOrders(
        array $orders,
        string $category,
        bool $isActive = true,
        bool $applyDiscount = false
    ): array {
        if (!$isActive) {
            return [];
        }

        $processedOrders = [];

        foreach ($orders as $order) {
            $status = OrderStatus::tryFrom($order['s']);

            if ($status === OrderStatus::COMPLETED) {
                $processedOrders[] = $this->processCompletedOrder($order, $category, $applyDiscount);
                continue;
            }

            if ($status === OrderStatus::PENDING) {
                $processedOrders[] = $this->processPendingOrder($order, $category);
                continue;
            }
        }

        return $processedOrders;
    }

    private function processCompletedOrder(array $order, string $category, bool $applyDiscount): array
    {
        $totalPrice = (float)$order['p'] * (int)$order['q'];

        if ($applyDiscount && $totalPrice > self::DISCOUNT_THRESHOLD) {
            $totalPrice *= self::DISCOUNT_MULTIPLIER;
        }

        return [
            'name'  => (string)$order['n'],
            'total' => $totalPrice,
            'extra' => $category,
        ];
    }

    private function processPendingOrder(array $order, string $category): array
    {
        return [
            'name'  => (string)$order['n'],
            'total' => 0.0,
            'extra' => $category . ' (pending)',
        ];
    }
}