<?php

declare(strict_types=1);

namespace App\Exercise02\Reports;

use App\Exercise02\Contracts\ReportFormatter;
use App\Exercise02\Contracts\ReportSaver;

class ReportGenerator
{
    public function __construct(
        private ReportFormatter $formatter,
        private ReportSaver $saver
    ) {
    }
    /**
     * @param array<mixed> $data
     * @param string $filename
     *
     */
    public function generate(array $data, string $filename): void
    {
        $content = $this->formatter->format($data);
        $this->saver->save($filename, $content);
    }
}
