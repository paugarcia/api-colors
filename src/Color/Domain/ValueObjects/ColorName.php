<?php

namespace Colors\Color\Domain\ValueObjects;

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

    /**
     * TODO: Add ColorName validations ( exercise rules )
     */
    private function validate($name): void
    {
        if (empty($name)){
            throw new InvalidColorNameException(
                "Invalid color name, can't be empty."
            );
        }
    }
}