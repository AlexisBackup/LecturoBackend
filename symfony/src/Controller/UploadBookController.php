<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\MetadataManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;

final class UploadBookController extends AbstractController
{
    #[Route('/api/upload-book', name: 'api_upload_book')]
    public function UploadBook(Request $request, MetadataManager $metadataManager): Response
    {
        $files = $request->files->get('file');

        $allMetadata = [];

        if (!empty($files)) {

            foreach ($files as $file) {

                if ($file instanceof UploadedFile) {
                    $filePath = $file->getPathname();
                    $mimeType = $file->getMimeType();

                    try {
                        $metadata = $metadataManager->extractMetadata($filePath, $mimeType);
                        $allMetadata[] = $metadata;
                    } catch (\RuntimeException $e) {
                        return new JsonResponse(['error' => 'Upload failed', 'erreur' => $e->getMessage()], 400);
                    }
                }
            }
            return new JsonResponse($allMetadata);
        } else {
            return new JsonResponse(['error' => 'No files uploaded'], 400);
        }
    }
}
