<?php

namespace Colors\Color\Application\Queries\FindColorById;

use Colors\Color\Domain\Color;
use Colors\Color\Domain\Repository\ColorRepository;
use Colors\Color\Domain\ValueObjects\ColorId;

final class FindColorByIdApplicationService
{
    private ColorRepository $colorRepository;

    public function __construct(ColorRepository $colorRepository)
    {
        $this->colorRepository = $colorRepository;
    }

    public function find(ColorId $colorId): ?Color
    {
        return $this->colorRepository->find($colorId);
    }
}