<?php

declare(strict_types=1);

namespace App\Exercise02\Formatters;

use App\Exercise02\Contracts\ReportFormatter;

class JsonFormatter implements ReportFormatter
{
    public function format(array $data): string
    {
        return json_encode($data, JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR);
    }
}
