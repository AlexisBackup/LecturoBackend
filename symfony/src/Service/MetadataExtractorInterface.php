<?php

namespace App\Service;

interface MetadataExtractorInterface
{
    public function supports(string $mimeType): bool;
    public function extract(string $filePath): array;
}
