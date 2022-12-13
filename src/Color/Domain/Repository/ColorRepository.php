<?php

namespace Colors\Product\Domain\Repository;

use Colors\Color\Domain\Color;

use Colors\Color\Domain\ValueObjects\ColorId;

interface ColorRepository
{
    public function getAll(): array;
    public function save(Color $color): void;
    public function find(ColorId $id): ?Color;
}