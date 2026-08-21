<?php

declare(strict_types=1);

namespace App\Exercise02\Formatters;

use App\Exercise02\Contracts\ReportFormatter;

class HtmlFormatter implements ReportFormatter
{
    public function format(array $data): string
    {
        $content = "<html><body>\n";
        foreach ($data as $item) {
            $content .= "<div>$item</div>\n";
        }
        $content .= "</body></html>\n";

        return $content;
    }
}
