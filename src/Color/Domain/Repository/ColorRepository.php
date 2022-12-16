<?php

namespace Colors\Color\Domain\Repository;

use Colors\Color\Domain\Color;

use Colors\Color\Domain\ValueObjects\ColorId;

interface ColorRepository
{
    public function getAll(): array;
    public function create(Color $color): void;
    public function find(ColorId $colorId): ?Color;
}