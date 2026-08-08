<?php

namespace App\Exercise01;

class OrderProcessor
{
    public $db;
    public $mailer;
    public $logger;
    public $taxRate = 0.27;

    public function processOrder(Customer $customer, Product $product, int $quantity) {
        // Calculate total
        $subtotal = $product->price * $quantity;
        $tax = $subtotal * $this->taxRate;
        $orderResult = new OrderResult($subtotal, $tax, $subtotal + $tax);

        // Save to database
        $this->db->query("INSERT INTO orders VALUES (NULL, '{$customer->name}', '{$customer->email}', '{$product->id}', {$orderResult->total})");
        
        // Send email
        $this->mailer->send($customer->email, "Order Confirmation", "Dear {$customer->name}, your order for $quantity x {$product->name} totaling \${$orderResult->total} has been placed.");
        
        // Log
        $this->logger->log("Order placed: {$customer->name}, {$customer->email}, {$customer->phone}, {$customer->address}, {$customer->city}, {$customer->zip}, {$product->name}, {$orderResult->total}");
        
        // Also save customer
        $this->db->query("INSERT INTO customers VALUES (NULL, '{$customer->name}', '{$customer->email}', '{$customer->phone}', '{$customer->address}', '{$customer->city}', '{$customer->zip}')");
        
        // Send SMS  
        if ($customer->phone != "") {
            // ... SMS sending logic duplicated from another class
            $message = "Dear {$customer->name}, your order for $quantity x {$product->name} totaling \${$orderResult->total} has been placed.";
            $smsService = new SmsService();
            $smsService->send($customer->phone, $message);
        }

        return $orderResult;
    }
}