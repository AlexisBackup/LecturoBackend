<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Smalot\PdfParser\Parser;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Mime\MimeTypes;

final class UploadBookController extends AbstractController
{

    #[Route('/api/upload-book', name: 'api_upload_book')]
    public function UploadBook(Request $request): JsonResponse
    {

        $mimeTypes = new MimeTypes();

        /** @var UploadedFile $file */
        $file = $request->files->get('file');
        $parser = new Parser();

        $types = $mimeTypes->getMimeTypes('epub');

        return new JsonResponse(['type' => $file->getMimeType(), 'mime' => $types]);
        // $pdf = $parser->parseFile($file->getPathname());

        // $details = $pdf->getDetails();
        // $pages = $pdf->getPages();

        // if ($file->getError() !== UPLOAD_ERR_OK) {
        //     return new JsonResponse(['error' => 'Upload failed', 'code' => $file->getError()], 400);
        // }

        // // Exemples de métadonnées retournées
        // return new JsonResponse([

        //     'filename' => $file->getClientOriginalName(),
        //     'title' => $details['Title'] ?? null,
        //     'author' => $details['Author'] ?? null,
        //     'pages' => count($pages),
        //     'producer' => $details['Producer'] ?? null,
        //     'created' => $details['CreationDate'] ?? null,
        // ]);
    }
}
