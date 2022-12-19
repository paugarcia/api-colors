<?php

namespace App\Controller\Api\Color;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

use OpenApi\Attributes as OA;

use Colors\Color\Application\Commands\CreateColor\CreateColorApplicationService;
use Colors\Color\Application\Commands\CreateColor\CreateColorCommand;
use Colors\Color\Application\Commands\CreateColor\CreateColorCommandHandler;

use Colors\Color\Infrastructure\ColorInMemoryRepository;

final class CreateAction extends AbstractController {

    /**
     * CREATE COLOR
     *
     * This call is used for create a color
     */
    #[Route('/api/color/create', methods: ['POST'])]
    #[OA\Parameter(
        name: 'color',
        in: 'query',
        description: 'The field used to order rewards',
        schema: new OA\Schema(type: 'string')
    )]
    #[OA\Response(
        response: 200,
        description: 'Successful operation'
    )]
    #[OA\Response(
        response: 400,
        description: 'Error'
    )]
    #[OA\Tag(name: 'COLORS')]
    public function create(Request $request): JsonResponse
    {
        if (empty($request->get('color'))){
            return new JsonResponse(
                ['message' => 'Missing input [color].'],
                400
            );
        }

        $colorRepository = new ColorInMemoryRepository();
        $commandHandler = new CreateColorCommandHandler(new CreateColorApplicationService($colorRepository));
        $newColor = $request->get('color');
        try {
            /** TODO: CHANGE THIS AND CREATE A NEW ID */
            $commandHandler->handle(new CreateColorCommand($newColor, $newColor));
        } catch (Exception $e){
            return new JsonResponse(
                ['message' => '[Error] ' . $e->getMessage()],
                400
            );
        }

        return new JsonResponse(
            ['message' => 'The color (' . $newColor . ') has been created.'],
            200
        );
    }
}