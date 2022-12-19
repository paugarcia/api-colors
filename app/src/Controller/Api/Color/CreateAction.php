<?php

namespace App\Controller\Api\Color;


use Colors\Color\Application\Commands\CreateColor\CreateColorApplicationService;
use Colors\Color\Application\Commands\CreateColor\CreateColorCommand;
use Colors\Color\Application\Commands\CreateColor\CreateColorCommandHandler;

use Colors\Color\Infrastructure\ColorInMemoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

use OpenApi\Attributes as OA;

final class CreateAction extends AbstractController{

    /**
     * CREATE COLOR
     *
     * This call is used for create a color
     */
    #[Route('/api/color/create/{colorId}', methods: ['GET'])]
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
}