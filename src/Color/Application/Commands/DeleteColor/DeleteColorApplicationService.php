<?php

namespace Colors\Color\Application\Commands\DeleteColor;

use Colors\Color\Domain\Exceptions\ColorNotFoundException;

use Colors\Color\Domain\Repository\ColorRepository;

use Colors\Color\Domain\ValueObjects\ColorId;

final class DeleteColorApplicationService
{
    private ColorRepository $colorRepository;

    public function __construct(ColorRepository $colorRepository)
    {
        $this->colorRepository = $colorRepository;
    }

    public function delete(ColorId $colorId): void
    {
        if (empty($this->colorRepository->find($colorId))){
            throw new ColorNotFoundException(
                'Not found any color with this id: ' .  $colorId->value()
            );
        }

        $this->colorRepository->delete($colorId);
    }
}