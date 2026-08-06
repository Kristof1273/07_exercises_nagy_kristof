<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\exercise01\Customer;
use App\exercise01\Product;
use App\exercise01\OrderProcessor;

$customer = new Customer('test user', 'user@test.com', '1234567890', 'test address', 'test city', '12345');
$product = new Product('1', 'test product', 100.0);

?>