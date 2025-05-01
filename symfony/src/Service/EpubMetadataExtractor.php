<?php

namespace App\Service;

use SebLucas\EPubMeta\EPub;

class EpubMetadataExtractor implements MetadataExtractorInterface
{
    public function supports(string $mimeType): bool
    {
        return $mimeType === 'application/epub+zip';
    }

    public function extract(string $filePath): array
    {
        $epub = new EPub($filePath);

        return [
            'title' => $epub->getTitle(),
            'publisher' => $epub->getPublisher(),
            'language' => $epub->getLanguage(),
            'authors' => $epub->getAuthors(),
            'subjects' => $epub->getSubjects(),
        ];
    }
}
