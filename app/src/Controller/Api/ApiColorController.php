<?php

namespace App\Controller\Api;

use Colors\Color\Infrastructure\ColorInMemoryRepository;

use Colors\Color\Application\Commands\CreateColor\CreateColorApplicationService;
use Colors\Color\Application\Commands\CreateColor\CreateColorCommand;
use Colors\Color\Application\Commands\CreateColor\CreateColorCommandHandler;

use Colors\Color\Application\Commands\DeleteColor\DeleteColorApplicationService;
use Colors\Color\Application\Commands\DeleteColor\DeleteColorCommand;
use Colors\Color\Application\Commands\DeleteColor\DeleteColorCommandHandler;

use Colors\Color\Application\Queries\FindColorById\FindColorByIdApplicationService;
use Colors\Color\Application\Queries\FindColorById\FindColorByIdQuery;
use Colors\Color\Application\Queries\FindColorById\FindColorByIdQueryHandler;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

use OpenApi\Attributes as OA;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/api/color")
 */
class ApiColorController extends AbstractController
{
    /**
     * CREATE COLOR
     *
     * This call is used for create a color
     */
    #[Route('/create/{colorId}', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Successful operation'
    )]
    #[OA\Response(
        response: 400,
        description: 'Error'
    )]
    #[OA\Tag(name: 'COLORS')]
    public function create(string $colorId): JsonResponse
    {
        if (empty($colorId)){
            return new JsonResponse(
                ['message' => 'Missing parameters [colorId].'],
                400
            );
        }

        $colorRepository = new ColorInMemoryRepository();
        $commandHandler = new CreateColorCommandHandler(new CreateColorApplicationService($colorRepository));

        try {
            /** TODO: CHANGE THIS AND CREATE A NEW ID */
            $commandHandler->handle(new CreateColorCommand($colorId, $colorId));
        } catch (\Exception $e){
            return new JsonResponse(
                ['message' => '[Error] ' . $e->getMessage()],
                400
            );
        }

        return new JsonResponse(
            ['message' => 'The color (' . $colorId . ') has been created.'],
            200
        );
    }

    /**
     * FIND COLOR
     *
     * This call is used for find a color
     */
    #[Route('/find/{colorId}', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Color founded'
    )]
    #[OA\Response(
        response: 404,
        description: 'Color not found'
    )]
    #[OA\Response(
        response: 400,
        description: 'Error'
    )]
    #[OA\Tag(name: 'COLORS')]
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
     * DELETE COLOR
     *
     * This call is used delete a color
     */
    #[Route('/delete/{colorId}', methods: ['DELETE'])]
    #[OA\Response(
        response: 200,
        description: 'Color deleted'
    )]
    #[OA\Response(
        response: 400,
        description: 'Error'
    )]
    #[OA\Tag(name: 'COLORS')]
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