<?php

namespace App\Controller\Api\Color;

use Colors\Color\Domain\Color;
use Colors\Color\Domain\ValueObjects\ColorId;
use Colors\Color\Domain\ValueObjects\ColorName;
use Colors\Color\Services\CompareColorsService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

use OpenApi\Attributes as OA;


use Colors\Color\Infrastructure\ColorInMemoryRepository;

final class CompareAction extends AbstractController {

    /**
     * COMPARE COLORS
     *
     * This call is used for compare a color collection with colors in our system
     */
    #[Route('/api/color/compare', methods: ['POST'])]
    #[OA\Parameter(
        name: 'colors',
        in: 'query',
        description: 'The field used for inyect colors, (IMPORTANT) the separator characteher is ",". Ej; "green,red,yellow"',
        schema: new OA\Schema(type: 'string')
    )]
    #[OA\Tag(name: 'COLORS')]
    public function compare(Request $request): JsonResponse
    {
        if (empty($request->get('colors'))){
            return new JsonResponse(
                ['message' => 'Missing input [colors].'],
                400
            );
        }

        $colorRepository = new ColorInMemoryRepository();

        try {
            $colorCollection = array_map(function (string $color){
                return new Color(
                    new ColorId($color),
                    new ColorName($color)
                );
            }, explode(",", $request->get('colors')));

            $compareColorsServices = new CompareColorsService($colorRepository);
            $colors = $compareColorsServices->__invoke($colorCollection);
        } catch (\Exception $e) {
            return new JsonResponse(
                ['message' => '[Error] ' . $e->getMessage()],
                400
            );
        }

        return new JsonResponse(
            $colors,
            200
        );


    }
}