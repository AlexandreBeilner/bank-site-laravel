<?php

namespace App\Application\Billet\UseCases\ListBillets;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class ListBilletsResponse
{
    public function __construct(
        public readonly LengthAwarePaginator $paginator
    ){}
}
