<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\MetadataManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;

final class UploadBookController extends AbstractController
{
    #[Route('/api/upload-book', name: 'api_upload_book')]
    public function UploadBook(Request $request, MetadataManager $metadataManager): JsonResponse
    {
        /** @var UploadedFile $file */
        $file = $request->files->get('file');

        if ($file) {
            $filePath = $file->getPathname();
            $mimeType = $file->getMimeType();

            try {
                $metadata = $metadataManager->extractMetadata($filePath, $mimeType);
                // Traitez les métadonnées selon vos besoins
                return new JsonResponse($metadata);
            } catch (\RuntimeException $e) {
                return new JsonResponse(['error' => 'Upload failed', 'erreur' => $e], 400);
            }
        } else {
            return new JsonResponse(['error' => 'Upload failed', 'code' => $file->getError()], 400);
        }
    }
}
