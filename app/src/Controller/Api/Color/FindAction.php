<?php

namespace App\Controller\Api\Color;


use Colors\Color\Application\Queries\FindColorById\FindColorByIdApplicationService;
use Colors\Color\Application\Queries\FindColorById\FindColorByIdQuery;
use Colors\Color\Application\Queries\FindColorById\FindColorByIdQueryHandler;

use Colors\Color\Infrastructure\ColorInMemoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

use OpenApi\Attributes as OA;

final class FindAction extends AbstractController {

    /**
     * FIND COLOR
     *
     * This call is used for find a color
     */
    #[Route('/api/color/find/{colorId}', methods: ['GET'])]
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
}