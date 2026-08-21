<?php

declare(strict_types=1);

namespace App\Exercise02\Formatters;

use App\Exercise02\Contracts\ReportFormatter;

class CsvFormatter implements ReportFormatter
{
    public function format(array $data): string
    {
        return implode("\n", $data);
    }
}
