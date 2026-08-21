<?php
declare(strict_types=1);

namespace Tests\Exercise02;

use PHPUnit\Framework\TestCase;
use App\Exercise02\Formatters\JsonFormatter;

class JsonFormatterTest extends TestCase
{
    public function testFormatReturnsValidJsonString(): void
    {
        $formatter = new JsonFormatter();
        $data = ['Item 1', 'Item 2'];
        
        $expectedJson = json_encode($data, JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR);

        $result = $formatter->format($data);

        $this->assertEquals($expectedJson, $result);
    }
}