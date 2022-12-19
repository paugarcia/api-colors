<?php

namespace Colors\Color\Domain\ValueObjects;

use Colors\Color\Domain\Exceptions\InvalidColorNameEmptyException;
use Colors\Color\Domain\Exceptions\InvalidColorNameException;

final class ColorName
{
    private string $name;

    public function __construct(string $name)
    {
        $this->validate($name);
        $this->name = $name;
    }

    public function value(): string
    {
        return $this->name;
    }

    private function validate($name): void
    {
        if (empty($name)){
            throw new InvalidColorNameEmptyException(
                "Invalid color name, can't be empty."
            );
        }

        if(!preg_match('/^[a-zA-Z0-9\-_\s]*$/', $name)){
            throw new InvalidColorNameException(
                "Invalid color name, can't have special characters."
            );
        }
    }
}