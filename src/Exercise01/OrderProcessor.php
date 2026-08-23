<?php

declare(strict_types=1);

namespace App\Exercise01;

class OrderProcessor
{
    private mixed $db;
    private mixed $mailer;
    private mixed $logger;
    private mixed $smsService;
    private float $taxRate;

    public function __construct(
        mixed $db,
        mixed $mailer,
        mixed $logger,
        mixed $smsService,
        float $taxRate = 0.27
    ) {
        $this->db = $db;
        $this->mailer = $mailer;
        $this->logger = $logger;
        $this->smsService = $smsService;
        $this->taxRate = $taxRate;
    }

    public function processOrder(Customer $customer, Product $product, int $quantity): OrderResult
    {

        $orderResult = $this->calculateTotal($product, $quantity);
        $this->saveToDatabase($customer, $product, $orderResult);
        $this->notifyCustomer($customer, $product, $quantity, $orderResult);
        $this->logOrder($customer, $product, $orderResult);

        return $orderResult;
    }

    private function calculateTotal(Product $product, int $quantity): OrderResult
    {
        $subtotal = $product->price * $quantity;
        $tax = $subtotal * $this->taxRate;

        return new OrderResult($subtotal, $tax, $subtotal + $tax);
    }

    private function saveToDatabase(Customer $customer, Product $product, OrderResult $orderResult): void
    {
        $this->db->query("INSERT INTO orders VALUES (NULL, '{$customer->name}', '{$customer->email}', '{$product->id}', {$orderResult->total})");
        $this->db->query("INSERT INTO customers VALUES (NULL, '{$customer->name}', '{$customer->email}', '{$customer->phone}', '{$customer->address}', '{$customer->city}', '{$customer->zip}')");
    }

    private function notifyCustomer(Customer $customer, Product $product, int $quantity, OrderResult $orderResult): void
    {
        $message = "Dear {$customer->name}, your order for $quantity x {$product->name} totaling \${$orderResult->total} has been placed.";
        $this->mailer->send($customer->email, "Order Confirmation", $message);

        if ($customer->phone != "") {
            $this->smsService->send($customer->phone, $message);
        }
    }

    private function logOrder(Customer $customer, Product $product, OrderResult $orderResult): void
    {
        $this->logger->log("Order placed: {$customer->name}, {$customer->email}, {$customer->phone}, {$customer->address}, {$customer->city}, {$customer->zip}, {$product->name}, {$orderResult->total}");
    }
}
