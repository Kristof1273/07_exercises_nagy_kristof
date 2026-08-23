<?php

declare(strict_types=1);

namespace App\Exercise02\Formatters;

use App\Exercise02\Contracts\ReportFormatter;

class PdfFormatter implements ReportFormatter
{
    /**
     * @param array<mixed> $data
     */
    public function format(array $data): string
    {
        return "<pdf>" . implode(",", $data) . "</pdf>";
    }
}
