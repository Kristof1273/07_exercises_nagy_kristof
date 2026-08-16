<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Exercise01\Customer;
use App\Exercise01\Product;
use App\Exercise01\OrderProcessor;


// Exercise01

class DummyDb { 
    public function query($sql) { echo "DB Query lefutott: $sql\n"; } 
}
class DummyMailer { 
    public function send($to, $subject, $body) { echo "Email elküldve ($to): $subject\n"; } 
}
class DummyLogger { 
    public function log($msg) { echo "Logolva: $msg\n"; } 
}
class DummySmsService { 
    public function send($to, $msg) { echo "SMS elküldve ($to): $msg\n"; } 
}

$db = new DummyDb();
$mailer = new DummyMailer();
$logger = new DummyLogger();
$smsService = new DummySmsService();

$customer = new Customer('test user', 'user@test.com', '1234567890', 'test address', 'test city', '12345');
$product = new Product('1', 'test product', 100.0);

$orderProcessor = new OrderProcessor($db, $mailer, $logger, $smsService);


$orderResult = $orderProcessor->processOrder($customer, $product, 4);

echo "--- Rendelés eredménye ---\n";
echo "Részösszeg: $" . $orderResult->subtotal . "\n";
echo "Adó: $" . $orderResult->tax . "\n";
echo "Végösszeg: $" . $orderResult->total . "\n";