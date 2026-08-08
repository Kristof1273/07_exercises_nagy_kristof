<?php

namespace App\Exercise01;

class OrderProcessor
{
    public $db;
    public $mailer;
    public $logger;
    public $taxRate = 0.27;

    public function processOrder(Customer $customer, Product $product, int $quantity) {
        
        $orderResult = $this->calculateTotal($product, $quantity);
        $this->saveToDatabase($customer, $product, $orderResult);
        $this->notifyCustomer($customer, $product, $quantity, $orderResult);
        $this->logOrder($customer, $product, $orderResult);

        return $orderResult;
    }

    private function calculateTotal(Product $product, int $quantity): OrderResult {
        $subtotal = $product->price * $quantity;
        $tax = $subtotal * $this->taxRate;
        
        return new OrderResult($subtotal, $tax, $subtotal + $tax);
    }

    private function saveToDatabase(Customer $customer, Product $product, OrderResult $orderResult): void {
        $this->db->query("INSERT INTO orders VALUES (NULL, '{$customer->name}', '{$customer->email}', '{$product->id}', {$orderResult->total})");
        $this->db->query("INSERT INTO customers VALUES (NULL, '{$customer->name}', '{$customer->email}', '{$customer->phone}', '{$customer->address}', '{$customer->city}', '{$customer->zip}')");
    }

    private function notifyCustomer(Customer $customer, Product $product, int $quantity, OrderResult $orderResult): void {
        $this->mailer->send($customer->email, "Order Confirmation", "Dear {$customer->name}, your order for $quantity x {$product->name} totaling \${$orderResult->total} has been placed.");
        
        if ($customer->phone != "") {
            $message = "Dear {$customer->name}, your order for $quantity x {$product->name} totaling \${$orderResult->total} has been placed.";
            $smsService = new SmsService();
            $smsService->send($customer->phone, $message);
        }
    }

    private function logOrder(Customer $customer, Product $product, OrderResult $orderResult): void {
        $this->logger->log("Order placed: {$customer->name}, {$customer->email}, {$customer->phone}, {$customer->address}, {$customer->city}, {$customer->zip}, {$product->name}, {$orderResult->total}");
    }
}



}