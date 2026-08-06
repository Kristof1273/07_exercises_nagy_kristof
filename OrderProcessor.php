<?php

class OrderProcessor
{
    public $db;
    public $mailer;
    public $logger;
    public $taxRate = 0.27;
    public function processOrder($customerName, $customerEmail, $customerPhone, 
    
$customerAddress, $customerCity, $customerZip, $productId, $productName, 
$productPrice, $quantity)
    {
        // Calculate total
        $subtotal = $productPrice * $quantity;
        $tax = $subtotal * $this->taxRate;
        $total = $subtotal + $tax;
        // Save to database
        $this->db->query("INSERT INTO orders VALUES (NULL, '$customerName', 
'$customerEmail', '$productName', $total)");
        // Send email
        $this->mailer->send($customerEmail, "Order Confirmation", "Dear 
$customerName, your order for $quantity x $productName totaling $$total has been 
placed.");
        // Log
        $this->logger->log("Order placed: $customerName, $customerEmail, 
$customerPhone, $customerAddress, $customerCity, $customerZip, $productName, 
$total");
        // Also save customer
        $this->db->query("INSERT INTO customers VALUES (NULL, '$customerName', 
'$customerEmail', '$customerPhone', '$customerAddress', '$customerCity', 
'$customerZip')");
        // Send SMS  
        if ($customerPhone != "") {
            // ... SMS sending logic duplicated from another class
            $message = "Dear $customerName, your order for $quantity x 
$productName totaling $$total has been placed.";
            $smsService = new SmsService();
            $smsService->send($customerPhone, $message);
}
return $total;
}
}





?>