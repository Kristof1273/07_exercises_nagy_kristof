<?php

declare(strict_types=1);

namespace Tests\Exercise02;

use PHPUnit\Framework\TestCase;
use App\Exercise02\Reports\ReportGenerator;
use App\Exercise02\Contracts\ReportFormatter;
use App\Exercise02\Contracts\ReportSaver;

class ReportGeneratorTest extends TestCase
{
    public function testGenerateCallsFormatterAndSaverCorrectly(): void
    {
        $testData = ['Test 1'];
        $testFilename = 'report.json';
        $fakeFormattedContent = '{"data": "fake"}';

        $mockFormatter = $this->createMock(ReportFormatter::class);
        $mockFormatter->expects($this->once())
            ->method('format')
            ->with($testData)
            ->willReturn($fakeFormattedContent);

        $mockSaver = $this->createMock(ReportSaver::class);
        $mockSaver->expects($this->once())
            ->method('save')
            ->with($testFilename, $fakeFormattedContent);

        $generator = new ReportGenerator($mockFormatter, $mockSaver);

        $generator->generate($testData, $testFilename);
    }
}
