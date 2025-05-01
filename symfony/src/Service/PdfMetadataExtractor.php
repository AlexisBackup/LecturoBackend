<?php

namespace App\Service;

use Smalot\PdfParser\Parser;

class PdfMetadataExtractor implements MetadataExtractorInterface
{
    public function supports(string $mimeType): bool
    {
        return $mimeType === 'application/pdf';
    }

    public function extract(string $filePath): array
    {
        $parser = new Parser();
        $pdf = $parser->parseFile($filePath);
        $details = $pdf->getDetails();

        return [
            'title' => $details['Title'] ?? null,
            'author' => $details['Author'] ?? null,
            'subject' => $details['Subject'] ?? null,
            'keywords' => $details['Keywords'] ?? null,
        ];
    }
}
