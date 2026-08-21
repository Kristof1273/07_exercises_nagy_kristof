<?php

declare(strict_types=1);

namespace App\Exercise02\Contracts;

interface ReportSaver
{
    public function save(string $filename, string $content): void;
}
