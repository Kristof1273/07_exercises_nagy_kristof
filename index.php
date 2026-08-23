<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Exercise01\Customer;
use App\Exercise01\Product;
use App\Exercise01\OrderProcessor;

use App\Exercise02\Reports\ReportGenerator;
use App\Exercise02\Formatters\JsonFormatter;
use App\Exercise02\Savers\FileSaver;

use App\Exercise03\PartA\DatabaseConnection;
use App\Exercise03\PartB\Order;
use App\Exercise03\PartB\NoDiscount;
use App\Exercise03\PartB\PercentageDiscount;
use App\Exercise03\PartB\FixedAmountDiscount;
use App\Exercise03\PartC\EventPublisher;
use App\Exercise03\PartC\EmailNotifier;
use App\Exercise03\PartC\AuditLogger;

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


// Exercise02

$data = ['Item 1', 'Item 2', 'Item 3'];
$fileSaver = new FileSaver();

$jsonGenerator = new ReportGenerator(new JsonFormatter(), $fileSaver);
$jsonGenerator->generate($data, 'report.json');


// Exercise03

// --- Part A: Singleton Test ---
echo "--- Part A: Singleton Test ---\n";
$db1 = DatabaseConnection::getInstance();
$db2 = DatabaseConnection::getInstance();

if ($db1 === $db2) {
    echo "Success: Variables db1 and db2 point to the exact same instance in memory!\n\n";
}

// --- Part B: Strategy Test ---
echo "--- Part B: Strategy Test ---\n";
$basePrice = 1000.0;
echo "Original price: $basePrice\n";

$orderNormal = new Order(new NoDiscount());
echo "No discount: " . $orderNormal->getTotal($basePrice) . "\n";

$orderPercentage = new Order(new PercentageDiscount(20));
echo "With 20% discount: " . $orderPercentage->getTotal($basePrice) . "\n";

$orderFixed = new Order(new FixedAmountDiscount(150));
echo "With 150 fixed discount: " . $orderFixed->getTotal($basePrice) . "\n\n";


// --- Part C: Observer Test ---
echo "--- Part C: Observer Test ---\n";
$publisher = new EventPublisher();

$emailNotifier = new EmailNotifier();
$auditLogger = new AuditLogger();

echo "-> Subscribing (EmailNotifier, AuditLogger)...\n";
$publisher->subscribe($emailNotifier);
$publisher->subscribe($auditLogger);

echo "-> Triggering event: 'user_registered'\n";
$publisher->notify('user_registered', ['user_id' => 42, 'email' => 'hello@example.com']);

echo "\n-> Unsubscribing (EmailNotifier)...\n";
$publisher->unsubscribe($emailNotifier);

echo "-> Triggering event: 'user_login'\n";
$publisher->notify('user_login', ['user_id' => 42, 'email' => 'hello@example.com']);
echo "\n";
