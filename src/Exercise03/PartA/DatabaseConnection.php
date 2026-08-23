<?php
declare(strict_types=1);

namespace App\Exercise03\PartA;

class DatabaseConnection
{
    private static ?DatabaseConnection $instance = null;

    private function __construct()
    {
        echo "New database connection established!\n";
    }

    public static function getInstance(): DatabaseConnection
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __clone() {}

    public function __wakeup()
    {
        throw new \Exception("Unserialization of Singleton instances is prohibited!");
    }
}

echo "--- Part A: Singleton Test ---\n";

$db1 = DatabaseConnection::getInstance();
$db2 = DatabaseConnection::getInstance();

if ($db1 === $db2) {
    echo "Success: Variables db1 and db2 point to the exact same instance in memory!\n\n";
}