<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/api/color")
 */
class ApiColorController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"})
     */
    public function add()
    {
       return new Response("Hola");
    }

    /**
     * @Route("/{id}", methods={"GET"})
     */
    public function find(string $id)
    {
        return new Response($id);
    }

    /**
     * @Route("/{id}", methods={"DELETE"})
     */
    public function delete(string $id)
    {
        return new Response($id);
    }
}