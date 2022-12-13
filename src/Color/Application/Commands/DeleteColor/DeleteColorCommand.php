<?php

namespace Colors\Color\Application\Commands\DeleteColor;

use Colors\Shared\Application\Command;

final class DeleteColorCommand implements Command
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function id(): string
    {
        return $this->id;
    }
}