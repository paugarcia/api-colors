<?php

namespace Colors\Color\Infrastructure;

use Colors\Color\Domain\Color;
use Colors\Color\Domain\Repository\ColorRepository;

use Colors\Color\Domain\ValueObjects\ColorName;
use Colors\Color\Domain\ValueObjects\ColorId;

final class ColorInMemoryRepository implements ColorRepository
{
    private array $colors = [
        '000001' => [
            'id' => '000001',
            'name' => 'red',
        ],
        '000002' => [
            'id' => '000001',
            'name' => 'green',
        ],
    ];

    public function getAll(): array
    {
        $colorsList = [];

        foreach ($this->colors as $color) {
            $colorsList[$color['id']] = new Color(
                new ColorId($color['id']),
                new ColorName($color['name'])
            );
        }

        return $colorsList;
    }

    public function create(Color $color): void
    {
        $this->colors[$color->id()->value()] = [
            'id' => $color->id()->value(),
            'name' => $color->name()->value()
        ];
    }

    public function find(ColorId $colorId): ?Color
    {
        $color = null;

        if(!empty($this->colors[$colorId->value()])){
            $color = new Color(
                new ColorId($this->colors[$colorId->value()]['id']),
                new ColorName($this->colors[$colorId->value()]['name'])
            );
        }

        return $color;
    }
}