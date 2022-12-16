<?php

namespace App\Controller\Api;

use Colors\Color\Application\Commands\DeleteColor\DeleteColorApplicationService;
use Colors\Color\Application\Commands\DeleteColor\DeleteColorCommand;
use Colors\Color\Application\Commands\DeleteColor\DeleteColorCommandHandler;
use Colors\Color\Application\Queries\FindColorById\FindColorByIdApplicationService;
use Colors\Color\Application\Queries\FindColorById\FindColorByIdQuery;
use Colors\Color\Application\Queries\FindColorById\FindColorByIdQueryHandler;
use Colors\Color\Infrastructure\ColorInMemoryRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/api/color")
 */

/**
 * TODO: Make NelmioApi DOC in methods
 */
class ApiColorController extends AbstractController
{
    /**
     * TODO: Make this method
     */
    public function create()
    {}

    /**
     * @Route("/find/{colorId}", methods={"GET"})
     */
    public function find(string $colorId):JsonResponse
    {
        if (empty($colorId)){
            return new JsonResponse(
                ['message' => 'Missing parameters [colorId].'],
                400
            );
        }

        $colorRepository = new ColorInMemoryRepository();
        $queryHandler = new FindColorByIdQueryHandler(new FindColorByIdApplicationService($colorRepository));

        try {
            $color = $queryHandler->handle(new FindColorByIdQuery($colorId));
        } catch (\Exception $e){
            return new JsonResponse(
                ['message' => '[Error] ' . $e->getMessage()],
                400
            );
        }

        if (empty($color)){
            return new JsonResponse(
                ['message' => 'Color not found.'],
                404
            );
        }

        return new JsonResponse(
            $color->toArray(),
            200
        );
    }

    /**
     * @Route("/delete/{colorId}", methods={"DELETE","GET"})
     */
    public function delete(string $colorId): JsonResponse
    {
        if (empty($colorId)){
            return new JsonResponse(
                ['message' => 'Missing parameters [colorId].'],
                400
            );
        }

        $colorRepository = new ColorInMemoryRepository();
        $commandHandler = new DeleteColorCommandHandler(new DeleteColorApplicationService($colorRepository));

        try {
            $commandHandler->handle(new DeleteColorCommand($colorId));
        } catch (\Exception $e){
            return new JsonResponse(
                ['message' => '[Error] ' . $e->getMessage()],
                400
            );
        }

        return new JsonResponse(
            ['message' => 'The color has been deleted.'],
            200
        );
    }
}