<?php

declare(strict_types=1);

namespace App\Exercise02\Contracts;

interface ReportFormatter
{
    public function format(array $data): string;
}
