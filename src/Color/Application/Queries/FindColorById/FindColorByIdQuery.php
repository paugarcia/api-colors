<?php

namespace Colors\Color\Application\Queries\FindColorById;

use Colors\Shared\Application\Query;

final class FindColorByIdQuery implements Query
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