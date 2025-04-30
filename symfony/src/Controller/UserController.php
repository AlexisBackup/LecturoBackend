<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/api')]
final class UserController extends AbstractController
{
    #[Route('/user', name: 'app_get_user')]
    public function index(Request $request, SerializerInterface $serializer): Response {
        /** @var User $user */
        $user = $this->getUser();
        $jsonUser = $serializer->serialize($user, 'json', ['groups' => 'userDetails']);

        return new JsonResponse($jsonUser, Response::HTTP_OK, [], true);
    }
}
