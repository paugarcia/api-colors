<?php

namespace Colors\Color\Application\Commands\DeleteColor;

use Colors\Color\Domain\ValueObjects\ColorId;

use Colors\Color\Application\Commands\DeleteColor\DeleteColorApplicationService;

use Colors\Shared\Application\Command;
use Colors\Shared\Application\CommandHandler;

final class DeleteColorCommandHandler implements CommandHandler
{
    private DeleteColorApplicationService $deleteColorApplicationService;

    public function __construct(DeleteColorApplicationService $deleteCartApplicationService)
    {
        $this->deleteColorApplicationService = $deleteCartApplicationService;
    }

    public function handle(Command $command): void
    {
        $this->deleteColorApplicationService->delete(new ColorId($command->id()));
    }
}