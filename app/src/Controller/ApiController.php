<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ApiController extends AbstractController
{
    public function index(Request $request): JsonResponse
    {
        return new JsonResponse(
            [],
            Response::HTTP_OK
        );
    }
}