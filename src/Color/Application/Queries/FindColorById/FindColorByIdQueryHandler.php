<?php

namespace Colors\Color\Application\Queries\FindColorById;

use Colors\Color\Domain\Color;
use Colors\Color\Domain\ValueObjects\ColorId;

use Colors\Shared\Application\Query;
use Colors\Shared\Application\QueryHandler;

final class FindColorByIdQueryHandler implements QueryHandler
{
    private FindColorByIdApplicationService $findColorByIdApplicationService;

    public function __construct(FindColorByIdApplicationService $findColorByIdApplicationService)
    {
        $this->findColorByIdApplicationService = $findColorByIdApplicationService;
    }

    public function handle(Query $query): ?Color
    {
        return $this->findColorByIdApplicationService->find(new ColorId($query->id()));
    }
}