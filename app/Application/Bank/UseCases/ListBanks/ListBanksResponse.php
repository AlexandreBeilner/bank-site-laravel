<?php

namespace App\Application\Bank\UseCases\ListBanks;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class ListBanksResponse
{
    public function __construct(
        public readonly LengthAwarePaginator $paginator
    ){}
}
