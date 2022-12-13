<?php

namespace Colors\Color\Domain\ValueObjects;

use Colors\Color\Domain\Exceptions\InvalidColorIdException;

final class ColorId
{
    private string $id;

    public function __construct(string $id)
    {
        $this->validateId($id);
        $this->id = $id;
    }

    public function value(): string
    {
        return $this->id;
    }

    private function validateId($id): void
    {
        if (empty($id)){
            throw new InvalidColorIdException("Invalid color id, can't be empty.");
        }
    }
}