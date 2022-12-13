<?php

namespace Colors\Color\Application\Commands\CreateColor;

use Colors\Color\Domain\ValueObjects\ColorId;
use Colors\Color\Domain\ValueObjects\ColorName;

use Colors\Shared\Application\Command;
use Colors\Shared\Application\CommandHandler;

final class CreateColorCommandHandler implements CommandHandler
{
    private CreateColorApplicationService $createColorApplicationService;

    public function __construct(CreateColorApplicationService $createColorApplicationService)
    {
        $this->createColorApplicationService = $createColorApplicationService;
    }

    public function handle(Command $command): void
    {
        $colorId = new ColorId($command->id());
        $colorName = new ColorName($command->name());

        $this->createColorApplicationService->create($colorId, $colorName);
    }
}

