<?php

declare(strict_types=1);

namespace App\Exercise02\Contracts;

interface ReportFormatter
{
    /**
     * @param array<mixed> $data
     */
    public function format(array $data): string;
}
