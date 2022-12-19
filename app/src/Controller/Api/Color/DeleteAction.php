<?php

namespace App\Controller\Api\Color;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

use OpenApi\Attributes as OA;

use Colors\Color\Application\Commands\DeleteColor\DeleteColorApplicationService;
use Colors\Color\Application\Commands\DeleteColor\DeleteColorCommand;
use Colors\Color\Application\Commands\DeleteColor\DeleteColorCommandHandler;

use Colors\Color\Infrastructure\ColorInMemoryRepository;

final class DeleteAction extends AbstractController {

    /**
     * DELETE COLOR
     *
     * This call is used delete a color
     */
    #[Route('/api/color/delete/{colorId}', methods: ['DELETE'])]
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
        } catch (Exception $e){
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