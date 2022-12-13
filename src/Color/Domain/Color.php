<?php

namespace Colors\Color\Domain;

use Colors\Color\Domain\ValueObjects\ColorName;
use Colors\Color\Domain\ValueObjects\ColorId;

final class Color
{
    private ColorId $id;
    private ColorName $name;

    public function __construct(ColorId $sku, ColorName $name)
    {
        $this->id = $sku;
        $this->name = $name;
    }

    public function id(): ColorId
    {
        return $this->id;
    }

    public function name(): ColorName
    {
        return $this->name;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id->value(),
            'name' => $this->name->value()
        ];
    }
}