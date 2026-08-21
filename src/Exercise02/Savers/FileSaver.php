<?php

declare(strict_types=1);

namespace App\Exercise02\Savers;

use App\Exercise02\Contracts\ReportSaver;

class FileSaver implements ReportSaver
{
    public function save(string $filename, string $content): void
    {
        file_put_contents($filename, $content);
        $extension = strtoupper(pathinfo($filename, PATHINFO_EXTENSION));
        echo "{$extension} report saved.\n";
    }
}
