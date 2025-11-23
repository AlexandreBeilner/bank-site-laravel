<?php

namespace App\Application\Bank\UseCases\ListBanks;

final class ListBanksRequest
{
    public function __construct(
        public ?string $search = null,
        public int $page,
        public int $perPage,
        public string $orderBy,
        public string $direction
    ){}
}
