<?php

namespace Colors\Color\Application\Services;

use Colors\Color\Domain\Color;
use Colors\Color\Domain\Repository\ColorRepository;

class CompareColorsService
{
    private ColorRepository $colorRepository;

    public function __construct(ColorRepository $colorRepository)
    {
        $this->colorRepository = $colorRepository;
    }

    public function __invoke(array $colorsCollectionToCompare): array
    {
        $difference = [];

        $allColors = array_map(function (Color $color){
            return $color->name()->value();
        }, $this->colorRepository->getAll());

        /**
         * @var Color $color
         */
        foreach ($colorsCollectionToCompare as $color) {
            if(!in_array($color->name()->value(), $allColors)){
            $difference[] = $color->name()->value();
            }
        }

        return $difference;
    }

}