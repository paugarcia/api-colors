<?php

namespace Colors\Color\Application\Commands\CreateColor;

use Colors\Color\Domain\Color;

use Colors\Color\Domain\Exceptions\ColorAlreadyExistException;
use Colors\Color\Domain\Repository\ColorRepository;

use Colors\Color\Domain\ValueObjects\ColorName;
use Colors\Color\Domain\ValueObjects\ColorId;

final class CreateColorApplicationService
{
    private ColorRepository $colorRepository;

    public function __construct(ColorRepository $colorRepository)
    {
        $this->colorRepository = $colorRepository;
    }

    public function create(ColorId $colorId, ColorName $colorName): void
    {
        if (!empty($this->colorRepository->find($colorId))){
            throw new ColorAlreadyExistException(
                sprintf('Already exist a color: %s', $colorName->value())
            );
        }

        $color = new Color($colorId, $colorName);

        $this->colorRepository->create($color);
    }
}