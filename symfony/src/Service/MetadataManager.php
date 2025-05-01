<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;

class MetadataManager
{
    private iterable $extractors;

    public function __construct(
        #[AutowireIterator('app.metadata_extractor')]
        iterable $extractors
    ) {
        $this->extractors = $extractors;
    }

    public function extractMetadata(string $filePath, string $mimeType): array
    {
        foreach ($this->extractors as $extractor) {
            if ($extractor->supports($mimeType)) {
                return $extractor->extract($filePath);
            }
        }

        throw new \RuntimeException('Unsupported file type: ' . $mimeType);
    }
}
